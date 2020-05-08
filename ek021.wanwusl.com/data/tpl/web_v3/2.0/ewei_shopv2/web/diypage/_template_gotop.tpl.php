<?php defined('IN_IA') or exit('Access Denied');?><script type="text/html" id="tpl_show_gotop">

    <a class="diy-gotop" style="<%if params.gotoptype=='1'%>width: <%style.width%>px;<%/if%> position: absolute; display: block; overflow: hidden; z-index: 999;
        <%if params.iconposition=='left bottom'%> bottom: <%style.top%>px; left: <%style.left%>px; text-align: left;<%/if%>
        <%if params.iconposition=='right bottom'%> bottom: <%style.top%>px; right: <%style.left%>px; text-align: right;<%/if%>
    " href="<%params.linkurl||'javascript:;'%>" target="_blank">
        <%if params.gotoptype=='0'||!params.gotoptype%>
            <div style="background: <%style.background||'#000000'%>; opacity: <%style.opacity||'0.5'%>; line-height: <%style.width%>px; text-align: center; border-radius: <%style.width%>px; height: <%style.width%>px; width: <%style.width%>px;">
                <i class="icon <%params.iconclass||'icon-top1'%>" style="color: <%style.iconcolor||'#ffffff'%>; font-size: <%style.width-10%>px;"></i>
            </div>
        <%/if%>
        <%if params.gotoptype=='1'%>
            <img src="<%imgsrc params.imgurl%>" style="height: auto; width: 100%; display: block;" />
        <%/if%>
    </a>
    <div class="diymenu-page" style="line-height: 500px;">这里是页面内容</div>
</script>

<script type="text/html" id="tpl_edit_gotop">

    <div class="form-group">
        <div class="col-sm-2 control-label">图标类型</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="gotoptype" value="0" class="diy-bind" data-bind-child="params" data-bind="gotoptype" data-bind-init="true" <%if params.gotoptype=='0'||!params.gotoptype%>checked="checked"<%/if%>> 图标</label>
            <label class="radio-inline"><input type="radio" name="gotoptype" value="1" class="diy-bind" data-bind-child="params" data-bind="gotoptype" data-bind-init="true" <%if params.gotoptype=='1'%>checked="checked"<%/if%> > 图片</label>
        </div>
    </div>

    <%if params.gotoptype=='0'||!params.gotoptype%>
        <div class="form-group">
            <div class="col-sm-2 control-label">选择图标</div>
            <div class="col-sm-3">
                <div class="input-group input-group-sm" style="width: 110px;">
                    <span class="form-control" style="line-height: 28px; text-align: center;"><i class="icon <%params.iconclass||'icon-home'%>" id="showiconclass"></i></span>
                    <input type="hidden" class="diy-bind" id="iconclass" value="<%params.iconclass%>" data-bind-child="params" data-bind="iconclass"/>
                    <span class="input-group-addon btn btn-default" data-toggle="selectIcon" data-input="#iconclass" data-element="#showiconclass">选择图标</span>
                </div>

            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">图标颜色</div>
            <div class="col-sm-4">
                <div class="input-group input-group-sm">
                    <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="iconcolor" value="<%style.iconcolor%>" type="color" />
                    <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
                </div>
            </div>
            <div class="col-sm-2 control-label">背景颜色</div>
            <div class="col-sm-4">
                <div class="input-group input-group-sm">
                    <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                    <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#000000').trigger('propertychange')">重置</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">透 明 度</div>
            <div class="col-sm-10">
                <div class="form-group">
                    <div class="slider col-sm-8" data-value="<%style.opacity%>" data-min="1" data-max="10" data-decimal="10"></div>
                    <div class="col-sm-4 control-labe count"><span><%style.opacity%></span>(最大是1)</div>
                    <input class="diy-bind input" data-bind-child="style" data-bind="opacity" value="<%style.opacity%>" type="hidden" />
                </div>
            </div>
        </div>
    <%/if%>
    <%if params.gotoptype=='1'%>
        <div class="form-group">
            <div class="col-sm-2 control-label">按钮图片</div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="imgurl" value="<%params.imgurl%>" id="iconsrc">
                    <span data-input="#iconsrc" data-img="#iconimg" data-toggle="selectImg" class="input-group-addon btn btn-default">选择图片</span>
                </div>
                <div class="input-group " style="margin-top:.5em;">
                    <img src="<%imgsrc params.imgurl%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" class="img-responsive img-thumbnail" width="50" id="iconimg">
                    <em class="close" style="position:absolute; top: 0px; right: -14px;" title="重置" onclick="$('#iconsrc').val('../addons/ewei_shopv2/plugin/diypage/static/images/gotop.png').trigger('change');$(this).prev().attr('src', '../addons/ewei_shopv2/plugin/diypage/static/images/gotop.png')">×</em>
                </div>
            </div>
        </div>
    <%/if%>

    <div class="form-group">
        <div class="col-sm-2 control-label">按钮<%if params.gotoptype=='0'||!params.gotoptype%>大小<%/if%><%if params.gotoptype=='1'%>宽度<%/if%></div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.width%>" data-min="20" data-max="100"></div>
                <div class="col-sm-4 control-labe count"><span><%style.width%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="width" value="<%style.width%>" type="hidden" />
            </div>
            <%if params.gotoptype=='1'%>
                <div class="help-block">注意：此处设置按钮的宽度，高度根据宽度等比缩放</div>
            <%/if%>
        </div>
    </div>

    <div class="line"></div>

        <div class="form-group">
            <div class="col-sm-2 control-label">按钮位置</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="iconposition" value="left bottom" class="diy-bind" data-bind-child="params" data-bind="iconposition" <%if params.iconposition=='left bottom'%>checked="checked"<%/if%> > 左下</label>
                <label class="radio-inline"><input type="radio" name="iconposition" value="right bottom" class="diy-bind" data-bind-child="params" data-bind="iconposition" <%if params.iconposition=='right bottom'%>checked="checked"<%/if%> > 右下</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2 control-label">上下偏移</div>
            <div class="col-sm-10">
                <div class="form-group">
                    <div class="slider col-sm-8" data-value="<%style.top%>" data-min="0" data-max="200"></div>
                    <div class="col-sm-4 control-labe count"><span><%style.top%></span>px(像素)</div>
                    <input class="diy-bind input" data-bind-child="style" data-bind="top" value="<%style.top%>" type="hidden" />
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2 control-label">左右偏移</div>
            <div class="col-sm-10">
                <div class="form-group">
                    <div class="slider col-sm-8" data-value="<%style.left%>" data-min="0" data-max="150"></div>
                    <div class="col-sm-4 control-labe count"><span><%style.left%></span>px(像素)</div>
                    <input class="diy-bind input" data-bind-child="style" data-bind="left" value="<%style.left%>" type="hidden" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">显示高度</div>
            <div class="col-sm-10">
                <div class="form-group">
                    <div class="slider col-sm-8" data-value="<%params.gotopheight%>" data-min="0" data-max="500"></div>
                    <div class="col-sm-4 control-labe count"><span><%params.gotopheight%></span>px(像素)</div>
                    <input class="diy-bind input" data-bind-child="params" data-bind="gotopheight" value="<%params.gotopheight%>" type="hidden" />
                </div>
                <div class="help-block">提示：当浏览器滚动至此高度时显示返回顶部按钮(图标事件为跳转链接时始终显示)</div>
            </div>
        </div>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">图标事件</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="gotopclick" value="0" class="diy-bind" data-bind-child="params" data-bind="gotopclick" data-bind-init="true" <%if params.gotopclick=='0'||!params.gotopclick%>checked="checked"<%/if%>> 返回顶部</label>
            <label class="radio-inline"><input type="radio" name="gotopclick" value="1" class="diy-bind" data-bind-child="params" data-bind="gotopclick" data-bind-init="true" <%if params.gotopclick=='1'%>checked="checked"<%/if%> > 跳转链接</label>
        </div>
    </div>
    <%if params.gotopclick=='1'%>
    <div class="form-group">
        <div class="col-sm-2 control-label">按钮链接</div>
        <div class="col-sm-10">
            <div class="input-group form-group" style="margin: 0;">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="linkurl" placeholder="请选择链接" value="<%params.linkurl%>" id="linkurl">
                <span data-input="#linkurl" data-toggle="selectUrl" class="input-group-addon btn btn-default">选择链接</span>
            </div>
            <div class="help-block">注意：此处仅支持链接跳转，JS代码请到 <a href="<?php  echo webUrl('sysset/shop')?>">全局统计代码</a> 中设置</div>
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
        <div class="alert alert-danger" style="margin: 0 10px;"><%if !merch%>注意：diy页面请至页面编辑中设置，此处设置为非diy页面的商城其他页面。<%else%>注意：diy页面请至页面中开启是否启用<%/if%></div>

</script>
<!--6Z2S5bKb5piT6IGU5LqS5Yqo572R57uc56eR5oqA5pyJ6ZmQ5YWs5Y+4-->