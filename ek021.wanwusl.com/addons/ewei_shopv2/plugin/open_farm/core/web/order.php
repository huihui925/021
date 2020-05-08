<?php

if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Order_EweiShopV2Page extends PluginWebPage
{
	/**
	private $table = 'ewei_open_farm_order';
	/**
	private $field = array('id', 'uniacid', 'openid', 'username', 'market_id', 'market_title', 'receive', 'create_time');
	/**
	private $message = array();

	/**
	public function main()
	{
		require_once $this->template();
	}

	/**
	public function getList()
	{
		global $_W;
		global $_GPC;
		$currentPage = intval($_GPC['__input']['page']);
		$pageSize = 10;
		$condition = array('uniacid' => $_W['uniacid']);
		$sql = 'SELECT * FROM ' . tablename($this->table);
		$total = pdo_count($this->table, $condition);
		$sql .= ' ORDER BY `id` DESC ';
		$sql .= ' LIMIT ' . ($currentPage - 1) * $pageSize . ',' . $pageSize;
		$list = pdo_fetchall($sql);
		$context = array('before' => 5, 'after' => 4, 'ajaxcallback' => true, 'callbackfuncname' => 'function.get_list');
		$pages = pagination($total, $currentPage, $pageSize, '', $context);
		$this->model->returnJson($list, $pages);
	}
}

?>