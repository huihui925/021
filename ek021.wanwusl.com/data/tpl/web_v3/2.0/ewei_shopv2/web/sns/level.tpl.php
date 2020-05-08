<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary">会员等级管理</span>
</div>
<div class="page-content">
<form action="./index.php" method="get" class="form-horizontal form-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r"  value="sns.level" />
    <div class="page-toolbar m-b-sm m-t-sm">
        <div class="col-sm-4">
                <?php if(cv('sns.level.add')) { ?>
                <a class='btn btn-primary btn-sm' data-toggle="ajaxModal" href="<?php  echo webUrl('sns/level/add')?>"><i class='fa fa-plus'></i> 添加会员等级</a>
                <?php  } ?>
        </div>


        <div class="col-sm-6 pull-right">
            <div class="input-group">
                <div class="input-group-select">
                    <select name="enabled" class='form-control'>
                        <option value="" <?php  if($_GPC['enabled'] == '') { ?> selected<?php  } ?>>状态</option>
                        <option value="1" <?php  if($_GPC['enabled']== '1') { ?> selected<?php  } ?>>启用</option>
                        <option value="0" <?php  if($_GPC['enabled'] == '0') { ?> selected<?php  } ?>>禁用</option>
                    </select>
                </div>
                <input type="text" class=" form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit"> 搜索</button>
                </span>
            </div>

        </div>
    </div>
</form>

<form action="" method="post" >
    <div class="page-table-header">
        <input type="checkbox">
        <div class="btn-group">
            <?php if(cv('sns.level.edit')) { ?>
            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo webUrl('sns/level/enabled',array('enabled'=>1))?>">
                <i class='icow icow-qiyong'></i> 启用</button>
            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('sns/level/enabled',array('enabled'=>0))?>">
                <i class='icow icow-jinyong'></i> 禁用</button>
            <?php  } ?>
            <?php if(cv('sns.level.delete')) { ?>
            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('sns/level/delete')?>">
                <i class='icow icow-shanchu1'></i> 删除</button>
            <?php  } ?>
        </div>
    </div>
    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th style="width:25px;"></th>
            <th>等级名称</th>
            <th>升级条件</th>
            <th style="width:100px;">状态</th>
            <th style="width: 75px;">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>


        <tr <?php  if($row['id']=='default') { ?>style='background:#eee;<?php  if(!empty($_GPC['keyword'])) { ?>display:none;<?php  } ?>'<?php  } ?>>
        <td><?php  if($row['id']!='default') { ?>

            <input type='checkbox'   value="<?php  echo $row['id'];?>"/>
            <?php  } ?>
        </td>
        <td><?php  echo $row['levelname'];?></td>
        <td>
            <?php  if($row['id']=='default') { ?>
            默认等级
            <?php  } else { ?>

            <?php  if(empty($set['leveltype'])) { ?>
            <?php  if($row['credit']>0) { ?>
            社区积分达到 <?php  echo $row['credit'];?> 分
            <?php  } else { ?>
            不自动升级
            <?php  } ?>
            <?php  } ?>
            <?php  if($set['leveltype']==1) { ?>
            <?php  if($row['post']>0) { ?>
            主题数达到 <?php  echo $row['post'];?> 个
            <?php  } else { ?>
            不自动升级
            <?php  } ?>
            <?php  } ?>
            <?php  } ?>
        </td>
        <td>
            <?php  if($row['id']!='default') { ?>
            <span class='label <?php  if($row['enabled']==1) { ?>label-primary<?php  } else { ?>label-default<?php  } ?>'
            <?php if(cv('sns.level.edit')) { ?>
            data-toggle='ajaxSwitch'
            data-switch-value='<?php  echo $row['enabled'];?>'
            data-switch-value0='0|禁用|label label-default|<?php  echo webUrl('sns/level/enabled',array('enabled'=>1,'id'=>$row['id']))?>'
            data-switch-value1='1|启用|label label-primary|<?php  echo webUrl('sns/level/enabled',array('enabled'=>0,'id'=>$row['id']))?>'
            <?php  } ?>
            >
            <?php  if($row['enabled']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?></span>
            <?php  } ?>


        </td>
        <td>

            <?php if(cv('sns.level.view|sns.level.edit')) { ?>
            <a data-toggle="ajaxModal" href="<?php  echo webUrl('sns/level/edit', array('id' => $row['id']))?>" class="btn btn-default btn-sm btn-op btn-operation">
                 <span data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php if(cv('sns.level.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>">
                   <?php if(cv('sns.level.edit')) { ?>
                    <i class="icow icow-bianji2"></i>
                    <?php  } else { ?>
                    <i class="icow icow-chakan-copy"></i>
                    <?php  } ?>
                 </span>
            </a>
            <?php  } ?>
            <?php  if($row['id']!='default') { ?>
            <?php if(cv('sns.level.delete')) { ?>
            <a data-toggle='ajaxRemove' href="<?php  echo webUrl('sns/level/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm btn-op btn-operation" data-confirm='确认要删除此会员等级吗?'>
                <span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                    <i class="icow icow-shanchu1"></i>
                 </span>
            </a>
            <?php  } ?>
            <?php  } ?>
        </td>
            </tr>
            <?php  } } ?>
        </tbody>
        <tfoot>
            <tr>
                <td><input type="checkbox"></td>
                <td colspan="4">
                    <div class="btn-group">
                        <?php if(cv('sns.level.edit')) { ?>
                        <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo webUrl('sns/level/enabled',array('enabled'=>1))?>">
                            <i class='icow icow-qiyong'></i> 启用</button>
                        <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('sns/level/enabled',array('enabled'=>0))?>">
                            <i class='icow icow-jinyong'></i> 禁用</button>
                        <?php  } ?>
                        <?php if(cv('sns.level.delete')) { ?>
                        <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('sns/level/delete')?>">
                            <i class='icow icow-shanchu1'></i> 删除</button>
                        <?php  } ?>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

<!--青岛易联互动网络科技有限公司-->