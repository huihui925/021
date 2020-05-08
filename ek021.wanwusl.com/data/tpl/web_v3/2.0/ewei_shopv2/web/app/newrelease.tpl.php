<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<link href="../addons/ewei_shopv2/plugin/app/static/css/page.css?v=20170922" rel="stylesheet" type="text/css"/>

<style type="text/css">
    /*已发布版本和审核版本*/
    .page-content.versions{
        background: #f5f7f9;
        display:-webkit-box;
        display:-webkit-flex;
        display:-ms-flexbox;
        display:flex;
    }
    /*正式版*/
    .official,.experience{
        padding: 0 32px;
        background: #fff;
    }
    .official .title,.experience .title{
        font-size: 16px;
        font-weight: 600;
        color: #333;
        line-height: 68px;
        border-bottom: 1px solid #ededed;
    }
    .official .message,.experience .message{
        height: 310px;
        position: relative;
        display:-webkit-box;
        display:-webkit-flex;
        display:-ms-flexbox;
        display:flex;
    }
    .official .message .msg,.experience .message .msg{
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        -ms-flex: 1;
        flex: 1;
        padding-top: 56px;
    }
    .official .message .msg .msg-cell,.experience .message .msg .msg-cell{
        display:-webkit-box;
        display:-webkit-flex;
        display:-ms-flexbox;
        display:flex;
        height: 40px;
        line-height: 40px;
    }
    .official .msg-cell-title,.experience .msg-cell-title{
        width: 90px;
        color: #999;
        font-size: 14px;
    }
    .official .msg-cell-info,.experience .msg-cell-info{
        color: #333;
        font-size: 14px;
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }
    .official .msg-cell-info.special,.experience .msg-cell-info.special{
        color: #333;
        font-size: 24px;
    }
    .msg-cell-info.describe{
        color: #999;
        line-height: 1.5;
        padding-top: 10px;
        padding-right: 40px;
        min-height: 70px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
    .official .message .img,.experience .message .img{
        width: 140px;
        float: right;
        padding: 20px 0;
        position: relative;
    }
    .official .message .img img,.experience .message .img img{
        display: inline-block;
        width: 190px;
        height: 190px;
    }

    .lose-code{
        position: absolute;
        top:45px;
        left:0;
        right: 0;
        bottom:45px;
        background: rgba(0,0,0,0.8);
        z-index: 99;
        text-align: center;
        padding-top: 30px;
        font-size: 14px;
        line-height: 1.5;
        display: none;
    }
    .lose-code i{
        font-size: 38px;
        color: #c9c9c9;
    }
    .lose{
        color: #fff;
        margin-top: 10px;
    }
    .refresh{
        color: #00aeff;
        cursor: pointer;
    }

    .official .bottom,.experience .bottom{
        font-size: 14px;
        color: #999;
        line-height: 78px;
        border-top: 1px solid #ededed;
    }
    .message.center{
        text-align: center;
    }
    .message.center .image_code{
        width: 180px;
        height: 180px;
        vertical-align: middle;
        margin: 65px auto 0;
    }
    .modal{
        position: fixed;
        left:0;
        top: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 105;
        display: none;
    }
    .modal.in .modal-dialog {
        -webkit-transform: translate(0, -50%);
        -ms-transform: translate(0, -50%);
        -o-transform: translate(0, -50%);
        transform: translate(0, -50%);
        -webkit-transition: -webkit-transform .3s ease-out;
    }
</style>

<div class="page-header">
    当前位置：
    <span class="text-primary">发布与审核</span>
</div>
<?php  if($error) { ?>
<div class="page-content">
    <div class="page-tips">
        <p><?php  echo $error;?></p>
    </div>
</div>
<?php  } else { ?>
    <!--已发布版本和体验版本-->
    <div class="page-content versions" style="margin-top: 20px">
        <div class="official col-md-4 col-sm-4" style="margin-right: 2%;width: 362px">
            <div class="title">已发布版本</div>
            <div class="message center">
                <img class="image_code" src="../addons/ewei_shopv2/plugin/app/static/images/wxcode_<?php  echo $_W['uniacid'];?>.jpg" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'" />
            </div>
        </div>
        <div class="experience col-md-8 col-sm-8" style="width: 780px">
            <div class="title">
                版本预览<!--<i class="icow icow-xiangqing" style="color: #ee9305;margin-left: 10px"></i>-->
                <a href="<?php  echo webUrl('app/newrelease/upload')?>" style="float: right;margin: 20px 0 0 10px" value="重新提交体验版"  class="btn btn-primary">重新提交体验版</a>
                <a href="#" class="viewlog" style="float: right;font-size: 12px;color: #44abf7;font-weight: normal">查看提交记录</a>
            </div>
            <div class="message" style="height: 231px;">
                <div class="msg">
                    <div class="msg-cell">
                        <div class="msg-cell-title">版本号</div>
                        <div class="msg-cell-info special"><?php echo empty($log[0]['version'])? '未提交':$log[0]['version']?><?php echo !empty($log[0]['version']) && $log[0]['is_goods'] ? '<small style="font-size: 14px;"> (好物圈版)</small>' : ''?></div>
                    </div>
                    <div class="msg-cell">
                        <div class="msg-cell-title">提交时间</div>
                        <div class="msg-cell-info" style="/*color: #f19b08;*/"><?php echo empty($log[0]['version_time'])?'未提交': date('Y-m-d H:i:s',$log[0]['version_time'])?></div>
                    </div>
                    <div class="msg-cell">
                        <div class="msg-cell-title">版本描述</div>
                        <div class="msg-cell-info describe"><?php echo empty($log[0]['describe'])?'未提交':$log[0]['describe']?></div>
                    </div>
                </div>
                <div class="img" style="padding: 45px 0">
                    <div class="lose-code" data-version_time="<?php  echo $version_time;?>" data-isexpire="<?php echo empty($is_expire)?0:1?>" style="display:<?php echo empty($is_expire)?'none':'block'?>">
                        <i class="icow icow-39"></i>
                        <div class="lose">二维码已失效</div>
                        <div class="refresh">点击刷新</div>
                    </div>
                    <img  class="img-code" style="width: 140px;height: 140px" src="../addons/ewei_shopv2/plugin/app/static/images/test_code_<?php  echo $_W['uniacid'];?>.jpg?<?php  echo time()?>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'" />
                </div>
            </div>
            <div class="bottom">
                <i class="icow icow-shibai" style="color: #d9d9d9;margin-right: 10px"></i>当前预览版本如无问题，可上传后提交审核生成线上版本
                <input type="submit" style="float: right;margin-top: 25px"  value="提交审核" class="btn btn-primary WeChat"/>
            </div>
        </div>
    </div>
    <!--体验版提交记录-->
    <div class="modal">
        <div class="modal-dialog" style="z-index: 106;width: 715px;height: 488px;top: -50%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button data-dismiss="modal" class="closemodal close" type="button">×</button>
                    <h4 class="modal-title">体验版提交记录</h4>
                </div>
                <div class="modal-body" style="height: 374px">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width:5%"></th>
                            <th style="width:30%;">版本号</th>
                            <th style="width:30%"></th>
                            <th style="width:30%;">提交时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  if(is_array($log)) { foreach($log as $item) { ?>
                            <tr>
                                <td></td>
                                <td><?php  echo $item['version'];?></td>
                                <td></td>
                                <td><?php  echo date('Y-m-d H:i', $item['version_time'])?></td>
                            </tr>
                        <?php  } } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default closemodal" type="button">关闭</button>
                </div>
            </div>
        </div>
    </div>
<?php  } ?>


<script type="text/javascript">
    $(document).ready(function(){
        var isexpire=$('.lose-code').data('isexpire');
        var version_time=$('.lose-code').data('version_time');
        if(isexpire==0){
            var settime = setInterval(function () {
                var now_time = Date.parse(new Date())/1000;
                if(now_time>(version_time+1490)){
                    clearInterval(settime);
                    $('.lose-code').css('display','block');
                }
            }, 1000);
        }
    });

    //  查看提交记录
    $('.viewlog').click(function () {
        $('.modal').addClass('in')
        $('.modal .modal-dialog').animate({top: "50%"});
        $('.modal').css('display','block')
    })
    $(".closemodal").click(function () {
        $('.modal').css('display','none')
        $('.modal .modal-dialog').animate({top: "-50%"});
    });

    $(".WeChat").click(function () {
        window.open("http://mp.weixin.qq.com");
        tip.impower('已在微信完成审核？',
            function (){
                window.location.href="<?php  echo webUrl('app/newrelease/upload')?>";
            },
            function(){}
        )
    });

    $('.lose-code .refresh').click(function () {
//        $('.lose-code').css('display','none');
        window.location.href="<?php  echo webUrl('app/newrelease/upload')?>";
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>