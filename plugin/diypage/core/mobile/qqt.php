<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/20 0020
 * Time: 9:56
 */

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Qqt_EweiShopV2Page extends PluginMobilePage
{
    public function main(){

    }

    public function getList(){
        global $_W;
        global $_GPC;

        if($_W['ispost']){
            $list = array();

            $pindex = max(1, intval($_GPC['page']));
            $psize = 20;

            $sql = 'select * from '.tablename('ewei_shop_member_log').' where uniacid=:uniacid and openid=:openid and `type`=14 order by createtime desc ';
            $param = array(
                ':uniacid'  => $_W['uniacid']
                ,':openid'  => $_W['openid']
            );
            $sql .= ' LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
            $list['data'] = pdo_fetchall($sql, $param);
            if(empty($list['data'])){
                show_json(0, '已经没有数据了');
            } else {
                foreach ($list['data'] as $key=>$value){
                    $list['data'][$key]['create_date'] = date("Y-m-d H:i:s",$value['createtime']);
                }
                show_json(1,$list);
            }
        } else {
            echo show_json(0,'请求方式错误');
        }

    }

    public function exchangeQqt(){
        global $_W;
        global $_GPC;

        if($_W['ispost']){

            $buy_num = intval($_GPC['num']);
            if(empty($buy_num)){
                show_json(0,'购买数量不能为空');
            }

            $qqt_list = m('common')->getPluginset('bonuscenter');
            $member_qqt_num = pdo_fetch('select sum(qqt_num) as qqt_num from '.tablename('ewei_shop_member').' where qqt_num > 0 and uniacid='.$_W['uniacid'])['qqt_num'];
            $qqt_num = $qqt_list['qqt_num']-$member_qqt_num;
            if($buy_num > $qqt_num){
                show_json(0,'购买数量不能超过平台剩余数'.$qqt_num);
            }
            $member = m("member")->getMember($_W['openid']);
            $buy_money = $buy_num*$qqt_list['qqt_integral'];
            if($member['credit1'] < $buy_money){
                show_json(0,'积分不足');
            }

            if(empty($member['uid'])){
                $save_data = array(
                    'credit1'   => $member['credit1']-$buy_money
                    ,'qqt_num'  => $member['qqt_num']+$buy_num
                );
                $save_where = array(
                    'id'    => $member['id']
                );
                pdo_update("ewei_shop_member", $save_data, $save_where);
            } else {
                pdo_update("ewei_shop_member", array('qqt_num' => $member['qqt_num']+$buy_num), array('id' => $member['id']));
                pdo_update('mc_members',array('credit1'=>$member['credit1']-$buy_money), array('uid'=>$member['uid'],'uniacid'=>$member['uniacid']));
            }
            m('member')->addLog($member['openid'],14,'兑换紫钻',1,-$buy_money,"兑换{$buy_num}紫钻消耗{$buy_money}积分");
            show_json(1,'兑换成功');
        } else {
            show_json(0,'请求方法错误');
        }

    }
}