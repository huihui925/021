<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary">砍价活动设置</span>
</div>
<div class="page-content">
<?php  if(!$temp['bargain']) { ?>
<form action="" method="post" class="form-horizontal form-search form-validate">
    <hr>
    <div class="form-group">
        <label class="col-sm-2 control-label">商品标题</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="title" class="form-control" value="<?php  echo $this_goods['title'];?>" readonly="readonly">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">商品标价</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group" style="width: 200px">
                <input type="text" name="marketprice" id="marketprice" class="form-control" value="<?php  echo $this_goods['marketprice'];?>" readonly>
                <span class="input-group-addon">元</span>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label must">设置底价</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group" style="width: 200px">
                <input type="text" name="end_price" class="form-control" value="" required="requied" onkeyup="this.value=/^\d+\.?\d{0,2}$/.test(this.value) ? this.value : ''">
                <span class="input-group-addon">元</span>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">显示底价</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="display" value="1"  class="valid" aria-invalid="false"> 显示
            </label>
            <label class="radio-inline">
                <input type="radio" name="display" value="0" aria-invalid="false" class="valid" checked> 不显示
            </label>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">没到底价</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="order_set" value="0" aria-invalid="false" class="valid" checked> 可以下单
            </label>
            <label class="radio-inline">
                <input type="radio" name="order_set" value="1" class="valid" aria-invalid="false"> 不可下单
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">自己砍价</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="myself" value="1" aria-invalid="false" class="valid" checked> 允许
            </label>
            <label class="radio-inline">
                <input type="radio" name="myself" value="0"  class="valid" aria-invalid="false"> 禁止
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">发起次数</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="radio" name="initiate" value="1" aria-invalid="false" class="valid" checked> 每个商品只允许发起一次砍价
            </label>
            <label class="radio-inline">
                <input type="radio" name="initiate" value="0"  class="valid" aria-invalid="false"> 允许多次发起同一个商品的砍价
            </label>
        </div>
    </div>
    <div class="form-group" id="initiate-help">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 col-xs-12">用户已经发起本商品的砍价活动时，需要完成购买方可再次发起</div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">活动时间</label>
        <div class="col-sm-9 col-xs-12">
            <?php  $time_end = time()+604800;$time['start'] = date('Y-m-d H:i:s',time());$time['end'] = date('Y-m-d H:i:s',$time_end);?>
            <?php  echo tpl_form_field_eweishop_daterange('act_time', $time, true);?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">砍价时限</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group" style="width: 200px">
                <input type="number" name="time_limit" class="form-control" value="0">
                <span class="input-group-addon">小时</span>
            </div>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <label class="col-sm-2 control-label">可砍价总次数</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group" style="width: 200px">
                <input type="number" name="total_time" class="form-control" value="999">
                <span class="input-group-addon">次</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">每人可砍次数</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group" style="width: 200px">
                <input type="number" name="each_time" class="form-control" value="1">
                <span class="input-group-addon">次</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">活动可发起次数</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group" style="width: 200px">
                <input type="number" name="total_act" class="form-control" value="999">
                <span class="input-group-addon">次</span>
            </div>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">每次砍价概率</label>
        <div class="col-sm-9 col-xs-12" id="addrand">
            <span style="color: #ff3f4b">
                    最大增加金额用正数表示，例如：6 ，
                    最大减少金额用负数表示，例如：-6 ，概率相加必须等于100%</span>
            <div class="input-group">
                <input type="number" name="rand_left[]" class="form-control" value="-10">
                <span class="input-group-addon">元 &nbsp;&nbsp;&nbsp;至</span>
                <input type="number" name="rand_right[]" id="productprice" class="form-control" value="0">
                <span class="input-group-addon">元 &nbsp;&nbsp;&nbsp;概率</span>
                <input type="text" name="rand[]" id="rand" class="form-control" value="100" onkeyup="this.value=/^\d+$/.test(this.value) ? this.value : ''">
                <span class="input-group-addon">%</span>
            </div>
            <div id="aad"></div>
        </div>
        <div style="padding-top: 50px"><a class="btn btn-primary" onclick="addlink()" style="margin-left: 160px">添加区间</a>
            <a class="btn btn-primary" onclick="myFunction()" style="margin-left: 160px">删除区间</a></div>
        <script>
            function myFunction() {
                var p = document.getElementById('aad');
                p.removeChild(document.getElementById('input-group'));
            }
        </script>
        <script>
            function addlink(){
                var html ='<div class="input-group" style="margin-top: 10px;margin-bottom: 10px" id="input-group">';
                html+='<input type="number" name="rand_left[]" id="marketprice" class="form-control">';
                html+='<span class="input-group-addon">元 &nbsp;&nbsp;&nbsp;至</span>';
                html+='<input type="number" name="rand_right[]" id="productprice" class="form-control">';
                html+='<span class="input-group-addon">元 &nbsp;&nbsp;&nbsp;概率</span>';
                html+='<input type="text" name="rand[]" id="costprice" class="form-control" value="" onkeyup="this.value=/^\d+$/.test(this.value) ? this.value : ">';
                html+='<span class="input-group-addon">%</span>';
                html+='</div>';
                $('#aad').append(html);
            }
        </script>
    </div>

    <hr>
    <div class="form-group">
        <label class="col-sm-2 control-label">【分享】商品标题</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="goods_share_title" class="form-control" value="">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">【分享】商品描述</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="goods_share_describe" class="form-control" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">【分享】商品图片</label>
        <div class="col-sm-9 col-xs-12">
            <?php  echo tpl_form_field_image2(goods_share_logo);?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">【分享】砍价标题</label>
        <div class="col-sm-9 col-xs-12" name="form1">
            砍价标题模板标签: <a onclick="addtext0()"> [原价]</a><a onclick="addtext1()"> [现价]</a><a onclick="addtext2()"> [底价]</a><a onclick="addtext3()"> [已砍]</a><a onclick="addtext4()"> [未砍]</a><br>
            <input type="text" name="bargain_share_title" class="form-control" id="moban">
        </div>
    </div>

    <script language="javascript">
        <!--
        function addtext0(){
            var str = "[原价]";
            var txt = document.getElementById('moban').value;
            txt = txt + "\r" + str;
            document.getElementById('moban').value = txt;
        }
        function addtext1(){
            var str = "[现价]";
            var txt = document.getElementById('moban').value;
            txt = txt + "\r" + str;
            document.getElementById('moban').value = txt;
        }
        function addtext2(){
            var str = "[底价]";
            var txt = document.getElementById('moban').value;
            txt = txt + "\r" + str;
            document.getElementById('moban').value = txt;
        }
        function addtext3(){
            var str = "[已砍]";
            var txt = document.getElementById('moban').value;
            txt = txt + "\r" + str;
            document.getElementById('moban').value = txt;
        }
        function addtext4(){
            var str = "[未砍]";
            var txt = document.getElementById('moban').value;
            txt = txt + "\r" + str;
            document.getElementById('moban').value = txt;
        }
        //-->
    </script>

    <div class="form-group">
        <label class="col-sm-2 control-label">【分享】砍价描述</label>
        <div class="col-sm-9 col-xs-12">
            <input type="text" name="bargain_share_describe" class="form-control" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">【分享】砍价图片</label>
        <div class="col-sm-9 col-xs-12">
            <?php  echo tpl_form_field_image2(bargain_share_logo);?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">砍价规则</label>
        <div class="col-sm-9 col-xs-12">
            <label class="radio-inline">
                <input type="checkbox" name="bang_swi" value="1" aria-invalid="false" class="valid" onclick="check()" id="bang" checked> 使用全局规则
            </label>
        </div>
    </div>

    <div class="form-group" style="display: none;" id="partin">
        <label class="col-sm-2 control-label">砍价规则设置</label>
        <div class="col-sm-9 col-xs-12">
            <?php  echo tpl_ueditor('rule');?>
        </div>
    </div>
    <script>
        function check() {
            var res = document.getElementById("bang").checked;
            if(res){
                document.getElementById("partin").style.display = "none";
            }else{
                document.getElementById("partin").style.display = "block";
            }
        }

        $(document).ready(function(){
            var initiate= $("input[name='initiate']:checked").val();
            if(initiate==1){
                $('#initiate-help').show();
            }else{
                $('#initiate-help').hide();
            }
        });

        $('input[name=initiate]').bind('click',function () {
           var radioval=$(this).val();
           if(radioval==1){
               $('#initiate-help').show();
           }else{
               $('#initiate-help').hide();
           }
        })

    </script>



    <div class="form-group">
        <label class="col-sm-2 control-label">倒计时前的文字</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group" style="width: 200px">
                <input type="text" name="countdown" class="form-control" maxlength="6">
                <span class="input-group-addon"><input type="color" name="countdown_color" value="#ffffff"></span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">砍多少减多少文字</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group" style="width: 200px">
                <input type="text" name="cutmore" class="form-control" maxlength="6">
                <span class="input-group-addon"><input type="color" name="cutmore_color" value="#ffffff"></span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">砍价按钮颜色</label>
        <div class="col-sm-9 col-xs-12">
            <div class="input-group" style="width: 200px">
                <input type="color" name="btn_color" value="#d54a47">
            </div>
        </div>
    </div>



    <div class="form-group"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <input type="submit" value="提交" class="btn btn-primary">
            <input type="button" name="back" onclick="history.back()" style="margin-left:10px;" value="返回列表" class="btn btn-default">
        </div>
    </div>
</form><?php  } ?>
<?php  if($temp['bargain']>0) { ?><br><br>
<h2><i class="glyphicon glyphicon-check" style="color: limegreen"></i> 此商品已经成功发起了砍价活动</h2>
<br>
    <!--<span style="margin-left: 20px">如需重新发起或请先删除已发起的活动</span>-->
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <br>
        <input type="button" name="back" onclick="history.back()" value="返回列表" class="btn btn-default">

</div><?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>