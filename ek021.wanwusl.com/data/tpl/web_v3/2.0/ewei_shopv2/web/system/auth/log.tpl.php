<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header">
    <span class='pull-right'>
        <?php  if(!empty($result['status'])) { ?>
            <span class='label label-primary'>更新服务到期时间:  <?php  echo $result['result']['auth_date_end'];?></span>
        <?php  } ?>
    </span>
    当前位置：<span class="text-primary">历史日志</span>
</div>

<div class="page-content">
    <div class="col-sm-12 col-xs-12">
        <div class="form-control-static" id="check">
            <div class="panel-body" style="padding: 15px 0px;">
                <div class="panel-group" id="version">
                    <?php  echo $log;?>
                </div>
            </div>
        </div>
    </div>
  <span class="text-right">  <?php  echo $pager;?></span>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>