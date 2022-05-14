<?php

namespace app\admin\controller\api;

use app\admin\controller\Base;
use app\common\model\ApiResultModel;

class Result extends Base
{
    function index(){
        if (!$this->request->isAjax()) {
            $this->assign('api_id',$this->request->param('api_id',0));
            return view('index');
        } else {
            $limit = $this->request->post('limit');
            $offset = $this->request->post('offset');
            $page = floor($offset / $limit) + 1;

            $where['api_id'] = $this->request->param('api_id','');
            $where['field|demo|desc'] = ['like', $this->request->param('keywords', '')];
            $where['status'] = $this->request->param('status', '');

            $res = ApiResultModel::where(formatWhere($where))
                ->order('sort asc')
                ->paginate(['list_rows' => $limit, 'page' => $page])
                ->toArray();
            return json(['rows' => $res['data'], 'total' => $res['total']]);
        }
    }

    function status(): \think\response\Json
    {
        $postField = 'id,status';
        $data = $this->request->only(explode(',',$postField),'param',null);
        if(!$data['id'])
            $this->error('参数错误');
        ApiResultModel::update($data);
        return $this->ajaxReturn($this->successCode,'操作成功');
    }

    function arrow(): \think\response\Json
    {
        $postField = 'id,sort,type';
        $api_id = $this->request->param('fk',0);
        $data = $this->request->only(explode(',',$postField),'post',null);
        if(empty($data['sort'])){
            $this->error('操作失败，当前数据没有排序号');
        }
        if($data['type'] == 1){//上
            $info = ApiResultModel::where('api_id',$api_id)->where('sort','<',$data['sort'])->order('sort desc')->find();
        }else{
            $info = ApiResultModel::where('api_id',$api_id)->where('sort','>',$data['sort'])->order('sort desc')->find();
        }
        if(empty($info['sort'])){
            $this->error('操作失败，目标位置没有排序号');
        }
        if($info){
            try{
                ApiResultModel::where('api_id',$api_id)->where('id',$data['id'])->update(['sort'=>$info['sort']]);
                ApiResultModel::where('api_id',$api_id)->where('id',$info['id'])->update(['sort'=>$data['sort']]);
            }catch(\Exception $e){
                throw new \think\exception\ValidateException ($e->getMessage());
            }
        }else{
            $this->error('目标位置没有数据');
        }
        return $this->ajaxReturn($this->successCode,'操作成功');
    }

    function update(){
        $id = $this->request->get('id', 0);
        if (!$this->request->isPost()) {
            $this->view->assign('id', $id);
            $info = ApiResultModel::find($id) ?: new ApiResultModel();
            $this->view->assign('info', $info);
            $this->assign('api_id',$this->request->param('api_id',0));
            return view('update');
        } else {
            $data = $this->request->only([
                'sort' => '',
                'field' => '',
                'demo' => 0,
                'desc' => '',
                'status'=>0,
            ], 'param', null);
            if ($id) {
                ApiResultModel::where('id', $id)->update($data);
            } else {
                $data['api_id'] = $this->request->param('api_id',0);
                $res = ApiResultModel::create($data);
                $id = $res->id;
            }
            if(!$data['sort']){
                ApiResultModel::where('id', $id)->update([
                    'sort'=>$id
                ]);
            }
            return $this->ajaxReturn($this->successCode, '提交成功');
        }
    }

    function delete(){
        $idx = $this->request->post('id');
        if (!$idx) $this->error('参数错误');
        ApiResultModel::destroy(['id' => explode(',', $idx)]);
        return $this->ajaxReturn($this->successCode, '操作成功');
    }
}