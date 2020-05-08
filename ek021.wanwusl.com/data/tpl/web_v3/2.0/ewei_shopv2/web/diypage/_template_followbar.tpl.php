<?php defined('IN_IA') or exit('Access Denied');?><script type="text/html" id="tpl_show_followbar">

    <div class="diy-followbar" style="background: <%style.background||'#444444'%>;">
        <div class="logo <%params.iconstyle%>">
            <%if params.icontype==1||params.icontype==2%>
                <img src="<%imgsrc params.logo%>" />
            <%/if%>
            <%if params.icontype==3%>
                <img src="<%imgsrc params.iconurl%>" />
            <%/if%>
        </div>
        <div class="text"><div class="inner" style="color: <%style.textcolor||'#ffffff'%>;"><%=params.sharetext||params.defaulttext||'欢迎访问[商城名称]<br>点击关注我们哦~'%></div></div>
        <div class="btn" style="background: <%style.btnbgcolor||'#04be02'%>; color: <%style.btncolor||'#ffffff'%>;"><%if params.btnicon%><i class="icon <%params.btnicon%>" style="font-size: 10px;"></i> <%/if%><%params.btntext||'点击关注'%></div>
    </div>

    <div class="diymenu-page" style="line-height: 450px;">这里是页面内容</div>

</script>

<script type="text/html" id="tpl_edit_followbar">

    <div class="form-group">
        <div class="col-sm-2 control-label">显示类型</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="showtype" value="0" class="diy-bind" data-bind-child="params" data-bind="showtype" <%if params.showtype==0||!params.showtype%>checked="checked"<%/if%>> 关注后隐藏</label>
            <label class="radio-inline"><input type="radio" name="showtype" value="1" class="diy-bind" data-bind-child="params" data-bind="showtype" <%if params.showtype==1%>checked="checked"<%/if%>> 始终显示</label>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-10" style="width: 210px">
            <div class="input-group">
                <span class="input-group-addon">默认</span>
                <input class="form-control input-sm diy-bind color" type="color" data-bind-child="style" data-bind="background" value="<%style.background%>" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#444444').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">图标设置</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="icontype" value="1" class="diy-bind" data-bind-child="params" data-bind="icontype" data-bind-init="true" <%if params.icontype==1%>checked="checked"<%/if%>> 分享人头像</label>
            <label class="radio-inline"><input type="radio" name="icontype" value="2" class="diy-bind" data-bind-child="params" data-bind="icontype" data-bind-init="true" <%if params.icontype==2%>checked="checked"<%/if%>> 商城logo</label>
            <label class="radio-inline"><input type="radio" name="icontype" value="3" class="diy-bind" data-bind-child="params" data-bind="icontype" data-bind-init="true" <%if params.icontype==3%>checked="checked"<%/if%>> 自定义</label>
            <%if params.icontype==1%>
                <div class="help-block">提示：如果分享人为空则使用商城logo</div>
            <%/if%>
        </div>
    </div>

    <%if params.icontype==3%>
        <div class="form-group">
            <div class="col-sm-2 control-label">图标图片</div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="iconurl" value="<%params.iconurl%>" id="iconurl">
                    <span data-input="#iconurl" data-img="#iconimg" data-toggle="selectImg" class="input-group-addon btn btn-default">选择图片</span>
                </div>
                <div class="input-group " style="margin-top:.5em;">
                    <img src="<%imgsrc params.iconurl%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" class="img-responsive img-thumbnail" width="60" id="iconimg">
                    <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="$('#iconsrc').val('').trigger('change');$(this).prev().attr('src', '')">×</em>
                </div>
                <div class="help-block">提示：图标请选择正方形</div>
            </div>
        </div>
    <%/if%>

    <div class="form-group">
        <div class="col-sm-2 control-label">图标形状</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="iconstyle" value="" class="diy-bind" data-bind-child="params" data-bind="iconstyle" <%if params.iconstyle==''%>checked="checked"<%/if%>> 正方形</label>
            <label class="radio-inline"><input type="radio" name="iconstyle" value="radius" class="diy-bind" data-bind-child="params" data-bind="iconstyle" <%if params.iconstyle=='radius'%>checked="checked"<%/if%>> 圆角</label>
            <label class="radio-inline"><input type="radio" name="iconstyle" value="circle" class="diy-bind" data-bind-child="params" data-bind="iconstyle" <%if params.iconstyle=='circle'%>checked="checked"<%/if%>> 圆形</label>
        </div>
    </div>


    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">默认文字</div>
        <div class="col-sm-10">
            <textarea class="form-control diy-bind" placeholder="例：欢迎访问[商城名称]，点击关注我们哦~" style="padding: 5px; resize: none;" rows="2" data-bind-child="params" data-bind="defaulttext"><%params.defaulttext%></textarea>
            <div class="help-block">无分享人时显示，可用变量[商城名称]</div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">分享文字</div>
        <div class="col-sm-10">
            <textarea class="form-control diy-bind" placeholder="例：亲爱的用户: [访问者], 您的好友[邀请人]邀请您关注[商城名称]~" style="padding: 5px; resize: none;" rows="2" data-bind-child="params" data-bind="sharetext"><%params.sharetext%></textarea>
            <div class="help-block">有分享人时显示，可用变量[商城名称]、[邀请人]、[访问者]</div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">文字颜色</div>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-addon">默认</span>
                <input class="form-control input-sm diy-bind color" type="color" data-bind-child="style" data-bind="textcolor" value="<%style.textcolor%>" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
                <span class="input-group-addon" style="border-left: 0; border-right: 0;">高亮</span>
                <input class="form-control input-sm diy-bind color" type="color" data-bind-child="style" data-bind="highlight" value="<%style.highlight%>" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
            <div class="help-block">[商城名称]、[邀请人]、[访问者] 自动高亮，不设置则不进行高亮显示。</div>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">按钮颜色</div>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-addon">背景</span>
                <input class="form-control input-sm diy-bind color" type="color" data-bind-child="style" data-bind="btnbgcolor" value="<%style.btnbgcolor%>" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#04be02').trigger('propertychange')">重置</span>
                <span class="input-group-addon" style="border-left: 0; border-right: 0;">文字</span>
                <input class="form-control input-sm diy-bind color" type="color" data-bind-child="style" data-bind="btncolor" value="<%style.btncolor%>" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">按钮文字</div>
        <div class="col-sm-10">
            <div class="input-group">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="btntext" value="<%params.btntext%>" />
                <input type="hidden" class="diy-bind" data-bind-child="params" data-bind="btnicon" id="btnicon"/>
                <span data-input="#btnicon" data-toggle="selectIcon" class="input-group-addon btn btn-default">选择图标</span>
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().prev().val('').trigger('change');">清除</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">按钮事件</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="btnclick" value="0" class="diy-bind" data-bind-child="params" data-bind="btnclick" data-bind-init="true" <%if params.btnclick==0%>checked="checked"<%/if%>> 跳转链接</label>
            <label class="radio-inline"><input type="radio" name="btnclick" value="1" class="diy-bind" data-bind-child="params" data-bind="btnclick" data-bind-init="true" <%if params.btnclick==1%>checked="checked"<%/if%>> 弹出二维码</label>
        </div>
    </div>

    <%if params.btnclick==0%>
        <div class="form-group">
            <div class="col-sm-2 control-label">链接设置</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="btnlinktype" value="0" class="diy-bind" data-bind-child="params" data-bind="btnlinktype" data-bind-init="true" <%if params.btnlinktype==0%>checked="checked"<%/if%>> 读取系统设置</label>
                <label class="radio-inline"><input type="radio" name="btnlinktype" value="1" class="diy-bind" data-bind-child="params" data-bind="btnlinktype" data-bind-init="true" <%if params.btnlinktype==1%>checked="checked"<%/if%>> 自定义</label>
                <%if params.btnlinktype==0 && !merch%>
                    <div class="help-block">注意：请确保<a href="<?php  echo webUrl('sysset/follow')?>" target="_blank">关注及分享</a>中的关注引导页已设置</div>
                <%/if%>
            </div>
        </div>
    <%/if%>

    <%if params.btnclick==0 & params.btnlinktype==1%>
        <div class="form-group">
            <div class="col-sm-2 control-label">选择链接</div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="btnlink" value="<%params.btnlink%>" id="btnlink" />
                    <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-input="#btnlink">选择链接</span>
                </div>
            </div>
        </div>
    <%/if%>

    <%if params.btnclick==1%>
        <div class="form-group">
            <div class="col-sm-2 control-label">二维码设置</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="qrcodetype" value="0" class="diy-bind" data-bind-child="params" data-bind="qrcodetype" data-bind-init="true" <%if params.qrcodetype==0%>checked="checked"<%/if%>> 读取系统设置</label>
                <label class="radio-inline"><input type="radio" name="qrcodetype" value="1" class="diy-bind" data-bind-child="params" data-bind="qrcodetype" data-bind-init="true" <%if params.qrcodetype==1%>checked="checked"<%/if%>> 自定义</label>
                <%if params.qrcodetype==0 && !merch%>
                    <div class="help-block">注意：请确保<a href="<?php  echo webUrl('sysset/follow')?>" target="_blank">关注及分享</a>中的二维码已设置</div>
                <%/if%>
            </div>
        </div>
    <%/if%>

    <%if params.btnclick==1 & params.qrcodetype==1%>
        <div class="form-group">
            <div class="col-sm-2 control-label">二维码图片</div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="qrcodeurl" value="<%params.qrcodeurl%>" id="qrcodeurl">
                    <span data-input="#qrcodeurl" data-img="#qrcodeimg" data-toggle="selectImg" class="input-group-addon btn btn-default">选择图片</span>
                </div>
                <div class="input-group " style="margin-top:.5em;">
                    <img src="<%imgsrc params.qrcodeurl%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" class="img-responsive img-thumbnail" width="80" id="qrcodeimg">
                    <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="$('#qrcodeurl').val('').trigger('change');$(this).prev().attr('src', '')">×</em>
                </div>
                <div class="help-block">提示：图标请选择正方形</div>
            </div>
        </div>
    <%/if%>



    <%if !merch%>
    <div class="form-group">
        <div class="col-sm-2 control-label">是否启用</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="isopen" value="0" class="diy-bind" data-bind-child="params" data-bind="isopen" <%if params.isopen==0%>checked="checked"<%/if%>> 不启用</label>
            <label class="radio-inline"><input type="radio" name="isopen" value="1" class="diy-bind" data-bind-child="params" data-bind="isopen" <%if params.isopen==1%>checked="checked"<%/if%>> 启用</label>
        </div>
    </div>
    <%/if%>

    <%if !merch%>
        <div class="alert alert-danger" style="margin: 0 10px;">注意：diy页面请至页面编辑中设置，此处设置为非diy页面的商城其他页面(关注条仅在微信中显示)。</div>
    <%else%>
        <div class="alert alert-danger" style="margin: 0 10px;">注意：diy页面请至页面编辑中设置(关注条仅在微信中显示)。</div>
    <%/if%>


</script>
<!--4000097827-->