<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary">版块管理</span>
</div>
<div class="page-content">
<form action="./index.php" method="get" class="form-horizontal form-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r"  value="sns.board" />
    <div class="page-toolbar m-b-sm m-t-sm">
        <div class="col-sm-4">
            <span class=''>
                <?php if(cv('sns.board.add')) { ?>
                    <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('sns/board/add')?>"><i class='fa fa-plus'></i> 添加版块</a>
                <?php  } ?>
            </span>
        </div>
        <div class="col-sm-6 pull-right">
            <div class="input-group">
                <div class="input-group-select">
                    <select name="status" class='form-control '>
                        <option value="" <?php  if($_GPC['status'] == '') { ?> selected<?php  } ?>>状态</option>
                        <option value="1" <?php  if($_GPC['status']== '1') { ?> selected<?php  } ?>>显示</option>
                        <option value="0" <?php  if($_GPC['status'] == '0') { ?> selected<?php  } ?>>隐藏</option>
                    </select>
                </div>
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
            <?php if(cv('sns.board.edit')) { ?>
            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php  echo webUrl('sns/board/status',array('status'=>1))?>">
                <i class='icow icow-xianshi'></i> 显示</button>
            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('sns/board/status',array('status'=>0))?>">
                <i class='icow icow-yincang'></i> 隐藏</button>
            <?php  } ?>
            <?php if(cv('sns.board.delete')) { ?>
            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('sns/board/delete')?>">
                <i class='icow icow-shanchu1'></i> 删除</button>
            <?php  } ?>

        </div>
    </div>
    <table class="table table-responsive table-hover" >
        <thead class="navbar-inner">
        <tr>
            <th style="width:25px;"></th>
            <th style='width:40px'>顺序</th>
            <th style='width:80px; text-align: center;'>图标</th>
            <th>标题</th>
            <th  style='width:100px'>话题数</th>
            <th  style='width:100px' >关注数</th>
            <th style='width:100px'>显示</th>
            <th style="width: 145px;">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr>
            <td>
                <input type='checkbox'   value="<?php  echo $row['id'];?>"/>
            </td>
            <td>
                <?php if(cv('sns.board.edit')) { ?>
                <a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php  echo webUrl('sns/board/displayorder',array('id'=>$row['id']))?>" ><?php  echo $row['displayorder'];?></a>
                <?php  } else { ?>
                <?php  echo $row['displayorder'];?>
                <?php  } ?>
            </td>
            <td style="text-align: center;">
                <img style="width:30px;height:30px;padding1px;border:1px solid #ccc" src="<?php  echo tomedia($row['logo'])?>"onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'">
            </td>
            <td>
                <span class="text-primary">[<?php  echo $category[$row['cid']]['name'];?>]</span><br/><?php  echo $row['title'];?>
            </td>
            <td><?php  echo number_format($row['postcount'],0)?></td>
            <td><?php  echo number_format($row['followcount'],0)?></td>
            <td>

                <span class='label <?php  if($row['status']==1) { ?>label-primary<?php  } else { ?>label-default<?php  } ?>'
                <?php if(cv('sns.board.edit')) { ?>
                data-toggle='ajaxSwitch'
                data-switch-value='<?php  echo $row['status'];?>'
                data-switch-value0='0|隐藏|label label-default|<?php  echo webUrl('sns/board/status',array('status'=>1,'id'=>$row['id']))?>'
                data-switch-value1='1|显示|label label-primary|<?php  echo webUrl('sns/board/status',array('status'=>0,'id'=>$row['id']))?>'
                <?php  } ?>>
                <?php  if($row['status']==1) { ?>显示<?php  } else { ?>隐藏<?php  } ?>
                </span>


            </td>
            <td style="text-align:left;">
                <?php if(cv('sns.posts')) { ?>
                <a href="<?php  echo webUrl('sns/posts', array('id' => $row['id']))?>" class="btn btn-default btn-sm btn-op btn-operation">
                     <span data-toggle="tooltip" data-placement="top" title="" data-original-title="话题管理">
                        <i class="icow icow-info"></i>
                     </span>
                </a>
                <?php  } ?>

                <?php if(cv('sns.board.view|sns.board.edit')) { ?>
                <a href="<?php  echo webUrl('sns/board/edit', array('id' => $row['id']))?>" class="btn btn-default btn-sm  btn-op btn-operation">
                     <span data-toggle="tooltip" data-placement="top" title="" data-original-title=" <?php if(cv('sns.board.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>">
                      <?php if(cv('sns.board.edit')) { ?>
                        <i class="icow icow-bianji2"></i>
                        <?php  } else { ?>
                        <i class="icow icow-chakan-copy"></i>
                        <?php  } ?>
                     </span>
                </a>
                <?php  } ?>
                <?php if(cv('sns.board.delete')) { ?>
                <a data-toggle='ajaxRemove' href="<?php  echo webUrl('sns/board/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm  btn-op btn-operation" data-confirm='确认要删除此版块吗?'>
                     <span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                        <i class="icow icow-shanchu1"></i>
                     </span>
                </a>
                <?php  } ?>
                <a href="javascript:;" class='btn btn-default js-clip  btn-op btn-operation' data-url="<?php  echo mobileUrl('sns/board', array('id' => $row['id']),true)?>">
                     <span data-toggle="tooltip" data-placement="top" title="" data-original-title="复制链接">
                        <i class="icow icow icow-lianjie2"></i>
                     </span>
                </a>
                <a href="javascript:;" class="btn btn-default btn-sm  btn-op btn-operation">
                    <span style="cursor: pointer;" data-toggle="popover" data-trigger="hover" data-html="true" data-content="<img src='<?php  echo $row['qrcode'];?>' width='130' alt='链接二维码'>" data-placement="auto right">
                        <i class="icow icow-erweima3"></i>
                    </span>
                </a>
            </td>
        </tr>
        <?php  } } ?>
        <tr>
            <td colspan='8'>
                <div class='pagers' style='float:right;'>
                    <?php  echo $pager;?>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何版块!
        </div>
    </div>
    <?php  } ?>

</form>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--NDAwMDA5NzgyNw==-->