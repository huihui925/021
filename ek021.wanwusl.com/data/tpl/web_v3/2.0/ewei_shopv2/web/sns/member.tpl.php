<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
    .popover{
        width:170px;
        font-size:12px;
        line-height: 21px;
        color: #0d0706;
    }
    .popover span{
        color: #b9b9b9;
    }
    .nickname{
        display: inline-block;
        max-width:200px;
        overflow: hidden;
        text-overflow:ellipsis;
        white-space: nowrap;
        vertical-align: middle;
    }

    .tooltip-inner{
        border:none;
    }
</style>
<div class="page-header">
    当前位置：<span class="text-primary">会员管理</span>
</div>

<div class="page-content">
<form action="./index.php" method="get" class="form-horizontal form-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r" value="sns.member" />
    <div class="page-toolbar row m-b-sm m-t-sm">
        <div class="col-sm-4">

        </div>
        <div class="col-sm-6 pull-right">
            <div class="input-group">
                <div class="input-group-select">
                    <select name="level" class='form-control '>
                        <option value="" <?php  if($_GPC['level'] == '') { ?> selected<?php  } ?>>等级</option>
                        <option value="" <?php  if($_GPC['level'] == '0') { ?> selected<?php  } ?>><?php echo empty($this->set['levelname'])?'社区粉丝':$this->set['levelname']?></option>
                        <?php  if(is_array($levels)) { foreach($levels as $level) { ?>
                        <option value="<?php  echo $level['id'];?>" <?php  if($_GPC['level']== $level['id']) { ?> selected<?php  } ?>><?php  echo $level['levelname'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
                <div class="input-group-select">
                    <select name="isblack" class='form-control '>
                        <option value="" <?php  if($_GPC['isblack'] == '') { ?> selected<?php  } ?>>状态</option>
                        <option value="1" <?php  if($_GPC['isblack']== '1') { ?> selected<?php  } ?>>黑名单</option>
                        <option value="0" <?php  if($_GPC['isblack'] == '0') { ?> selected<?php  } ?>>正常</option>
                    </select>
                </div>
                <input type="text" class="input-sm form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"> <span class="input-group-btn">
                    		
                    <button class="btn btn-primary" type="submit"> 搜索</button> </span>
            </div>

        </div>
    </div>
</form>

<form action="" method="post">
    <?php  if(count($list)>0) { ?>
    <div class="page-table-header">
        <input type="checkbox">
        <div class="btn-group">
            <?php if(cv('sns.member.edit')) { ?>
            <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('sns/member/setblack',array('isblack'=>0))?>">
                <i class='fa fa-circle'></i> 取消黑名单
            </button>
            <button class="btn btn-default btn-sm" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('sns/member/setblack',array('isblack'=>1))?>">
                <i class='fa fa-circle-o'></i> 设置黑名单
            </button>
            <?php  } ?>

            <?php if(cv('sns.member.delete')) { ?>
            <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('sns/member/delete')?>">
                <i class='fa fa-remove'></i> 删除
            </button>
            <?php  } ?>
        </div>
    </div>
    <table class="table table-responsive table-hover" >
        <thead class="navbar-inner">
            <tr>
                <th style="width:25px;"></th>
                <th>粉丝</th>
                <th >会员信息</th>
                <th>等级</th>
                <th >注册时间</th>
                <th>社区信息</th>
                <th style="width:95px;">操作</th>
            </tr>
        </thead>
        <tbody>

        <?php  if(is_array($list)) { foreach($list as $row) { ?>

        <tr>
            <td style="position: relative; ">
                <input type='checkbox'   value="<?php  echo $row['sns_id'];?>"/></td>
            <td style="overflow: visible">
                <div  rel="pop"  style="display: flex" data-content="
                <span>ID: </span><?php  echo $row['id'];?><br/>
                <span>推荐人：</span>
                    <?php  if(empty($row['agentid'])) { ?>
                           <?php  if($row['isagent']==1) { ?>
                            总店
                          <?php  } else { ?>
                           暂无
                          <?php  } ?>
                    <?php  } else { ?>
                        <?php  if(!empty($row['agentavatar'])) { ?>
                             <img src='<?php  echo $row['agentavatar'];?>' style='width:20px;height:20px;padding1px;border:1px solid #ccc' />
                          <?php  } ?>
                         [<?php  echo $row['agentid'];?>]<?php  if(empty($row['agentnickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['agentnickname'];?><?php  } ?>
					  <?php  } ?><br/>
                     <span>是否关注：</span>
                        <?php  if(empty($row['followed'])) { ?>
                        <?php  if(empty($row['uid'])) { ?>
                        未关注
                        <?php  } else { ?>
                        取消关注<?php  echo $row['fanid'];?>
                        <?php  } ?>
                        <?php  } else { ?>
                        已关注
                        <?php  } ?><br/>
                         <span>状态：</span><?php  if($row['isblack']==1) { ?>黑名单<?php  } else { ?>正常<?php  } ?>
					   ">
                    <?php  if(!empty($row['avatar'])) { ?>
                    <img class="radius50" src='<?php  echo $row['avatar'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' onerror="this.src='../addons/ewei_shopv2/static/images/noface.png'" />
                    <?php  } ?>
                   <span  style="display: flex;flex-direction: column;justify-content: center;align-items: flex-start;padding-left: 5px">
                       <span class="nickname">
                    <?php  if(empty($row['nickname'])) { ?>未更新<?php  } else { ?><?php  echo $row['nickname'];?><?php  } ?>
                   </span>
                    <?php  if($row['isblack']==1) { ?>
                    <span class="text-danger">黑名单<i class="icow icow-heimingdan1" style="color: #db2228;margin-left: 2px;font-size: 13px;"></i></span>
                    <?php  } ?>
                   </span>
                </div>
            </td>
            <td><?php  echo $row['realname'];?><br/><?php  echo $row['mobile'];?></td>

            <td><span class=""><?php  echo $row['level']['levelname'];?></span></td>
            <td><?php  echo date("Y-m-d",$row['createtime'])?><br/><?php  echo date("H:i:s",$row['createtime'])?></td>
            <td>
            <span class="text-warning">积分: <?php  echo intval($row['sns_credit'])?></span><br/>
                <span class="text-success">话题: <?php  echo intval($row['sns_postcount'])?></span><br/>
                <span class="text-primary">评论: <?php  echo intval($row['sns_replycount'])?></span>
            </td>
            <td  style="overflow:visible;">
                        <?php if(cv('member.list.detail')) { ?>
                      <a class="btn btn-default btn-op btn-operation" href="<?php  echo webUrl('member/list/detail',array('id' => $row['id']));?>" title="" target="_blank">
                           <span data-toggle="tooltip" data-placement="top" title="" data-original-title="会员详情">
                            <i class="icow icow-chakan-copy"></i>
                         </span>
                      </a>
                        <?php  } ?>

                        <?php if(cv('sns.posts')) { ?>
                        <a  class="btn btn-default btn-op btn-operation" href="<?php  echo webUrl('sns/posts',array('uid' => $row['id']));?>" title="查看话题">
                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="查看话题">
                                <i class="icow icow-info"></i>
                             </span>
                        </a>
                        <?php  } ?>
                        <?php if(cv('sns.member.delete')) { ?>
                    <a  class="btn btn-default btn-op btn-operation" data-toggle='ajaxRemove'  href="<?php  echo webUrl('sns/member/delete',array('id' => $row['sns_id']));?>" title='删除会员' data-confirm="此会员话题及评论会全部删除，确定要删除该会员吗？">
                        <span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                            <i class="icow icow-shanchu1"></i>
                         </span>
                    </a>
                    <?php  } ?>
            </td>
        </tr>
        <?php  } } ?>
            </tbody>
        <tfoot>
            <tr>
                <td><input type="checkbox"></td>
                <td colspan="3">
                    <div class="btn-group">
                        <?php if(cv('sns.member.edit')) { ?>
                        <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('sns/member/setblack',array('isblack'=>0))?>">
                            <i class='fa fa-circle'></i> 取消黑名单
                        </button>
                        <button class="btn btn-default btn-sm" type="button" data-toggle='batch'  data-href="<?php  echo webUrl('sns/member/setblack',array('isblack'=>1))?>">
                            <i class='fa fa-circle-o'></i> 设置黑名单
                        </button>
                        <?php  } ?>

                        <?php if(cv('sns.member.delete')) { ?>
                        <button class="btn btn-default btn-sm" type="button" data-toggle='batch' data-href="<?php  echo webUrl('sns/member/delete')?>">
                            <i class='fa fa-remove'></i> 删除
                        </button>
                        <?php  } ?>
                    </div>
                </td>
                <td colspan="3" class="text-right">  <?php  echo $pager;?></td>
            </tr>
        </tfoot>
        </table>



    <script language="javascript">
        <?php  if($opencommission) { ?>
        require(['bootstrap'],function(){
            $("[rel=pop]").popover({
                trigger:'manual',
                placement : 'right',
                title : $(this).data('title'),
                html: 'true',
                content : $(this).data('content'),
                animation: false
            }).on("mouseenter", function () {
                var _this = this;
                $(this).popover("show");
                $(this).siblings(".popover").on("mouseleave", function () {
                    $(_this).popover('hide');
                });
            }).on("mouseleave", function () {
                var _this = this;
                setTimeout(function () {
                    if (!$(".popover:hover").length) {
                        $(_this).popover("hide")
                    }
                }, 100);
            });


        });
        <?php  } ?>

    </script>

        <?php  } else { ?>
        <div class='panel panel-default'>
            <div class='panel-body' style='text-align: center;padding:30px;'>
                暂时没有任何会员!
            </div>
        </div>
        <?php  } ?>

    </form>

</div>
    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--6Z2S5bKb5piT6IGU5LqS5Yqo572R57uc56eR5oqA5pyJ6ZmQ5YWs5Y+4-->