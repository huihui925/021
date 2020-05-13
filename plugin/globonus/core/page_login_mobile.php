<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class GlobonusMobileLoginPage extends PluginMobileLoginPage
{
	public function __construct()
	{
		parent::__construct();
		global $_W;
		global $_GPC;
		if ($_W['action'] != 'register' && $_W['action'] != 'myshop' && $_W['action'] != 'share') {
			$member = m('member')->getMember($_W['openid']);
			if (empty($member['isagent']) || empty($member['status'])) {
				header('location: ' . mobileUrl('commission/register'));
				exit();
			}

			if (empty($member['ispartner']) || empty($member['partnerstatus'])) {
				header('location: ' . mobileUrl('globonus/register'));
				exit();
			}
		}
	}

	public function footerMenus($diymenuid = '', $ismerch = '', $texts = '')
	{
        global $_W;
        global $_GPC;
        $params = array(':uniacid' => $_W['uniacid'], ':openid' => $_W['openid']);
        $cartcount = pdo_fetchcolumn('select ifnull(sum(total),0) from ' . tablename('ewei_shop_member_cart') . ' where uniacid=:uniacid and openid=:openid and deleted=0 and isnewstore=0  and selected =1', $params);
        $commission = array();
        if (p('commission') && intval(0 < $_W['shopset']['commission']['level'])) {
            $member = m('member')->getMember($_W['openid']);

            if (!$member['agentblack']) {
                if ($member['isagent'] == 1 && $member['status'] == 1) {
                    $commission = array('url' => mobileUrl('commission'), 'text' => empty($_W['shopset']['commission']['texts']['center']) ? '分销中心' : $_W['shopset']['commission']['texts']['center']);
                }
                else {
                    $commission = array('url' => mobileUrl('commission/register'), 'text' => empty($_W['shopset']['commission']['texts']['become']) ? '成为分销商' : $_W['shopset']['commission']['texts']['become']);
                }
            }
        }

        $showdiymenu = false;
        $routes = explode('.', $_W['routes']);
        $controller = $routes[0];
        if ($controller == 'member' || $controller == 'cart' || $controller == 'order' || $controller == 'goods' || $controller == 'quick') {
            $controller = 'shop';
        }

        if (empty($diymenuid)) {
            $pageid = !empty($controller) ? $controller : 'shop';
            $pageid = $pageid == 'index' ? 'shop' : $pageid;
            if (!empty($_GPC['merchid']) && ($_W['routes'] == 'shop.category' || $_W['routes'] == 'goods')) {
                $pageid = 'merch';
            }

            if ($pageid == 'sale' && $_W['routes'] == 'sale.coupon.my.showcoupongoods') {
                $pageid = 'shop';
            }

            if ($pageid == 'merch' && !empty($_GPC['merchid']) && p('merch')) {
                $merchdata = p('merch')->getSet('diypage', $_GPC['merchid']);

                if (!empty($merchdata['menu'])) {
                    $diymenuid = $merchdata['menu']['shop'];
                    if (!is_weixin() || is_h5app()) {
                        $diymenuid = $merchdata['menu']['shop_wap'];
                    }
                }
            }
            else {
                $diypagedata = m('common')->getPluginset('diypage');

                if (!empty($diypagedata['menu'])) {
                    $diymenuid = $diypagedata['menu'][$pageid];
                    if (!is_weixin() || is_h5app()) {
                        $diymenuid = $diypagedata['menu'][$pageid . '_wap'];
                    }
                }
            }
        }

        if (!empty($diymenuid)) {
            $menu = pdo_fetch('SELECT * FROM ' . tablename('ewei_shop_diypage_menu') . ' WHERE id=:id and uniacid=:uniacid limit 1 ', array(':id' => $diymenuid, ':uniacid' => $_W['uniacid']));

            if (!empty($menu)) {
                $menu = $menu['data'];
                $menu = base64_decode($menu);
                $diymenu = json_decode($menu, true);
                $showdiymenu = true;
            }
        }

        if ($showdiymenu) {
            include $this->template('diypage/menu');
        } else {
            include $this->template('globonus/_menu');
        }
	}
}

?>
