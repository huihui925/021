<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/11 0011
 * Time: 18:20
 */
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Provide_EweiShopV2Page extends WebPage
{

    public function main(){

        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;

        $request = p("commission")->provideList($pindex, $psize);
        $list = $request['list'];

        $pindex = $request['pager']['pindex'];
        $psize = $request['pager']['psize'];
        $total = $request['pager']['total'];
        $pager = pagination2($total, $pindex, $psize);

        include $this->template();
    }
}