<?php defined('IN_IA') or exit('Access Denied');?><ol class="breadcrumb we7-breadcrumb">
	<a href="<?php  echo url('account/manage')?>"><i class="wi wi-back-circle"></i> </a>
	<li><a href="<?php  echo url('account/manage')?>">平台管理</a></li>
	<li><?php echo ACCOUNT_TYPE_NAME;?>设置</li>
</ol>
<div class="we7-head-info">
	<img src="<?php  echo $headimgsrc;?>" class="account-img logo" alt="">
	<div class="info">
		<div class="title">
			<?php  echo $account['name'];?>
		</div>
		<div class="type">
			<i class="wi wi-<?php  echo $account['type_sign']?>"></i>
			<?php  if($account['type'] == ACCOUNT_TYPE_APP_NORMAL) { ?>
			小程序
			<?php  } else { ?>
				<?php  if($account['level'] == 1) { ?>普通订阅号<?php  } ?>
				<?php  if($account['level'] == 2) { ?>普通服务号<?php  } ?>
				<?php  if($account['level'] == 3) { ?>认证订阅号<?php  } ?>
				<?php  if($account['level'] == 4) { ?>认证服务号/认证媒体/政府订阅号<?php  } ?>
				<?php  if($account['level'] == 0) { ?>---<?php  } ?>
			<?php  } ?>
		</div>
	</div>
	<?php  if($state == ACCOUNT_MANAGE_NAME_FOUNDER || $state == ACCOUNT_MANAGE_NAME_OWNER) { ?>
		<a href="<?php  echo url('account/manage/delete', array('uniacid' => $account['uniacid'], 'account_type' => ACCOUNT_TYPE))?>" class="btn btn-primary" onclick="return confirm('确认放入回收站吗？')">停 用</a>
	<?php  } ?>
</div>
<div class="clearfix"></div>
<div class="btn-group we7-btn-group ">
	
		<?php  if($state == ACCOUNT_MANAGE_NAME_FOUNDER || $state == ACCOUNT_MANAGE_NAME_OWNER || $state == ACCOUNT_MANAGE_NAME_VICE_FOUNDER) { ?>
		<a href="<?php  echo url('account/post/base', array('uniacid' => $account['uniacid'], 'acid' => $account['acid'], 'account_type' => ACCOUNT_TYPE))?>" class="btn btn-default <?php  if($do == 'base') { ?> active<?php  } ?>">基础信息</a>
		<?php  if(ACCOUNT_TYPE == ACCOUNT_TYPE_OFFCIAL_NORMAL || ACCOUNT_TYPE == ACCOUNT_TYPE_OFFCIAL_AUTH) { ?>
		<a href="<?php  echo url('account/post/sms', array('uniacid' => $account['uniacid'], 'acid' => $account['acid'], 'account_type' => ACCOUNT_TYPE))?>" class="btn btn-default <?php  if($do == 'sms') { ?> active<?php  } ?>">短信信息</a>
		<?php  } ?>
		<?php  } ?>
	
	
	<a href="<?php  echo url('account/post-user/edit', array('uniacid' => $account['uniacid'], 'acid' => $account['acid'], 'account_type' => ACCOUNT_TYPE))?>" class="btn btn-default <?php  if($action == 'post-user' && $do == 'edit') { ?> active<?php  } ?>">使用者管理</a>
	<?php  if($account->supportVersion) { ?>
		<a href="<?php  echo url('miniapp/manage/display', array('uniacid' => $account['uniacid'], 'account_type' => ACCOUNT_TYPE))?>" class="btn btn-default <?php  if($action == 'manage' && $do == 'display') { ?> active<?php  } ?>">版本管理</a>
	<?php  } ?>
	<a href="<?php  echo url('account/post/modules_tpl', array('uniacid' => $account['uniacid'], 'acid' => $account['acid'], 'account_type' => ACCOUNT_TYPE))?>" class="btn btn-default <?php  if($action == 'post' && $do == 'modules_tpl') { ?> active<?php  } ?>">可用应用模板/模块</a>
</div>