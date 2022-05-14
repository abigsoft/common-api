<?php

namespace app\user\controller;

use app\BaseController;
use app\common\model\ConfigModel;
use app\common\model\PayOrderModel;
use app\common\model\MemberModel;
use app\common\service\OrderService;
use app\user\service\LoginService;
use pay\epay\Notify;
use think\exception\HttpResponseException;

class Callback extends Base
{
    function login(){
        $param = input('param.');
        $res = LoginService::callback($param['code']);
        if(isset($res['code']) && $res['code']==0){
            $info = MemberModel::where($res['type'].'_id',$res['social_uid'])->find();
            if($info){
                session('member_id',$info['id']);
                $this->redirect('/user/index/index');
            }
            else{
                $data = [
                    'account'=>random(12,'all',0),
                    'password'=>md5('123456'.config('my.password_secret')),
                    'status'=>1,
                ];
                $data[$res['type'].'_id'] = $res['social_uid'];
                $res2 = MemberModel::create($data);
                session('member_id',$res2->id);
                $this->redirect('/user/index/index');
            }
        }
        else{
            $this->redirect('/user/index/index');
        }
    }

    public function bind(){
        $param = input('param.');
        $res = LoginService::callback($param['code']);
        if(isset($res['code']) && $res['code']==0){
            $check = MemberModel::where($res['type'].'_id',$res['social_uid'])->count();
            if($check){
                $this->error('该第三方已绑定其他用户，请先解绑后操作');
                /**
                MemberModel::where($res['type'].'_id',$res['social_uid'])->update([
                    $res['type'].'_id'=>'',
                ]);**/
            }
            $data[$res['type'].'_id'] = $res['social_uid'];
            MemberModel::where('id',session('member_id'))->update($data);
            die('<script type="text/javascript">top.parent.frames.location.href="'.url('/user/index/index').'";</script>');
        }
        else{
            die('<script type="text/javascript">top.parent.frames.location.href="'.url('/user/index/index').'";</script>');
        }
    }

    //跳转通知地址
    function epay(){
        $param = input('param.');
        //计算得出通知验证结果
        $alipayNotify = new Notify([
            'key'=>config('sys.pay_epay_key'),
            'pid'=>intval(config('sys.pay_epay_mchid'))
        ]);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
            //商户订单号
            $out_trade_no = $param['out_trade_no'];
            //支付宝交易号
            $trade_no = $param['trade_no'];
            //交易状态
            $trade_status = $param['trade_status'];

            if($trade_status == 'TRADE_SUCCESS') {
                $order = PayOrderModel::where('order_sn',$out_trade_no)->find();
                if($order['status'] == 1){
                    $this->redirect('/user/index/index');
                }
                PayOrderModel::where('id',$order['id'])->update([
                    'pay_money'=>$param['money'],
                    'order_code'=>$trade_no,
                    'transaction_id'=>$trade_no,
                    'pay_time'=>formatDate(),
                ]);
                OrderService::realOrder($order['id']);
                die('<script type="text/javascript">top.parent.frames.location.href="'.url('/user/index/index').'";</script>');
                $this->redirect('/user/index/index');
            }
            else {
                die('<script type="text/javascript">top.parent.frames.location.href="'.url('/user/index/index').'";</script>');
                $this->redirect('/user/index/index');
            }

        }
        else {
            die('<script type="text/javascript">top.parent.frames.location.href="'.url('/user/index/index').'";</script>');
            $this->redirect('/user/index/index');
        }
    }
}