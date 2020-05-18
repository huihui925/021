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
        include $this->template();
    }

    public function userList(){
        include $this->template();
    }

    public function make(){
        include $this->template();
    }
}