<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/14 0014
 * Time: 22:05
 */

if (!defined('IN_IA')) {
    exit('Access Denied');
}

if (!class_exists('BonuscenterModel')) {

    class BonuscenterModel extends PluginModel
    {
        public function getSet($uniacid = 0)
        {
            $set = parent::getSet($uniacid);
            $set['texts'] = array();
            return $set;
        }
    }
}