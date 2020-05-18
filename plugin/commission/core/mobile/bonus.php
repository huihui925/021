<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/18 0018
 * Time: 4:52
 */

if (!defined('IN_IA')) {
    exit('Access Denied');
}

require EWEI_SHOPV2_PLUGIN . 'commission/core/page_login_mobile.php';
class Bonus_EweiShopV2Page extends CommissionMobileLoginPage
{
    public function main(){
        global $_W;
        $list = pdo_fetchall('select * from '.tablename('ewei_shop_member_log').' where `type` in(11,12,13) and openid=:openid and uniacid=:uniacid',array(':uniacid'=>$_W['uniacid'],':openid'=>$_W['openid']));
        include $this->template();
    }
}