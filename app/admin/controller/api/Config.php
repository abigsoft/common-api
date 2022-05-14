<?php

namespace app\admin\controller\api;

use app\admin\controller\Base;
use app\common\model\ApiConfigModel;
use app\common\model\ApiModel;

class Config extends Base
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
            $where['title|name|data|desc'] = ['like', $this->request->param('keywords', '')];
            $where['status'] = $this->request->param('status', '');

            $order = $this->request->post('order');    //排序字段 bootstrap-table 传入
            $sort = $this->request->post('sort');        //排序方式 desc 或 asc

            $order = ($sort && $order) ? $sort . ' ' . $order : 'sort asc';

            $res = ApiConfigModel::where(formatWhere($where))
                ->order($order)
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
        ApiConfigModel::update($data);
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
            $info = ApiConfigModel::where('api_id',$api_id)->where('sort','<',$data['sort'])->order('sort desc')->find();
        }else{
            $info = ApiConfigModel::where('api_id',$api_id)->where('sort','>',$data['sort'])->order('sort desc')->find();
        }
        if(empty($info['sort'])){
            $this->error('操作失败，目标位置没有排序号');
        }
        if($info){
            try{
                ApiConfigModel::where('api_id',$api_id)->where('id',$data['id'])->update(['sort'=>$info['sort']]);
                ApiConfigModel::where('api_id',$api_id)->where('id',$info['id'])->update(['sort'=>$data['sort']]);
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
            $info = ApiConfigModel::find($id) ?: new ApiConfigModel();
            $this->view->assign('info', $info);
            $this->assign('api_id',$this->request->param('api_id',0));
            return view('update');
        } else {
            $data = $this->request->only([
                'type' => 'Array',
                'title' => '',
                'name' => '',
                'data' => '',
                'desc' => '',
                'sort' => 0,
                'status' => '',
            ], 'param', null);
            if ($id) {
                ApiConfigModel::where('id', $id)->update($data);
            } else {
                $data['api_id'] = $this->request->param('api_id',0);
                $res = ApiConfigModel::create($data);
                $id = $res->id;
            }
            if(!$data['sort']){
                ApiConfigModel::where('id', $id)->update([
                    'sort'=>$id
                ]);
            }
            return $this->ajaxReturn($this->successCode, '提交成功');
        }
    }

    function delete(){
        $idx = $this->request->post('id');
        if (!$idx) $this->error('参数错误');
        ApiConfigModel::destroy(['id' => explode(',', $idx)]);
        return $this->ajaxReturn($this->successCode, '操作成功');
    }
}