<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary"><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>话题 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['title'];?>】<?php  } ?></small></span>
</div>

<div class="page-content">
    <div class="page-sub-toolbar">
        <span class=''>
            <?php if( ce('sns.posts' ,$item) ) { ?>
                <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('sns/posts/add')?>"><i class='fa fa-plus'></i> 发表话题</a>
            <?php  } ?>
            <?php if(cv('sns.posts.add')) { ?>
                <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('sns/board/add')?>"><i class='fa fa-plus'></i> 添加版块</a>
            <?php  } ?>

        </span>
    </div>
<form <?php if( ce('sns.posts' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class="tab-content ">
            <div class="tab-pane active">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-lg control-label must">版块</label>
                        <div class="col-sm-9 col-xs-12">

                            <?php if( ce('sns.posts' ,$item) ) { ?>
                            <select name='bid' class='form-control' data-rule-required="true">
                                <option value=""  <?php  if($item['bid']=='') { ?>selected<?php  } ?>>--请选择版块--</option>
                                <?php  if(is_array($board)) { foreach($board as $c) { ?>
                                <option value="<?php  echo $c['id'];?>" <?php  if($c['id']==$item['bid']) { ?>selected<?php  } ?>><?php  echo $c['title'];?></option>
                                <?php  } } ?>
                            </select>
                            <?php  } else { ?>
                            <div class='form-control-static'>

                                <?php  if(is_array($board)) { foreach($board as $c) { ?>
                                <?php  if($c['id']==$item['bid']) { ?><?php  echo $c['title'];?><?php  } ?>
                                <?php  } } ?>
                            </div>

                            <?php  } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg control-label must">话题标题</label>
                        <div class="col-sm-9 col-xs-12 ">
                            <?php if( ce('sns.posts' ,$item) ) { ?>
                            <input type="text" id='title' name="title" class="form-control" value="<?php  echo $item['title'];?>" data-rule-required="true"/>
                            <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['title'];?></div>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg control-label must">发帖管理员</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sns.posts' ,$item) ) { ?>
                            <select name='openid' class='form-control' data-rule-required="true">
                                <option value=""  <?php  if($item['openid']=='') { ?>selected<?php  } ?>>--请选择管理员--</option>
                                <?php  if(is_array($managers)) { foreach($managers as $c) { ?>
                                <option value="<?php  echo $c['openid'];?>" <?php  if($c['openid']==$item['openid']) { ?>selected<?php  } ?>><?php  echo $c['nickname'];?></option>
                                <?php  } } ?>
                            </select>
                            <?php  } else { ?>
                            <div class='form-control-static'>
                                <?php  if(is_array($managers)) { foreach($managers as $c) { ?>
                                <?php  if($c['openid']==$item['openid']) { ?><?php  echo $c['nickname'];?><?php  } ?>
                                <?php  } } ?>
                            </div>

                            <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg control-label">上传图片</label>
                        <div class="col-sm-9 col-xs-12 gimgs">
                            <?php if( ce('sns.posts' ,$item) ) { ?>
                            <?php  echo tpl_form_field_multi_image2('images',$piclist)?>
                            <span class="help-block image-block" style="display: block;">建议为正方型图片，并保持图片大小一致</span>
                            <span class="help-block">您可以拖动图片改变其显示顺序 </span>
                            <?php  } else { ?>
                            <?php  if(is_array($piclist)) { foreach($piclist as $p) { ?>
                            <a href='<?php  echo tomedia($p)?>' target='_blank'>
                                <img src="<?php  echo tomedia($p)?>" style='height:100px;border:1px solid #ccc;padding:1px;float:left;margin-right:5px;' />
                            </a>
                            <?php  } } ?>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg control-label">话题内容</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sns.posts' ,$item) ) { ?>
                            <?php  echo tpl_ueditor('content',$item['content'],array('height'=>'200'))?>
                            <?php  } else { ?>
                            <textarea id='detail' name='content' style='display:none;'><?php  echo $item['content'];?></textarea>
                            <a href="javascript:preview_html('#detail')" class="btn btn-default">查看内容</a>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg control-label">其他</label>
                        <div class="col-sm-9 col-xs-12">
                            <?php if( ce('sns.posts' ,$item) ) { ?>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="isboardbest" value="1" <?php  if(!empty($item['isboardbest'])) { ?>checked="true"<?php  } ?>   /> 板块精华
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="isbest" value="1" <?php  if(!empty($item['isbest'])) { ?>checked="true"<?php  } ?>   /> 全站精华
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="isboardtop" value="1" <?php  if(!empty($item['isboardtop'])) { ?>checked="true"<?php  } ?>   /> 版块置顶
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="istop" value="1" <?php  if(!empty($item['istop'])) { ?>checked="true"<?php  } ?>   /> 全站置顶
                            </label>
                            <?php  } else { ?>
                            <div class='form-control-static'>
                                <?php  if(!empty($item['isboardbest'])) { ?>版块精华<?php  } ?>
                                <?php  if(!empty($item['isbest'])) { ?>全站精华<?php  } ?>
                                <?php  if(!empty($item['isboardtop'])) { ?>版块置顶<?php  } ?>
                                <?php  if(!empty($item['istop'])) { ?>全站置顶<?php  } ?>
                            </div>
                            <?php  } ?>
                        </div>
                    </div>


                </div>
            </div>

        </div>

    <?php if( ce('sns.posts' ,$item) ) { ?>
<div class="form-group">
    <label class="col-lg control-label"></label>
    <div class="col-sm-9 col-xs-12">
        <input type="submit"  value="提交" class="btn btn-primary" />
        <a class="btn btn-default " href="<?php  echo webUrl('sns/posts')?>">返回列表</a>
    </div>
</div>
<?php  } ?>

</form>
</div>
<script language='javascript'>
    require(['bootstrap','jquery.ui'], function () {
        $('#myTab a').click(function (e) {
            $('#tab').val($(this).attr('href'));
            e.preventDefault();
            $(this).tab('show');
        })
        $('.multi-img-details').sortable();
    });
    /*var ue = UE.getEditor('content', {
        autoHeight: false,
        wordCount:true,
        maximumWords:1000
    });*/
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--4000097827-->