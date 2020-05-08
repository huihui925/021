<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
    .stystem_upgrade  .control-label{
        margin-right: 10px;
    }
    .log .upgradelog{
        line-height: 80px;
        font-size:18px;
        color: #333;
    }
    .log .upgradelog i{
        font-weight: bold;
        color: #00aeff;
        margin-right: 7px;
        font-size:20px;
    }
    .log .panel{
        padding: 0 25px;
        margin-bottom: 20px;
        border:1px solid #efefef;
    }
    .log .panel-heading{
        padding: 0;
        height:58px;
        line-height: 58px;
        font-size:14px;
        border-bottom:1px solid #efefef !important;
    }
    .log .panel-body{
        font-size: 13px;
        color: #333;
        line-height: 30px;
        padding: 14px 0 35px;
    }
    .log .panel-body p i{
        font-size:16px;
    }
    .shopedtion{
        line-height: 50px;
        margin-bottom: 30px;
    }
    .shopedtion .shopedtion_info{
        display: flex;
        align-items: center;
        font-size:16px;
        color: #333;
        line-height: 30px;
        padding: 15px 30px;
        background: #eef9ff;
        border: 1px solid #c4e3f3;
    }
    .shopedtion .model{
        border: 1px solid #efefef;
        line-height: 30px;
        height: 200px;
        overflow: auto;
        padding: 15px 30px;
    }
    .shopedtion .shopedtion_info p{
        font-size:15px;
    }
    .shopedtion_info>div{
        flex:1;
        align-items: center;
    }
    .shopedtion .control-label,.new_edtion .control-label{
        padding-top: 0;
    }
</style>
<div class="page-header">
    <span class='pull-right'>
        <?php  if(!empty($result['status'])) { ?>
            <span class='label label-primary'>更新服务到期时间:  <?php  echo $result['result']['auth_date_end'];?></span>
        <?php  } ?>
    </span>
    当前位置：<span class="text-primary">系统更新</span>
</div>
<div class="page-content stystem_upgrade">

    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
        <div class="form-group shopedtion">
            <label class="col-lg control-label">当前版本</label>
            <div class="col-sm-9 col-xs-12 shopedtion_info">
               <div>
                   <span class="text-danger"><?php  echo $version;?></span> RELEASE <?php  echo $release;?>
               </div>
                <a href="index.php?c=site&a=entry&m=ewei_shopv2&do=web&r=system.auth")}" >VIP尊享版</a>
            </div>
        </div>
        <div class=" upgrade" >
            <label class="col-lg control-label">最新版本</label>
            <div class="col-sm-9 col-xs-12">
                <div class="form-control-static"  id="check">等待检测...</div>
            </div>
        </div>
    </form>
</div>

<script type="text/html" id="test">
    <%if ret.status == 1%>
        <%if  result.filecount <= 0 && !result.database && !result.upgrades%>
            <div class=" upgrade" >
                <label class="col-lg control-label">最新版本</label>
                <div class="col-sm-9 col-xs-12">
                    <div class="form-control-static">您当前版本为最新版本,无需更新。</div>
                </div>
            </div>
        <%else%>
            <div class="form-group shopedtion">
                <label class="col-lg control-label">最新版本</label>
                <div class="col-sm-9 col-xs-12 shopedtion_info">
                    <div>
                        <p><span class="text-danger"><?php  echo $version;?></span> RELEASE <?php  echo $release;?></p>
                        <p>共检测到 <span class="text-danger"><%result.filecount%></span>个文件</p>
                        <p>更新之前请注意数据备份</p>
                        <%if result.database || result.upgrades%>
                           <p> 此次有数据变动</p>
                        <%/if%>
                    </div>
                    <input type="button" id="upgradebtn" value="立即更新" class="btn btn-primary" />
                </div>
            </div>
            <%if result.templatefiles!=''%>
                <div  class="form-group shopedtion">
                    <label class="col-lg control-label">模板更新</label>
                    <div class="col-sm-9 col-xs-12 model">
                        <!--<%result.templatefiles%>-->
                    </div>
                </div>
            <%/if%>

            <%if result.new_log != ''%>
                <div class="form-group">
                    <label class="col-lg control-label">更新日志</label>
                    <div class="log col-sm-9 col-xs-12" style="padding: 0">
                        <%each result.new_log as item%>
                        <div class="panel">
                            <div class="panel-heading">
                                <%item.release%>
                                <span class="pull-right" style="font-size: 12px;"> <%item.time%></span>
                            </div>
                            <div class="panel-body">
                                <%each item.log_data as index%>
                                <p>
                                    <%if index.type == 0%>
                                        <i class="icow icow-icon32208 text-primary" ></i>
                                    <%/if %>
                                    <%if index.type == 1%>
                                        <i class="icow icow-icon32208 text-success" ></i>
                                    <%/if %>
                                    <%if index.type == 2%>
                                         <i class="icow icow-sanjiaoxing text-warning" ></i>
                                    <%/if %>
                                    <%if index.type == 3%>
                                        <i class="icow icow-icon32208 text-primary" ></i>
                                    <%/if %>
                                    <%if index.type == 4%>
                                        <i class="icow icow-sanjiaoxing text-danger" ></i>
                                    <%/if %>
                                   <%index.value%>
                                </p>
                                <%/each%>
                            </div>
                        </div>
                        <%/each%>
                    </div>
                </div>
            <%/if%>
        <%/if%>
    <%else%>
        <div class="form-group upgrade" >
            <label class="col-lg control-label">最新版本</label>
            <div class="col-sm-9 col-xs-12">
                <div class="form-control-static"><%=result.message%></div>
            </div>
        </div>
    <%/if%>
</script>


<script language='javascript'>
    function process(action) {
        $.ajax({
            url: "<?php  echo webUrl('system/auth/upgrade/process')?>",
            data: {action: action},
            type: 'post',
            dataType: 'json',
            success: function (ret) {
                var status = ret.status;
                var result = ret.result;
                var act = result.action;

                if (act == 'database') {

                    if (status == 1) {
                        $('#upgradebtn').val("已更新 " + result.success + " 条数据库结构变动 / 共 " + result.total + " 条");
                        process('database');
                    } else {
                        $('#upgradebtn').val("已成功更新 " + result.total + " 条数据库结构变动");

                        process('file');
                    }


                } else if (act == 'file') {

                    if (status == 1) {
                        $('#upgradebtn').val("已更新 " + result.success + " 个文件 / 共 " + result.total + " 个文件");
                        process('file');
                    } else {
                        $('#upgradebtn').val("已成功更新 " + result.total + " 个文件");

                        process('upgrade');
                    }

                } else if (act== 'upgrade') {

                    if (status == 1) {
                        $('#upgradebtn').val("已更新 " + result.success + " 个补丁 / 共 " + result.total + " 个补丁");
                        process('upgrade');
                    } else {

                        $('#upgradebtn').val('更新成功').removeAttr('updating');
                        tip.alert('更新成功!', function () {
                            location.reload();
                        });
                    }
                }
            }
        });
    }


    $(function () {
        myrequire(['tpl'],function(tpl){
        $.ajax({
            url: "<?php  echo webUrl('system/auth/upgrade/check')?>",
            type: 'post',
            dataType: 'json',
            success: function (ret) {
                console.log(ret)
                var  html = tpl('test', {ret:ret,result: ret.result});
                    $('.upgrade').html(html)
                var str = ret.result.templatefiles
               $('.shopedtion .model').html(str)
                var result = ret.result;
                if (result.filecount > 0 || result.database || result.upgrades) {
                        $('#upgrade').show();
                        $("#upgradebtn").unbind('click').click(function () {
                            if ($(this).attr('updating') == '1') {
                                return;
                            }
                            tip.confirm('确认已备份，并进行更新吗?', function () {
                                $(this).attr('updating', 1).val('正在更新中...');
                                if( result.database){
                                    process('database');
                                } else if(result.filecount>0){
                                    process('file');
                                }else if(result.upgrades){
                                    process('upgrade');
                                }
                            });
                        });
                    }
            }
        })

    })
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>