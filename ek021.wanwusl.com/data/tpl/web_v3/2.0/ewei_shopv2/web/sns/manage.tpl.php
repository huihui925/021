<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header">
    当前位置：<span class="text-primary">版主管理</span>
</div>

<div class="page-content">
<form action="./index.php" method="get" class="form-horizontal form-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="sns.manage" />
    <div class="page-toolbar m-b-sm m-t-sm">
        <div class="col-sm-4">
            <span class=''>
                <?php if(cv('sns.manage.add')) { ?>
                    <a class='btn btn-primary btn-sm' data-toggle="ajaxModal" href="<?php  echo webUrl('sns/manage/add')?>"><i class='fa fa-plus'></i> 添加版主</a>
                <?php  } ?>
            </span>
        </div>
        <div class="col-sm-6 pull-right">
            <div class="input-group">				 
                <input type="text" class=" form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"> <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit"> 搜索</button> </span>
            </div>

        </div>
    </div>
</form>

<form action="" method="post">
    <?php  if(count($list)>0) { ?>
    <div class="page-table-header">
        <input type="checkbox">
        <div class="btn-group">
            <?php if(cv('sns.manage.delete')) { ?>
            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('sns/manage/delete')?>">
                <i class='icow icow-shanchu1'></i> 删除</button>
            <?php  } ?>
        </div>
    </div>
    <table class="table table-responsive table-hover" >
        <thead class="navbar-inner">
            <tr>
                <th style="width:25px;"></th>
                <th>版块</th>
                <th>版主</th>
                <th></th>
                <th style="width: 75px;">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
                <td style="position: relative; ">
                    <input type='checkbox'   value="<?php  echo $row['id'];?>"/></td>
                <td><?php  echo $row['title'];?></td>
                <td  >
                    <div  >
                        <?php  if(!empty($row['avatar'])) { ?>
                        <img class="radius50" src='<?php  echo $row['avatar'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' onerror="this.src='../addons/ewei_shopv2/static/images/noface.png'"/>
                        <?php  } ?>
                        <?php  if(empty($row['nickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['nickname'];?><?php  } ?>
                    </div>
                </td>
                <td><?php  echo $row['realname'];?><br/><?php  echo $row['mobile'];?></td>

                    <td style="text-align:left;">
                        <?php if(cv('sns.manage.view|sns.manage.edit')) { ?>
	                        <a data-toggle="ajaxModal" href="<?php  echo webUrl('sns/manage/edit', array('id' => $row['id']))?>" class="btn btn-default btn-sm btn-op btn-operation">
                                 <span data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php if(cv('sns.manage.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>">
                                     <?php if(cv('sns.manage.edit')) { ?>
                                        <i class="icow icow-bianji2"></i>
                                        <?php  } else { ?>
                                        <i class="icow icow-chakan-copy"></i>
                                        <?php  } ?>
                                 </span>
	                        </a>
                        <?php  } ?>
                        <?php if(cv('sns.manage.delete')) { ?>
                        	<a data-toggle='ajaxRemove' href="<?php  echo webUrl('sns/manage/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm btn-op btn-operation" data-confirm='确认要删除此幻灯片吗?'>
                                 <span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                                    <i class="icow icow-shanchu1"></i>
                                 </span>
                            </a>
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
                        <?php if(cv('sns.manage.delete')) { ?>
                        <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('sns/manage/delete')?>">
                            <i class='icow icow-shanchu1'></i> 删除</button>
                        <?php  } ?>
                    </div>
                </td>
                <td class="text-right" colspan="3"> <?php  echo $pager;?></td>
            </tr>
        </tfoot>
        </table>
        <?php  } else { ?>
        <div class='panel panel-default'>
            <div class='panel-body' style='text-align: center;padding:30px;'>
                暂时没有任何版主!
            </div>
        </div>
        <?php  } ?>

    </form>
</div>

    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
