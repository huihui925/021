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
}