<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/14 0014
 * Time: 21:58
 */

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Qqt_EweiShopV2Page extends PluginWebPage
{
    public function main()
    {

    }

    public function userList(){
        global $_W;
        global $_GPC;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $params = array();
        $condition = ' ';

        $sql = 'select * from '.tablename('ewei_shop_member').' where qqt_num > 0 and uniacid ='. $_W['uniacid'].$condition.'ORDER BY createtime desc';
        $sql .= ' limit ' . ($pindex - 1) * $psize . ',' . $psize;



        $list = pdo_fetchall($sql,$params);
        $total = pdo_fetchcolumn('select count(1) from '.tablename('ewei_shop_member').' where qqt_num > 0 and uniacid ='. $_W['uniacid'].$condition, $params);

        $pager = pagination2($total, $pindex, $psize);
        load()->func('tpl');
        include $this->template();
    }

    public function make(){
        global $_W;
        global $_GPC;

        $qqt_set = m('common')->getPluginset('bonuscenter');

        if($_W['ispost']){
            $data = $_GPC['data'];
            $total_price = intval(trim($data['total_price']));
            $ratio = intval(trim($data['ratio']));
            $qqt_num = intval(trim($data['qqt_num']));
            $member_list = pdo_fetchall('select * from '.tablename('ewei_shop_member').' where qqt_num > 0 and uniacid='.$_W['uniacid']);

            $m_ids = array();
            $commission = array();
            foreach ($member_list as $value){
                $m_ids[] = $value['id'];
                $price = ($value['qqt_num'] / $qqt_num) * $total_price;
                $commission[] = array('id'=>$value['id'],'qqt_num'=>$value['qqt_num'],'price'=>round($price, 2));
            }
            $insert_data = array(
                'uniacid'       => $_W['uniacid']
                ,'type'         => 1
                ,'msc_id'       => 0
                ,'m_ids'        => serialize($m_ids)
                ,'commission'   => serialize($commission)
                ,'total_price'  => $total_price
                ,'ratio'        => $ratio
                ,'is_bonus'     => 0
                ,'create_time'  => time()
            );
            if(pdo_insert('ewei_shop_member_bonus2',$insert_data)){
                $id = pdo_insertid();
                foreach ($commission as $value){
                    $insert_data = array(
                        'uniacid'       => $_W['uniacid']
                        ,'msc_id'       => 0
                        ,'type'         => 1
                        ,'m_id'         => $value['id']
                        ,'buy_num'      => $value['qqt_num']
                        ,'unit_price'   => round((1 / $qqt_num) * $total_price,2)
                        ,'total_price'  => $total_price
                        ,'bouns_price'  => $value['price']
                        ,'b_id'         => $id
                        ,'create_time'  => time()
                    );
                    pdo_insert('ewei_shop_member_bonus2_log',$insert_data);
                }
                show_json(1,'保存成功');
            } else {
                show_json(0, '保存失败');
            }

        }
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $params = array();
        $condition = ' ';
        $sql = 'select * from '.tablename('ewei_shop_member_bonus2').' where `type`=1 and uniacid='.$_W['uniacid'].$condition;
        $sql1 = $sql.' limit ' . ($pindex - 1) * $psize . ',' . $psize;
        $list = pdo_fetchall($sql1,$params);

        $sql2 = 'select count(1) from ('.$sql.') temp';
        $total = pdo_fetchcolumn($sql2,$params);

        $pager = pagination2($total, $pindex, $psize);
        $member_buy_num = pdo_fetchcolumn('select sum(qqt_num) from '.tablename('ewei_shop_member').' where qqt_num > 0 and uniacid='.$_W['uniacid']);
        load()->func('tpl');
        include $this->template();
    }

    public function delete(){
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);

        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }

        $items = pdo_fetchall('SELECT id FROM ' . tablename('ewei_shop_member_bonus2') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);

        foreach ($items as $item) {
            pdo_delete('ewei_shop_member_bonus2', array('id' => $item['id']));
            plog('bonuscenyer.qqt.delete', '删除紫钻分红 ID: ' . $item['id']);
        }

        show_json(1, array('url' => referer()));
    }

    public function bonus(){
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);
        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }

        $items = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_member_bonus2') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);
        foreach ($items as $item){
            $items2 = pdo_fetchall('SELECT * FROM '.tablename('ewei_shop_member_bonus2_log').' WHERE b_id = '.$id.'  AND uniacid='.$_W['uniacid']);
            foreach ($items2 as $item2){
                m("member")->addLog($item2['m_id'],16,'紫钻分红',1,$item2['bouns_price'],"{$item2['total_price']}金额被{$item2['buy_num']}紫钻分红{$item2['bouns_price']}金额");
                $member_info = m('member')->getMember($item2['m_id']);
                m("member")->setCredit($member_info['openid'],'credit2',$item2['bouns_price']);
            }
            pdo_update('ewei_shop_member_bonus2',array('is_bonus'=>1),array('id'=>$item['id']));
        }
        show_json(1, array('url' => referer()));
    }
}