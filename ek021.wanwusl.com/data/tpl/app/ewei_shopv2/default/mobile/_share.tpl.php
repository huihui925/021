<?php defined('IN_IA') or exit('Access Denied');?><?php  $this->shopShare()?>
<script language="javascript">
    // 以下代码用来解决文章详情的分享问题，强制加external
    $(function () {
        var a_collections = $('a');
        $.each(a_collections,function (index,val) {
            var that = $(val);
            var href = that.attr('href') ||'';
            var bool = href.indexOf('r=article');
            if (bool>0){
                that.addClass('external');
            }
        });
    });

    window.shareData = <?php  echo json_encode($_W['shopshare'])?>;
    setTimeout(function(){

        var verify_url = window.location.href.toString();
        $.ajax({
            type: "GET",
            url:'<?php  echo mobileUrl('index.share_url',array(),true);?>',
            data:{url:verify_url},
            dataType: "json",
            success: function(data){
            jssdkconfig = data.result || { jsApiList:[] };
            jssdkconfig.debug = false;
            jssdkconfig.jsApiList = ['checkJsApi','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','showOptionMenu', 'hideMenuItems', 'onMenuShareQZone', 'scanQRCode','openLocation','openAddress','addCard','chooseCard','openCard'];
            wx.config(jssdkconfig);
            wx.ready(function () {
                wx.showOptionMenu();

                    <?php  if(!empty($_W['shopshare']['hideMenus'])) { ?>
                        wx.hideMenuItems({
                            menuList: <?php  echo  json_encode($_W['shopshare']['hideMenus'])?>
                        });
                    <?php  } ?>
                    window.shareData.success = "<?php  echo $_W['shopshare']['way'];?>";
                    if(window.shareData.success){
                        var success = window.shareData.success;
                        window.shareData.success = function(){
                            eval(success)
                        };
                    }
                    wx.onMenuShareAppMessage(window.shareData);

                    wx.onMenuShareTimeline(window.shareData);

                    var qqShareData = {
                        title: shareData.title || "", // 分享标题
                        desc: shareData.desc || " ", // 分享描述
                        link: shareData.link || "", // 分享链接
                        imgUrl: shareData.imgUrl || "", // 分享图标
                        success: shareData.success || "",
                        cancel: shareData.cancel || "",
                    };
                    wx.onMenuShareQQ(qqShareData);
                    wx.onMenuShareWeibo(window.shareData);
                    wx.onMenuShareQZone(window.shareData);
                });
            },
            error:function(e){
                console.log(JSON.stringify(e));
            }
        });
    },700);

    <?php  if(!empty($_W['shopset']['wap']['open']) && !is_weixin()) { ?>
    //	Share to qq
    require(['//qzonestyle.gtimg.cn/qzone/qzact/common/share/share.js'], function(setShareInfo) {
        setShareInfo({
            title: "<?php  echo $_W['shopshare']['title'];?>",
            summary: "<?php  echo str_replace(array("\r","\n"),'',$_W['shopshare']['desc'])?>",
            pic: "<?php  echo $_W['shopshare']['imgUrl'];?>",
            url: "<?php  echo $_W['shopshare']['link'];?>"
    });
    });
    <?php  } ?>

        //判断设备系统
        function  isIOS() {
            var ua = navigator.userAgent;
            var ipad = ua.match(/(iPad).*OS\s([\d_]+)/);
            var ipod = ua.match(/(iPod)(.*OS\s([\d_]+))?/);
            var iphone = !ipad && ua.match(/(iPhone\sOS)\s([\d_]+)/);
            if (ipad || iphone || ipod) {
                return true;
            }
            return false;
        }

</script>