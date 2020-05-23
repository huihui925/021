<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/23 0023
 * Time: 11:09
 */
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Integral_EweiShopV2Page extends PluginMobilePage
{
    public function main(){
        global $_W;
        global $_GPC;

        if($_W['ispost']){
            $list = array();

            $pindex = max(1, intval($_GPC['page']));
            $psize = 20;
            $type = intval(trim($_GPC['type']));
            $list['sort']['num'] = intval(trim($_GPC['sort_num']));
            $sort_num = empty(trim($_GPC['sort_num'])) ? 'num desc' : 'num asc';
            $list['sort']['price'] = intval(trim($_GPC['sort_price']));
            $sort_price = empty(trim($_GPC['sort_price'])) ? 'price desc' : 'price asc';

            $condition = ' and `status`=0 ';

            if($type == 1){
                $condition .= ' and `type`=1 ';
            } elseif($type == 2){
                $condition .= ' and `type`=2 ';
            }

            $sort = " {$sort_num},{$sort_price} ";


            $sql = 'select * from '.tablename('ewei_shop_member_release').' where uniacid=:uniacid '.$condition.' order by '.$sort;
            $param = array(
                ':uniacid'  => $_W['uniacid']
            );
            $sql .= ' LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
            $list['data'] = pdo_fetchall($sql, $param);
            if(empty($list['data'])){
                show_json(0, '已经没有数据了');
            } else {
                foreach ($list['data'] as $key=>$value){
                    $list['data'][$key]['create_date'] = date("Y-m-d H:i:s",$value['create_time']);
                    $list['data'][$key]['buy_date'] = date("Y-m-d H:i:s",$value['buy_time']);
                    $member = m("member")->getMember($value['openid']);
                    $list['data'][$key]['nickname'] = $member['nickname'];
                    $list['data'][$key]['avatar'] = $member['avatar'];
                }
                show_json(1,$list);
            }
        } else {
            echo show_json(0,'请求方式错误');
        }
    }

    public function release(){
        global $_W;
        global $_GPC;

        if($_W['ispost']){
            $price = intval(trim($_GPC['price']));
            $num = intval(trim($_GPC['num']));
            $type = intval($_GPC['type']);

            $member_info = m("member")->getMember($_W['openid']);
            if(($num > $member_info['credit1']) && ($type == 1)){
                show_json(0, '你的积分不足');
            } elseif($type == 1) {
                m('member')->setCredit($member_info['openid'],'credit1',-$num,array($member_info['uid'],"出售积分消耗{$num}"));
            }
            if(($price > $member_info['credit2']) && ($type == 2)){
                show_json(0, '你的余额不足');
            } elseif($type == 2) {
                m('member')->setCredit($member_info['openid'],'credit2',-$price,array($member_info['uid'],"求购积分消耗{$price}"));
            }
            $insert_data = [
                'num'           => $num
                ,'price'        => $price
                ,'type'         => $type
                ,'openid'       => $_W['openid']
                ,'uniacid'      => $_W['uniacid']
                ,'status'       => 0
                ,'create_time'  => time()
            ];
            if(pdo_insert('ewei_shop_member_release',$insert_data)){
                show_json(1,'发布成功');
            }
        } else {
            show_json(0,'请求方式错误');
        }
    }

    public function buy(){
        global $_W;
        global $_GPC;

        if($_W['openid']){
            $id = intval(trim($_GPC['id']));
            if(empty($id)){
                show_json(0, '参数不全');
            }
            $member_info = m('member')->getMember($_W['openid']);
            $release_info = pdo_fetch('select * from '.tablename('ewei_shop_member_release').' where id='.$id.' and `status`=0');
            if($release_info['openid'] == $member_info['openid']){
                show_json(0,'不能购买兑换自己的');
            }
            if(empty($release_info)){
                show_json(0, '该交易已完成');
            }
            if(($release_info['type'] == 1) && ($member_info['credit2'] < $release_info['price'])){
                show_json(0,'余额不足');
            } elseif($release_info['type'] == 1) {
                m('member')->setCredit($member_info['openid'],'credit2',-$release_info['price'],array($member_info['uid'],"购买积分消耗{$release_info['price']}"));
                m('member')->setCredit($release_info['openid'],'credit1',$release_info['num'],"求购获取{$release_info['num']}");
            }
            if(($release_info['type'] == 2) && ($member_info['credit1'] < $release_info['num'])){
                show_json(0,'积分不足');
            } elseif($release_info['type'] == 2) {
                m('member')->setCredit($member_info['openid'],'credit1',-$release_info['num'],array($member_info['uid'],"购买余额消耗{$release_info['num']}"));
                m('member')->setCredit($release_info['openid'],'credit2',$release_info['price'],"求购获取{$release_info['price']}");
            }
            $save_data = array(
                'status'        => 1
                ,'buy_time'     => time()
                ,'buy_openid'   => $_W['openid']
            );
            pdo_update('ewei_shop_member_release', $save_data, array('id'=>$id));
            show_json(1, '购买成功');
        } else {
            show_json(0, '请求方式错误');
        }
    }

}