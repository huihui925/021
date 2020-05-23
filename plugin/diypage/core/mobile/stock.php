<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/20 0020
 * Time: 19:36
 */

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Stock_EweiShopV2Page extends PluginMobilePage
{
    public function main(){

    }

    public function stockList(){
        global $_W;
        $list = pdo_fetchall("
            SELECT
            msc.id
            ,msc.advname
            ,sum(buy_num) as buy_num
            FROM
            ".tablename('ewei_shop_member_stock_company')." msc
            LEFT JOIN ".tablename('ewei_shop_member_stock_buy_log')." mbl ON mbl.msc_id = msc.id
            WHERE mbl.openid='".$_W['openid']."' and mbl.uniacid=".$_W['uniacid']." and msc.uniacid=".$_W['uniacid']."
            GROUP BY msc.id
        ");
        show_json(1,array('data'=>$list));
    }

    public function stockDetail(){
        global $_W;
        global $_GPC;

        $msc_id = trim($_GPC['company_id']);
        if($_W['ispost']){
            $list = array();
            $list['info'] = pdo_fetch('select * from '.tablename('ewei_shop_member_stock_company').' where id='.$msc_id);
            $pindex = max(1, intval($_GPC['page']));
            $psize = 20;

            $sql = 'select * from '.tablename('ewei_shop_member_stock_buy_log').' where uniacid=:uniacid and openid=:openid and msc_id=:msc_id order by buy_time desc ';
            $param = array(
                ':uniacid'  => $_W['uniacid']
                ,':openid'  => $_W['openid']
                ,':msc_id'  => $msc_id
            );
            $sql2 = 'select sum(total_price) as total_price from '.tablename('ewei_shop_member_stock_buy_log').' where uniacid=:uniacid and openid=:openid and msc_id=:msc_id order by buy_time desc ';
            $list['total_price'] = pdo_fetch($sql2,$param)['total_price'];
            $sql .= ' LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
            $list['data'] = pdo_fetchall($sql, $param);
            if(empty($list['data'])){
                show_json(0, '已经没有数据了');
            } else {
                foreach ($list['data'] as $key=>$value){
                    $list['data'][$key]['buy_date'] = date("Y-m-d H:i:s",$value['buy_time']);
                }
                show_json(1,$list);
            }
        } else {
            echo show_json(0,'请求方式错误');
        }

    }

    public function profit(){
        global $_W;
        global $_GPC;
        $start_time = intval(trim($_GPC['start_time']));
        $end_time = intval(trim($_GPC['end_time']));
        $money = pdo_fetch("
            SELECT
            sum(case when type = 16 then money end) as qqt_money
            ,sum(case when type = 17 then money end) as stock_money
            FROM
            ".tablename('ewei_shop_member_log')."
            WHERE
            `type` IN (16,17)
            AND openid = '".$_W['openid']."'
            AND (createtime BETWEEN {$start_time} AND {$end_time})
            ");
        show_json(1, $money);
    }

    public function profitDetail(){
        global $_W;
        global $_GPC;
        $start_time = intval(trim($_GPC['start_time']));
        $end_time = intval(trim($_GPC['end_time']));


        $pindex = max(1, intval($_GPC['page_index']));
        $psize = 20;

        $list['data'] = pdo_fetchall("
            SELECT
            *
            FROM
            ".tablename('ewei_shop_member_log')."
            WHERE
            `type` IN (16,17)
            AND openid = '".$_W['openid']."'
            AND (createtime BETWEEN {$start_time} AND {$end_time})
             LIMIT " . ($pindex - 1) * $psize . ',' . $psize
        );
        foreach ($list['data'] as $key=>$value){
            $list['data'][$key]['date_time'] = date("Y-m-d H:i:s", $value['createtime']);
        }
        if(count($list['data']) > 0){
            show_json(1,$list);
        } else {
            show_json(0,'没数据了');
        }

    }

    public function exchangeStock(){
        global $_W;
        global $_GPC;

        if($_W['ispost']){

            $buy_num = intval($_GPC['num']);
            $sc_id = intval($_GPC['sc_id']);
            if(empty($buy_num)){
                show_json(0,'购买数量不能为空');
            }
            if(empty($sc_id)){
                show_json(0,'请选择公司');
            }

            $stock_info = pdo_fetch('select * from '.tablename('ewei_shop_member_stock_company').' where id='.$sc_id);
            $member_stock_num = pdo_fetch('select sum(buy_num) as buy_num from '.tablename('ewei_shop_member_stock_buy_log').' where uniacid='.$_W['uniacid'])['buy_num'];
            $stock_num = $stock_info['num']-$member_stock_num;
            if($buy_num > $stock_num){
                show_json(0,'购买数量不能超过平台剩余数'.$stock_num);
            }
            $member = m("member")->getMember($_W['openid']);
            $buy_money = $buy_num*$stock_info['credit1'];
            if($member['credit1'] < $buy_money){
                show_json(0,'积分不足');
            }

            m('member')->setCredit($member['openid'],'credit1',-$buy_money,array($member['uid'],"兑换{$buy_num}{$stock_info['advname']}消耗{$buy_money}积分"));
            m('member')->addLog($member['openid'],15,'兑换股权',1,-$buy_money,"兑换{$buy_num}{$stock_info['advname']}消耗{$buy_money}积分");

            $insert_data = array(
                'uniacid'   => $_W['uniacid']
                ,'openid'   => $_W['openid']
                ,'buy_num'  => $buy_num
                ,'msc_id'   => $sc_id
                ,'buy_time' => time()
                ,'unit_price'   => $stock_info['credit1']
                ,'total_price'  => $buy_money
            );
            pdo_insert('ewei_shop_member_stock_buy_log',$insert_data);
            show_json(1,'兑换成功');
        } else {
            show_json(0,'请求方法错误');
        }
    }

    public function get(){

    }
}