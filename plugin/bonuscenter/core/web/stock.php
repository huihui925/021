<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/14 0014
 * Time: 22:08
 */
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Stock_EweiShopV2Page extends PluginWebPage
{
    public function main()
    {

    }

    public function stockList(){
        global $_W;
        global $_GPC;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $params = array();
        $condition = ' ';

        $sql = 'select * from '.tablename('ewei_shop_member_stock_company').' where uniacid ='. $_W['uniacid'].$condition.'ORDER BY create_time desc';
        $sql .= ' limit ' . ($pindex - 1) * $psize . ',' . $psize;



        $list = pdo_fetchall($sql,$params);
        $total = pdo_fetchcolumn('select count(1) from '.tablename('ewei_shop_member_stock_company').' where uniacid ='. $_W['uniacid'].$condition, $params);

        $pager = pagination2($total, $pindex, $psize);
        load()->func('tpl');

        include $this->template();
    }

    public function userList(){
        global $_W;
        global $_GPC;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $params = array();
        $condition='';

        $sql = '
            SELECT
            m.*
            ,SUM(msbl.buy_num) as buy_num
            ,MAX(msbl.buy_time) as buy_time
            FROM
            '.tablename('ewei_shop_member_stock_buy_log').' as msbl
            LEFT JOIN '.tablename('ewei_shop_member').' as m ON m.openid=msbl.openid
            WHERE m.uniacid='.$_W['uniacid'].' AND msbl.uniacid='.$_W['uniacid'].'
            '.$condition.'
            GROUP BY msbl.openid';
        $sql1 = $sql.' limit ' . ($pindex - 1) * $psize . ',' . $psize;
        $list = pdo_fetchall($sql1,$params);

        $sql2 = 'select count(1) from ('.$sql.') as temp';
        $total = pdo_fetchcolumn($sql2,$params);

        $pager = pagination2($total, $pindex, $psize);
        load()->func('tpl');

        include $this->template();
    }

    public function make(){
        global $_W;
        global $_GPC;

        if($_W['ispost']){
            $data_list = $_GPC['data'];
            foreach ($data_list as $data){
                $id = intval(trim($data['id']));
                $company_info = pdo_fetch('select * from '.tablename('ewei_shop_member_stock_company').' where id='.$id);
                $total_price = intval(trim($data['total_price']));
                $ratio = intval(trim($company_info['ratio']));
                $advname = trim($company_info['advname']);
                $stock_num = intval(trim($company_info['num']));

                if(!empty($total_price) && !empty($data['member_num'])){
                    $member_list = pdo_fetchall('SELECT openid,SUM(buy_num) as stock_num FROM '.tablename('ewei_shop_member_stock_buy_log')." WHERE msc_id='{$id}' and uniacid={$_W['uniacid']} GROUP BY openid ");
                    $m_ids = array();
                    $commission = array();
                    foreach ($member_list as $value){
                        $member = m("member")->getMember($value['openid']);
                        $m_ids[] = $member['id'];
                        $price = ($value['stock_num'] / $stock_num) * $total_price;
                        $commission[] = array('id'=>$member['id'],'stock_num'=>$value['stock_num'],'price'=>round($price, 2));
                    }
                    $insert_data = array(
                        'uniacid'       => $_W['uniacid']
                        ,'type'         => 2
                        ,'msc_id'       => $id
                        ,'advname'      => $advname
                        ,'m_ids'        => serialize($m_ids)
                        ,'commission'   => serialize($commission)
                        ,'total_price'  => $total_price
                        ,'ratio'        => $ratio
                        ,'is_bonus'     => 0
                        ,'create_time'  => time()
                    );
                    if(pdo_insert('ewei_shop_member_bonus2',$insert_data)){
                        $b_id = pdo_insertid();
                        foreach ($commission as $value){
                            $insert_data = array(
                                'uniacid'       => $_W['uniacid']
                                ,'msc_id'       => $id
                                ,'advname'      => $advname
                                ,'type'         => 2
                                ,'m_id'         => $value['id']
                                ,'buy_num'      => $value['stock_num']
                                ,'unit_price'   => round((1 / $stock_num) * $total_price,2)
                                ,'total_price'  => $total_price
                                ,'bouns_price'  => $value['price']
                                ,'b_id'         => $b_id
                                ,'create_time'  => time()
                            );
                            pdo_insert('ewei_shop_member_bonus2_log',$insert_data);
                        }
                    }
                }
            }
            show_json(1,'保存成功');
        }
        $company_list = pdo_fetchall("select * from ".tablename('ewei_shop_member_stock_company').' where uniacid ='. $_W['uniacid']);
        foreach ($company_list as $key=>$value){
            $company_list[$key]['member_num'] = pdo_fetchcolumn('select SUM(buy_num) from '.tablename('ewei_shop_member_stock_buy_log').' where msc_id='.$value['id']);
        }

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $params = array();
        $condition = ' ';
        $sql = 'select * from '.tablename('ewei_shop_member_bonus2').' where `type`=2 and uniacid='.$_W['uniacid'].$condition;
        $sql1 = $sql.' limit ' . ($pindex - 1) * $psize . ',' . $psize;
        $list = pdo_fetchall($sql1,$params);

        $sql2 = 'select count(1) from ('.$sql.') temp';
        $total = pdo_fetchcolumn($sql2,$params);

        $pager = pagination2($total, $pindex, $psize);
        load()->func('tpl');
        include $this->template();
    }

    public function bonusDelete(){
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);

        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }

        $items = pdo_fetchall('SELECT id FROM ' . tablename('ewei_shop_member_bonus2') . ' WHERE id in( ' . $id . ' ) AND uniacid=' . $_W['uniacid']);

        foreach ($items as $item) {
            pdo_delete('ewei_shop_member_bonus2', array('id' => $item['id']));
            plog('bonuscenyer.qqt.delete', '删除股权分红 ID: ' . $item['id']);
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
                m("member")->addLog($item2['m_id'],17,'股权分红',1,$item2['bouns_price'],"{$item2['total_price']}金额被{$item2['buy_num']}{$item2['advname']}分红{$item2['bouns_price']}金额");
                $member_info = m('member')->getMember($item2['m_id']);
                m("member")->setCredit($member_info['openid'],'credit2',$item2['bouns_price']);
            }
            pdo_update('ewei_shop_member_bonus2',array('is_bonus'=>1),array('id'=>$item['id']));
        }
        show_json(1, array('url' => referer()));
    }

    public function add(){
        $this->post();
    }
    public function edit(){
        $this->post();
    }
    public function delete(){
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);

        if (empty($id)) {
            $id = is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0;
        }

        $items = pdo_fetchall('SELECT id,advname FROM ' . tablename('ewei_shop_member_stock_company') . (' WHERE id in( ' . $id . ' ) AND uniacid=') . $_W['uniacid']);

        foreach ($items as $item) {
            pdo_delete('ewei_shop_member_stock_company', array('id' => $item['id']));
            plog('bonuscenyer.stock.delete', '删除股权公司 ID: ' . $item['id'] . ' 标题: ' . $item['advname'] . ' ');
        }

        show_json(1, array('url' => referer()));
    }

    protected function post()
    {
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);

        if ($_W['ispost']) {
            $data = array(
                'uniacid'       => $_W['uniacid'],
                'advname'       => trim($_GPC['advname']),
                'num'           => trim($_GPC['num']),
                'ratio'         => trim($_GPC['ratio']),
                'credit1'       => trim($_GPC['credit1'])
            );

            if (!empty($id)) {
                $data['update_time']   = time();
                pdo_update('ewei_shop_member_stock_company', $data, array('id' => $id));
                plog('shop.adv.edit', '修改股权公司 ID: ' . $id);
            }
            else {
                $data['create_time']   = time();
                pdo_insert('ewei_shop_member_stock_company', $data);
                $id = pdo_insertid();
                plog('bonuscenyer.stock.add', '添加股权公司 ID: ' . $id);
            }

            show_json(1, array('url' => webUrl('bonuscenter/stock/stockList')));
        }

        $item = pdo_fetch('select * from ' . tablename('ewei_shop_member_stock_company') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $id, ':uniacid' => $_W['uniacid']));
        include $this->template();
    }
}