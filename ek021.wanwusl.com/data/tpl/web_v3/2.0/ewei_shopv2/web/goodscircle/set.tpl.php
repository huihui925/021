<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary">好物圈</span>
</div>

<div class="page-content ">
    <div class="alert alert-primary">
        <p>注意：开启好物圈功能前，请先确认已发布好物圈版小程序，<a href="<?php  echo webUrl('app/newrelease')?>" target="_blank">前往发布</a>。</p>
    </div>
    <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
        <div class="panel " >
            <div class="panel-body">
                <div class="col-sm-1 col-xs-12">
                    <h4 class="set_title">商品详情推荐</h4>
                </div>
                <div  style="padding-top:12px;" >
                    <?php if(cv('goodscircle.set.main')) { ?>
                    <input type="checkbox" class="js-switch small checkone" name="goods_share" data-type="goods_share" value="0" <?php  if($set['goods_share']==1) { ?>checked<?php  } ?> />
                    <?php  } else { ?>
                    <?php  if($set['goods_share']==1) { ?>
                    <span class='text-success'>开启</span>
                    <?php  } else { ?>
                    <span class='text-default'>关闭</span>
                    <?php  } ?>
                    <?php  } ?>
                    <span class='help-block'> 可从商品详情页直接将物品推荐到好物圈 </span>
                </div>
                <div style="padding-top:12px;display: none;">
                    <img src="../addons/ewei_shopv2/static/images/loading.gif" width="20" alt=""  onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'" />
                    <span class='help-block'> 可从商品详情页直接将物品推荐到好物圈 </span>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-sm-1 col-xs-12">
                    <h4 class="set_title">订单推荐</h4>
                </div>
                <div  style="padding-top:12px;" >
                    <?php if(cv('goodscircle.set.main')) { ?>
                    <input type="checkbox" class="js-switch small checkone" name="order" data-type="order" value="0" <?php  if($set['order']==1) { ?>checked<?php  } ?> />
                    <?php  } else { ?>
                    <?php  if($set['order']==1) { ?>
                    <span class='text-success'>开启</span>
                    <?php  } else { ?>
                    <span class='text-default'>关闭</span>
                    <?php  } ?>
                    <?php  } ?>
                    <span class='help-block'> 将用户的订单信息同步至好物圈，同步后用户可选择是否分享 </span>
                </div>
                <div style="padding-top:12px;display: none;">
                    <img src="../addons/ewei_shopv2/static/images/loading.gif" width="20" alt=""  onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'" />
                    <span class='help-block'> 将用户的订单信息同步至好物圈，同步后用户可选择是否分享 </span>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-sm-1 col-xs-12">
                    <h4 class="set_title">购物车分享</h4>
                </div>
                <div  style="padding-top:12px;" >
                    <?php if(cv('goodscircle.set.main')) { ?>
                    <input type="checkbox" class="js-switch small checkone" name="cart" data-type="cart" value="0" <?php  if($set['cart']==1) { ?>checked<?php  } ?> />
                    <?php  } else { ?>
                    <?php  if($set['cart']==1) { ?>
                    <span class='text-success'>开启</span>
                    <?php  } else { ?>
                    <span class='text-default'>关闭</span>
                    <?php  } ?>
                    <?php  } ?>
                    <span class='help-block'> 将用户的购物车信息导入好物圈，导入后，用户可选择是否分享 </span>
                </div>
                <div style="padding-top:12px;display: none;">
                    <img src="../addons/ewei_shopv2/static/images/loading.gif" width="20" alt=""  onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'" />
                    <span class='help-block'> 将用户的购物车信息导入好物圈，导入后，用户可选择是否分享 </span>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-sm-1 col-xs-12">
                    <h4 class="set_title">物品信息同步</h4>
                </div>
                <div  style="padding-top:12px;" >
                    <?php if(cv('goodscircle.set.main')) { ?>
                    <input type="checkbox" class="js-switch small checkone" name="goods_sync" data-type="goods_sync" value="0" <?php  if($set['goods_sync']==1) { ?>checked<?php  } ?> />
                    <?php  } else { ?>
                    <?php  if($set['goods_sync']==1) { ?>
                    <span class='text-success'>开启</span>
                    <?php  } else { ?>
                    <span class='text-default'>关闭</span>
                    <?php  } ?>
                    <?php  } ?>
                    <span class='help-block'> 可以对好物圈收藏/搜索场景下物品信息进行导入或更新 </span>
                </div>
                <div style="padding-top:12px;display: none;">
                    <img src="../addons/ewei_shopv2/static/images/loading.gif" width="20" alt=""  onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'" />
                    <span class='help-block'> 可以对好物圈收藏/搜索场景下物品信息进行导入或更新 </span>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(function () {
        $(".js-switch").not(".checkhi").click(function () {
            var next = $(this).next();
            if(next.hasClass('checked')){
                $(this).val("1").prev().val("0");
            }else{
                $(this).val("0").prev().val("1");
            }
        });
        $(".checkone").click(function () {
            var _this = $(this);
            var type = _this.data('type');
            var val = _this.val();
            $(this).parent().hide().next().show();
            var data = {
                'type': type,
                'status':val
            };
            $.ajax({
                url: "<?php  echo webUrl('goodscircle/set')?>",
                type:'post',
                dataType:'json',
                timeout : 3000, //超时时间设置，单位毫秒
                data:data,
                success:function(ret){
                    if (ret.status == '0') {
                        if(val == 1){
                            $(_this).next().removeClass('checked');
                        }else{
                            $(_this).next().addClass('checked');
                        }
                        tip.msgbox.err(ret.result.message);
                    }else{
                        tip.msgbox.suc("操作成功！");
                    }
                    $(_this).parent().show().next().hide();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $(_this).parent().show().next().hide();
                    if(val == 1){
                        $(_this).next().removeClass('checked');
                    }else{
                        $(_this).next().addClass('checked');
                    }
                }
            });
        })
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
