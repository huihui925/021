<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary">商户分类管理</span>
</div>
<div class="page-content">
<form action="./index.php" method="get" class="form-horizontal form-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r"  value="merch.category" />
    <div class="page-toolbar m-b-sm m-t-sm">
        <div class="col-sm-4">
               <span class='pull-left'>
                <?php if(cv('merch.category.add')) { ?>
                    <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('merch/category/add')?>"><i class='fa fa-plus'></i> 添加商户分类</a>
                <?php  } ?>
            </span>
        </div>

        <div class="col-sm-6 pull-right">
            <div class="input-group">
                <div class="input-group-select">
                    <select name="status" class='form-control'>
                        <option value="" <?php  if($_GPC['status'] == '') { ?> selected<?php  } ?>>状态</option>
                        <option value="1" <?php  if($_GPC['status']== '1') { ?> selected<?php  } ?>>启用</option>
                        <option value="0" <?php  if($_GPC['status'] == '0') { ?> selected<?php  } ?>>禁用</option>
                    </select>
                </div>
                <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"> 
                <span class="input-group-btn">
                	<button class="btn btn-primary" type="submit"> 搜索</button>
                </span>
            </div>
        </div>

    </div>
</form>

<form action="" method="post">
    <?php  if(count($list)>0) { ?>
    <div class="page-table-header">
        <input type="checkbox">
        <div class="btn-group">
            <?php if(cv('merch.category.edit')) { ?>
            <a class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo webUrl('merch/category/status',array('status'=>1))?>"><i class='icow icow-qiyong'></i> 启用</a>
            <a class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('merch/category/status',array('status'=>0))?>"><i class='icow icow-jinyong'></i> 禁用</a>
            <?php  } ?>
            <?php if(cv('merch.category.delete')) { ?>
            <a class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('merch/category/delete')?>"><i class='icow icow-shanchu1'></i> 删除</a>
            <?php  } ?>
        </div>

    </div>
    <table class="table table-responsive table-hover" >
        <thead class="navbar-inner">
        <tr>
            <th style="width:25px;"></th>
            <th>分类名称</th>
            <th>分类图标</th>
            <th>是否启用</th>
            <th style="width: 80px;">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr>
            <td>
                <input type='checkbox'   value="<?php  echo $row['id'];?>"/>
            </td>
         
            <td><?php  echo $row['catename'];?></td>
            <td>
                <img src="<?php  echo tomedia($row['thumb'])?>" style="width:40px;height:40px;padding:1px;border:1px solid #ccc;" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'"/>
            </td>
            <td>
                <span class='label <?php  if($row['status']==1) { ?>label-primary<?php  } else { ?>label-default<?php  } ?>'
                <?php if(cv('merch.category.edit')) { ?>
                data-toggle='ajaxSwitch'
                data-switch-value='<?php  echo $row['status'];?>'
                data-switch-value0='0|禁用|label label-default|<?php  echo webUrl('merch/category/status',array('status'=>1,'id'=>$row['id']))?>'
                data-switch-value1='1|启用|label label-success|<?php  echo webUrl('merch/category/status',array('status'=>0,'id'=>$row['id']))?>'
                <?php  } ?> >
                <?php  if($row['status']==1) { ?>启用<?php  } else { ?>禁用<?php  } ?>
                </span>
            </td>
            <td style="text-align:left;">

                <?php if(cv('merch.category.view|merch.category.edit')) { ?>
                <a href="<?php  echo webUrl('merch/category/edit', array('id' => $row['id']))?>" class="btn btn-default btn-sm btn-op btn-operation" >
                      <span data-toggle="tooltip" data-placement="top" title="" data-original-title=" <?php if(cv('merch.group.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>">
                        <i class='icow icow-bianji2'></i>
                   </span>
                </a>
                <?php  } ?>

                <?php if(cv('merch.category.delete')) { ?>
                <a data-toggle='ajaxRemove' href="<?php  echo webUrl('merch/category/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm btn-op btn-operation" data-confirm='确认要删除分类吗?'>
                  <span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                         <i class='icow icow-shanchu1'></i>
                    </span></a>
                <?php  } ?>
            </td>
        </tr>
        <?php  } } ?>
        </tbody>
        <tfoot>
            <tr>
                <td><input type="checkbox"></td>
                <td>
                    <div class="btn-group">
                        <?php if(cv('merch.category.edit')) { ?>
                        <a class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo webUrl('merch/category/status',array('status'=>1))?>"><i class='icow icow-qiyong'></i> 启用</a>
                        <a class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('merch/category/status',array('status'=>0))?>"><i class='icow icow-jinyong'></i> 禁用</a>
                        <?php  } ?>
                        <?php if(cv('merch.category.delete')) { ?>
                        <a class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('merch/category/delete')?>"><i class='icow icow-shanchu1'></i> 删除</a>
                        <?php  } ?>
                    </div>
                </td>
                <td colspan="3" class="text-right">
                    <?php  echo $pager;?>
                </td>
            </tr>
        </tfoot>
    </table>
    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何商户分组!
        </div>
    </div>
    <?php  } ?>

</form>

</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--OTEzNzAyMDIzNTAzMjQyOTE0-->