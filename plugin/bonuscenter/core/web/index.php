<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/14 0014
 * Time: 22:01
 */

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Index_EweiShopV2Page extends PluginWebPage
{
    public function main(){
        if (cv('bonuscenter.qqt.userList')) {
            header('location: ' . webUrl('bonuscenter/qqt/userList'));
            exit();
        }
    }

    public function set(){
        global $_W;
        global $_GPC;

        if($_W['ispost']){
            $data = is_array($_GPC['data']) ? $_GPC['data'] : array();
            m('common')->updatePluginset(array('bonuscenter' => $data));
            show_json(1);
        }
        $data = m('common')->getPluginset('bonuscenter');

        include $this->template();
    }
}