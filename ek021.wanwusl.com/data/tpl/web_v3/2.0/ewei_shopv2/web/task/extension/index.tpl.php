<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary">所有任务</span>
</div>
<div class="page-content">
<form action="" method="get" class="form-horizontal" role="form">
    <input type="hidden" name="c" value="site">
    <input type="hidden" name="a" value="entry">
    <input type="hidden" name="m" value="ewei_shopv2">
    <input type="hidden" name="do" value="web">
    <input type="hidden" name="r" value="<?php  echo $_GPC['r'];?>">
    <div class="page-toolbar m-b-sm m-t-sm">
        <div class="col-sm-4">
            <span class="">
                <a href="<?php  echo webUrl('task.extension.'.$action,array('taskfunc'=>'add'),1);?>" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> 添加新任务</a>
            </span>
        </div>
        <div class="col-sm-6 pull-right">
            <div class="input-group">
                <input type="text" class=" form-control" name="keyword" value="" placeholder="请输入关键词"><span class="input-group-btn">
                <button class="btn  btn-primary" type="submit"> 搜索</button> </span>
            </div>
        </div>
    </div>
</form>
    <?php  if(count( $list)>0) { ?>
<form action="" method="post">
    <div class="page-table-header">
        <input type="checkbox">
        <div class="btn-group">
            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch-remove" data-confirm="确认要删除?" data-href="<?php  echo webUrl('task/extension/'.$this->action,array('taskfunc'=>'delete'));?>" disabled="disabled">
                <i class="icow icow-shanchu1"></i> 删除
            </button>
        </div>
    </div>
    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th style="width:25px;"></th>
            <th>任务名称</th>
            <th>开启时间</th>
            <th>状态</th>
            <th style="width: 65px;">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $k => $v) { ?>
        <tr>
            <td><input type="checkbox" value="<?php  echo $v['id'];?>"></td>
            <td><?php  echo $v['title'];?></td>
            <td><?php  echo date('Y-m-d H:i', $v['starttime'])?> <br><?php  echo date('Y-m-d H:i', $v['endtime'])?></td>
            <td>
                <?php  if(!empty($v['status'])) { ?>
                    <span class="label label-primary">开启</span>
                <?php  } else { ?>
                    <span class="label label-danger">关闭</span>
                <?php  } ?>
            </td>
            <td>
                <!--<a class="btn btn-default btn-sm" href="<?php  echo webUrl('task/extension/'.$this->action,array('taskfunc'=>'record','id'=>$v['id']));?>"><i class="fa fa-qrcode"></i> 参与记录</a>-->
                <a class="btn btn-default btn-sm btn-op btn-operation" href="<?php  echo webUrl('task/extension/'.$this->action,array('taskfunc'=>'add','id'=>$v['id']));?>">
                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="编辑">
                        <i class="icow icow-bianji2"></i>
                     </span>
                </a>
                <a class="btn btn-default btn-sm  btn-op btn-operation" data-toggle="ajaxRemove" href="<?php  echo webUrl('task/extension/'.$this->action,array('taskfunc'=>'delete','ids'=>$v['id']));?>" title="删除" data-confirm="确认删除此任务吗？">
                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                        <i class="icow icow-shanchu1"></i>
                     </span>
                </a>
            </td>
        </tr>
        <?php  } } ?>
        </tbody>
        <tfoot>
            <tr>
                <td><input type="checkbox"></td>
               <td colspan="2">
                   <div class="btn-group">
                       <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch-remove" data-confirm="确认要删除?" data-href="<?php  echo webUrl('task/extension/'.$this->action,array('taskfunc'=>'delete'));?>" disabled="disabled">
                           <i class="icow icow-shanchu1"></i> 删除
                       </button>
                   </div>
               </td>
                <td colspan="2" class="text-right"><?php  echo $pager;?></td>
            </tr>
        </tfoot>
    </table>
</form>
    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何任务
        </div>
    </div>
    <?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>