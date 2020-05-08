<?php defined('IN_IA') or exit('Access Denied');?><form action="" <?php if( ce('commission.level' ,$level) ) { ?>action="" method="post"<?php  } ?>  class="form-horizontal form-validate" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php  echo $level['id'];?>" />
<input type="hidden" name="r" value="sns.level.<?php  if(empty($level['id'])) { ?>add<?php  } else { ?>edit<?php  } ?>" />
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title"><?php  if(!empty($level['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>会员等级</h4>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <label class="col-sm-2 control-label must">等级名称</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sns.level' ,$level) ) { ?>
                    <input type="text" name="levelname" class="form-control" value="<?php  echo $level['levelname'];?>" data-rule-required='true'/>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $level['levelname'];?></div>
                    <?php  } ?>
                </div>
            </div>
            <?php  if($id!='default') { ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">升级条件</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sns.level' ,$level) ) { ?>
                    <div class='input-group'>
                        <?php  if(empty($set['leveltype'])) { ?>
                        <span class='input-group-addon'>社区积分达到</span>
                        <input type="text" name="credit" class="form-control" value="<?php  echo $level['credit'];?>" />
                        <span class='input-group-addon'>分</span>
                        <?php  } ?>
                        <?php  if($set['leveltype']==1) { ?>
                        <span class='input-group-addon'>话题达到</span>
                        <input type="text" name="post" class="form-control" value="<?php  echo $level['post'];?>" />
                        <span class='input-group-addon'>个</span>

                        <?php  } ?>
                    </div>
                    <span class='help-block'>会员升级条件，不填写默认为不自动升级, 设置<a href="<?php  echo webUrl('sns/set')?>">【会员升级依据】</a> </span>
                    <?php  } else { ?>
                    <div class='form-control-static'>

                        <?php  if(empty($set['leveltype'])) { ?>
                        <?php  if($level['credit']>0) { ?>
                        社区积分达到 <?php  echo $level['credit'];?> 分
                        <?php  } else { ?>
                        不自动升级
                        <?php  } ?>
                        <?php  } ?>
                        <?php  if($set['leveltype']==1) { ?>
                        <?php  if($level['post']>0) { ?>
                        话题达到 <?php  echo $level['post'];?>个
                        <?php  } else { ?>
                        不自动升级
                        <?php  } ?>
                        <?php  } ?>

                    </div>
                    <?php  } ?>
                </div>
            </div>
            <?php  } ?>

            <div class="form-group">
                <label class="col-sm-2 control-label must">标签背景</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sns.level' ,$level) ) { ?>
                       <?php echo tpl_form_field_color('bg',empty($level['bg'])?'#999':$level['bg'])?>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $level['bg'];?></div>
                    <?php  } ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label must">标签颜色</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sns.level' ,$level) ) { ?>
                    <?php echo tpl_form_field_color('color',empty($level['color'])?'#333':$level['color'])?>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $level['color'];?></div>
                    <?php  } ?>
                </div>
            </div>
            <?php  if($id!='default') { ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('sns.level' ,$level) ) { ?>
                    <label class='radio-inline'>
                        <input type='radio' name='enabled' value=1' <?php  if($level['enabled']==1) { ?>checked<?php  } ?> /> 启用
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='enabled' value=0' <?php  if($level['enabled']==0) { ?>checked<?php  } ?> /> 禁用
                    </label>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  if(empty($level['enabled'])) { ?>禁用<?php  } else { ?>启用<?php  } ?></div>
                    <?php  } ?>
                </div>
            </div>
            <?php  } ?>

        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">提交</button>
            <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
        </div>
    </div>
    </form>
