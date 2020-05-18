<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/14 0014
 * Time: 22:46
 */
if (!defined('IN_IA')) {
    exit('Access Denied');
}

return array(
    'version' => '1.0',
    'id'      => 'bonuscenter',
    'name'    => '分红中心',
    'v3'      => true,
    'menu'    => array(
        'title'     => '页面',
        'plugincom' => 1,
        'icon'      => 'page',
        'items'     => array(
            array(
                'title' => '紫钻',
                'items' => array(
                    array('title' => '紫钻用户', 'route' => 'qqt.userList'),
                    array('title' => '操作分红', 'route' => 'qqt.make'),
                ),
            ),
            array(
                'title' => '股权',
                'items' => array(
                    array('title' => '公司列表', 'route' => 'stock.stockList'),
                    array('title' => '股权用户', 'route' => 'stock.userList'),
                    array('title' => '操作分红', 'route' => 'stock.make'),
                ),
            ),
        )
    )
);

?>
