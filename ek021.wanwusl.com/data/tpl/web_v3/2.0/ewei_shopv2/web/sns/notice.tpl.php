<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class='page-header'>当前位置：<span class="text-primary">通知设置</span></div>
<div class="page-content">
    <div class='alert alert-primary'>
        请将公众平台模板消息所在行业选择为： IT科技/互联网|电子商务
    </div>

    <form <?php if(cv('sns.notice.edit')) { ?> action="" method="post" <?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data" >
    <input type='hidden' name='setid' value="<?php  echo $set['id'];?>" />
    <input type='hidden' name='op' value="notice" />
    <div class="panel panel-default">

        <div class='panel-body'>

            <div class="form-group">
                <label class="col-lg control-label">会员升级通知</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('sns.notice.edit')) { ?>
                    <!-- <input type="text" name="tm[templateid]" class="form-control" value="<?php  echo $set['tm']['templateid'];?>" />
                    <div class="help-block">公众平台模板消息编号: OPENTM200605630 </div> -->
                    <select class="select2 is_advanced" name="tm[sns_advanced]">
                        <option value=''>[默认]会员升级通知</option>
                        <?php  if(is_array($template_group['sns'])) { foreach($template_group['sns'] as $template_val) { ?>
                        <option value="<?php  echo $template_val['id'];?>" <?php  if($set['tm']['sns_template'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                        <?php  } } ?>
                    </select>
                    <span style="text-align: right;" class="is_advanced">
                            <label class="notice-default">
                                <input type="hidden" name="tm[sns_close_advanced]" value="<?php  echo intval($set['tm']['sns_close_advanced'])?>" />
                                <input class="js-switch small checkone" data-type="tpl-advanced" data-tag="sns"  type="checkbox" value="<?php  echo intval($set['tm']['sns_close_advanced'])?>" <?php  if(empty($set['tm']['sns_close_advanced'])) { ?>checked<?php  } ?>/>
                            </label>
                            <label style="display: none;">
                                <img src="../addons/ewei_shopv2/static/images/loading.gif" width="20" alt=""  onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'" />
                            </label>
                        </span>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $set['tm']['sns_template'];?></div>
                    <?php  } ?>

                </div>
            </div>

            <!--  <div class="form-group">
                 <label class="col-lg control-label">会员升级通知标题</label>
                 <div class="col-sm-9 col-xs-12">
                     <?php if(cv('sns.notice.edit')) { ?>
                     <input type="text" name="tm[upgrade_title]" class="form-control" value="<?php  echo $set['tm']['upgrade_title'];?>" />
                     <div class="help-block">默认为 "社区等级升级"</div>
                     <?php  } else { ?>
                         <div class="form-control-static"><?php  echo $set['tm']['upgrade_title'];?></div>
                     <?php  } ?>
                 </div>
             </div>

             <div class="form-group">
                 <label class="col-lg control-label">会员升级通知内容</label>
                 <div class="col-sm-9 col-xs-12">
                     <?php if(cv('sns.notice.edit')) { ?>
                     <textarea class="form-control" name="tm[upgrade_content]" rows="5"><?php  echo $set['tm']['upgrade_content'];?></textarea>
                     <span class="help-block">变量: [昵称] [新等级] [旧等级] [时间]</span>
                     <?php  } else { ?>
                     <div class="form-control-static"><?php  echo $set['tm']['upgrade_content'];?></div>
                     <?php  } ?>
                 </div>
             </div> -->

            <div class="form-group">
                <label class="col-lg control-label">评论通知</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('sns.notice.edit')) { ?>
                    <!-- <input type="text" name="tm[templateid]" class="form-control" value="<?php  echo $set['tm']['templateid'];?>" />
                    <div class="help-block">公众平台模板消息编号: OPENTM200605630 </div> -->
                    <select class="select2 is_advanced" name="tm[reply_advanced]">
                        <option value=''>[默认]评论通知</option>
                        <?php  if(is_array($template_group['sns'])) { foreach($template_group['sns'] as $template_val) { ?>
                        <option value="<?php  echo $template_val['id'];?>" <?php  if($set['tm']['reply_template'] == $template_val['id'] ) { ?>selected<?php  } ?>><?php  echo $template_val['title'];?></option>
                        <?php  } } ?>
                    </select>
                    <span style="text-align: right;" class="is_advanced">
                            <label class="notice-default">
                                <input type="hidden" name="tm[reply_close_advanced]" value="<?php  echo intval($set['tm']['reply_close_advanced'])?>" />
                                <input class="js-switch small checkone" data-type="tpl-advanced" data-tag="reply"  type="checkbox" value="<?php  echo intval($set['tm']['reply_close_advanced'])?>" <?php  if(empty($set['tm']['reply_close_advanced'])) { ?>checked<?php  } ?>/>
                            </label>
                            <label style="display: none;">
                                <img src="../addons/ewei_shopv2/static/images/loading.gif" width="20" alt=""  onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'" />
                            </label>
                        </span>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $set['tm']['reply_template'];?></div>
                    <?php  } ?>

                </div>
            </div>

            <!-- <div class="form-group">
                <label class="col-lg control-label">评论通知标题</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('sns.notice.edit')) { ?>
                    <input type="text" name="tm[reply_title]" class="form-control" value="<?php  echo $set['tm']['reply_title'];?>" />
                    <div class="help-block">默认为 "您的话题有新的评论"</div>
                    <?php  } else { ?>
                    <div class="form-control-static"><?php  echo $set['tm']['reply_title'];?></div>
                    <?php  } ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg control-label">评论通知内容</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('sns.notice.edit')) { ?>
                    <textarea class="form-control" name="tm[reply_content]" rows="5"><?php  echo $set['tm']['reply_content'];?></textarea>
                    <span class="help-block">变量: [版块] [话题] [评论者] [内容] [时间] </span>
                    <?php  } else { ?>
                    <div class="form-control-static"><?php  echo $set['tm']['reply_content'];?></div>
                    <?php  } ?>
                </div>
            </div> -->



            <div class="form-group"></div>
            <div class="form-group">
                <label class="col-lg control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('sns.notice.edit')) { ?>
                    <input type="submit" value="提交" class="btn btn-primary"  />

                    <?php  } ?>
                </div>
            </div>


        </div>

    </div>
    </form>
</div>
<script>
    $(function(){
        $(".js-switch").not(".checkhi").click(function () {
            var next = $(this).next();
            if(next.hasClass('checked')){
                $(this).val("1").prev().val("0");
            }else{
                $(this).val("0").prev().val("1");
            }
        });
        //开启通知
        $(".checkone").click(function () {
            var _this =$(this);
            var type = _this.data('type');
            var val = _this.val();

            var tag = _this.data('tag');
            var stop = _this.data('stop');

            if(stop==1)
            {
                return;
            }

            //判断是否开启模板通知
            if(tag != '' && val==1&&type=='tpl-advanced') {
                $(this).data('stop', 1);
                $(this).parent().hide().next().show();

                var data = {
                    'tag': tag,
                    checked:val
                };
                //申请微信模板,并将模板ID更新至数据库.
                $.ajax({
                    url: "<?php  echo webUrl('sysset/settemplateid')?>",
                    type:'get',
                    dataType:'json',
                    timeout : 3000, //超时时间设置，单位毫秒
                    data:data,
                    success:function(ret){console.log(ret);
                        var _this = $(".checkone[data-tag='"+ret.result.tag+"']");
                        if (ret.result.status == '0') {
                            this.value=0;
                            _this.prev().val(1);
                            _this.next().removeClass('checked');

                            console.log(ret.result.messages);
                            alert(ret.result.messages);
                        }

                        $(_this).data('stop', 0);
                        $(_this).parent().show().next().hide();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        $(".table").each(function () {
                            var _this = $(this);
                            _this.find(".checkone[data-type='tpl-advanced']").each(function () {
                                $(this).data('stop', 0);
                                $(this).parent().show().next().hide();
                            });
                        });
                    }
                });
            }
        });
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>     