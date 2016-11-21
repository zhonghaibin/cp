<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="renderer" content="webkit" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
        <title><?= $this->settings['webName'] ?></title>
        <link href="/oacss/css/layout.css" rel="stylesheet">
        <link href="/oacss/css/style-default.css" rel="stylesheet">
        <script language="javascript" type="text/javascript" src="/oacss/js/jquery.js"></script>
        <script language="javascript" src="/oacss/js/jquery.dialogUI.js"></script>
        <script type="text/javascript" src="/oacss/js/zDrag.js"></script>
        <script type="text/javascript" src="/oacss/js/zDialog.js"></script>
        <script type="text/javascript" src="/oacss/js/main.js"></script>
        <script type="text/javascript" src="/skin/main/game.js"></script>
        <script type="text/javascript" src="/skin/main/function.js"></script>
        <script type="text/javascript" src="/skin/main/onload.js"></script>
        <script type="text/javascript" src="/skin/js/jquery-1.8.0.min.js"></script>
        <?php $this->display('inc_header.php'); ?>
        <style>
            /*header 顶部*/
            .header{
                margin: 10px auto 10px;
                overflow: auto;
            }
            .header .logo{
                padding:0px;
                margin:0px;
            }
            #menu ul {
                text-align: right;
                font-size: 14px;
            }
            #menu ul li {
                list-style-type: none;
                display: inline;
                padding-right: 15px;
                margin-right: 10px;
                line-height: 30px;
                color: #fff;
            }
            #menu .menuaccount {
                background: transparent url(/oacss/images/2_03.png) no-repeat scroll left center;
                padding: 5px 15px 5px 30px;
            }
            .w2 {
                color: #e4ba61;
                font-weight: bold;
                margin-left: 5px;
            }
            #menu .menumail {
                background: transparent url(/oacss/images/1_03.png) no-repeat scroll left center;
                padding: 5px 15px 5px 30px;
            }
            #menu .main{

                padding: 15px 0px;
            }
            #menu .logout {
                background: transparent url(/oacss/images/3_03.png) no-repeat scroll left center;
                padding: 5px 15px 5px 30px;
            }
            /*nav 导航条*/
            #navg {
                line-height: 40px;
                width: 1200px;
                margin: 0px auto;
                overflow-y: auto;
                overflow-x: hidden;
            }
            #navg ul {
                width: 1200px;
                margin: 0px auto;
                position: relative;
                padding-left: 6px;
                height: 40px;
                background: #d29607 none repeat scroll 0% 0%;
            }
            #navg ul li {
                float: left;
                padding: 0px 15px 0px 35px;
                color: rgb(255, 255, 255);
                font-size: 15px;
                cursor: pointer;
            }
            /*            #navg ul li:hover{
                            display:block;
                            background-color: #175855;
                        }*/
            #navg .m2, #navg .m2:hover, .m2 .active {
                background-position: 5px -40px;
            }
            #navg .m3, #navg .m3:hover, .m3 .active {
                background-position: 5px -80px;
            }
            #navg .m4, #navg .m4:hover, .m4 .active {
                background-position: 5px -120px;
            }
            #navg .m5, #navg .m5:hover, .m5 .active {
                background-position: 5px -160px;
            }
            #navg .m6, #navg .m6:hover, .m6 .active {
                background-position: 5px -200px;
            }
            #navg .m7, #navg .m7:hover, .m7 .active {
                background-position: 5px -240px;
            }
            #navg .m8, #navg .m8:hover, .m8 .active {
                background-position: 5px -280px;
            }
            #navg .m9, #nav .m9:hover, .m9 .active {
                background-position: 5px -320px;
            }
            /*底部*/
            #lmain{             
                background:#002b29;
                background: rgba(0, 0, 0, 0.5) none repeat scroll 0% 0%;
                overflow: auto;
                color: rgb(255, 232, 184);
                font-size: 12px;
                padding: 20px 10px;
                clear: both;
                margin-top: 40px;
            }
            #lmain .container{
                width: 1200px;
                margin: 0px auto;

            }
            #lmain .ft1 {
                float: left;
                width: 400px;
            }
            #lmain .ft3 {
                float: right;
                text-align: right;
            }
            .servemenu{
                position: fixed;
                right: 10px;
                top: 35%;
                z-index: 999;
            }
            .servemenu a.btn, .servemenu a.btn:visited {
                background: rgb(1, 164, 199) url(/oacss/images/serve_icon.png) no-repeat scroll center 5px;
                width: 25px;
                line-height: 18px;
                padding: 40px 5px 5px 10px;
                text-decoration: none;
                display: block;
                color: rgb(255, 255, 255);
            }
            .servemenu .btn {
                margin-bottom: 1px;
                cursor: pointer;
                position: relative;
            }
        </style>
    </head>
    <body style="width: 100%; padding: 0px; margin: 0px;">
        <div id="divbg"><img src="/images/bg/body.jpg"></div> 
        <div class="header">
            <div class="logo left"><a href="#" onclick=""><img src="/oacss/images/logo.png"></a></div>
            <ul class="msg-list"style="float:left;line-height: 60px">
                <li>
                    <img style="width:20px;margin-top:6px;margin-right:5px;" src="/images/announce.png" class="notice_gb">
                </li>
            </ul>
            <div id="enotice" style="text-align:left;line-height:60px;overflow:hidden;font-size:12px;font-color:#FFFFFF;float:left;color: #fff;" onmouseover="iScrollAmount = 0" onmouseout="iScrollAmount = 1">	
                <div id="news-marquee">
                    <marquee style="cursor: pointer;" onClick="HotNewsHistory();" onMouseOut="this.start();" onMouseOver="this.stop();" direction="left" scrolldelay="30" scrollamount="5" id="msgNews"><?= $this->settings['webGG'] ?></marquee>
                </div>
            </div>
            <div id="northMenu">
                <div id="menu" class="default">
                    <div class="main"style="background:none;">
                        <ul>                           
                            <li>您好<span class="w2"><?= htmlspecialchars($this->user['username']) ?></span></li>
                            <li class="menuaccount ">账户余额 <span class="w2">RMB <span id="usermoney"><?= htmlspecialchars($this->user['coin']) ?> </span></span><a class="refresh" title="刷新" href="#" onclick="updm();"></a></li>
                            <a href="#" ><li class="menumail ">信息(<font id="nMsgCount"><?php $this->display('index/inc_msg.php'); ?></font>)</li></a>
                            <a class="btn radius" href="/index.php/user/logout"><li class="logout ">退出</li></a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div id="navg">
            <ul  id="enav">
                <li class="active" data="/index.php/index/game/1/1">首页</li>
                <li class="m2 about" data="/index.php/notice/info">公告讯息</li>
                <li class="m3 account" data="/index.php/safe/info" >账户中心</li>
                <li class="bank-info" data="/index.php/cash/recharge">
                    充值提现
                </li>
                <li class="m4 history" data="/index.php/record/search">游戏记录</li>
                <li class="m5 report" data="/index.php/report/count">报表管理</li>
                <li class="m7" data="/index.php/wanfa/wf">规则与帮助</li>
                <!--                        <li class="m6">开奖结果</li>
                                        <li class="m7">规则与帮助</li>-->
                <?php if ($this->user['type']) { ?>
                    <li class="proxy" data="/index.php/team/memberList">
                        团队管理
                    </li>
                    <?}else{?>
                    <li class="proxy" data="/index.php/report/membercoin">
                        账变记录
                    </li>
                    <?}?>
                    <li class="m9 notice" data="/index.php/score/rotate">优惠活动</li>
                </ul>
            </div>
            <!--div id="mainbody"-->
            <div id="mainbody">
                <form id="topForm" name="topForm" method="post" action="" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="topForm" value="topForm">
                    <div class="main" style="padding:0px">
                    <div id="top">
                        <div id="servemenu" class="servemenu">
                            <a id="openChat" href="#" class="btn"onclick="wjkf168();">在线客服<div id="hintChat"></div></a>
                            <div class="btn btn-top" style="display: none;"></div>
                        </div>
                    </div>   
                    <div class="fn-panel clearfix">
                        <div class="method-type" id="eleftMenu">
                            <ul class="method-list high-game">
                                <!--                                <li class="fkffc" data="/index.php/index/game/5/72">
                                                                    香港分分彩<font style="color:#ffde00;font-size:12px;">【火爆】</font>
                                                                </li>
                                                                <li class="fkffc" data="/index.php/index/game/26/72">
                                                                    香港二分彩<font style="color:#ffde00;font-size:12px;">【热】</font>
                                                                </li>
                                                                <li class="xjssc" data="/index.php/index/game/34/308">
                                                                    香港六合彩<font style="color:#ffde00;font-size:12px;">【新】</font>
                                                                </li>-->
                                <li class="cqssc" data="/index.php/index/game/1/1">
                                    重庆时时彩<font style="color:#ffde00;font-size:12px;">【热】</font>
                                </li>
<!--                                <li class="xjssc" data="/index.php/index/game/3/1">
                                    江西时时彩
                                </li>-->
<!--                                <li class="hljssc" data="/index.php/index/game/12/1">
                                    新疆时时彩
                                </li>-->
                            </ul>
                            <ul class="method-list low-game">
<!--                                <li class="fk3d" data="/index.php/index/game/9/16">
                                    福彩3D<font style="color:#ffde00;font-size:12px;">【热】</font>
                                </li>
                                <li class="fc3d" data="/index.php/index/game/10/16">
                                    排列三
                                </li>-->
                                <li class="fc3d" data="/index.php/index/game/20/26">
                                    北京PK10
                                </li>
                            </ul>
                            <ul class="method-list special-game">
                                <li class="sd115" data="/index.php/index/game/7/10">
                                    山东十一选五
                                </li>
                                <li class="jx115" data="/index.php/index/game/16/10">
                                    江西十一选五
                                </li>
                                <li class="xjssc" data="/index.php/index/game/6/10">
                                    广东十一选五
                                </li>
                                <li class="cq115" data="/index.php/index/game/15/10">
                                    上海十一选五
                                </li>
                            </ul>
                            <!--ul class="method-list low-game">
                                    <li  class="gd115" data="/index.php/box/receive">站内信</li>
                            </ul-->
                            
<!--                            <ul class="method-list special-game">
                                <li class="qqllc" data="/index.php/score/rotate">幸运大转盘</li>
                                <li class="hljssc" data="/index.php/score/dodbqb">夺宝奇兵</li>
                            </ul>-->
                            
                        </div>
                        <!--game-method-panel-->
                        <div class="game-panel">
                            <iframe name="main" id="mainiframe" allowtransparency="true" style="background-color-transparent;width:920px;padding:0px;" src="/index.php/index/game/1/1" frameborder="0" height="750px" scrolling="no"></iframe>
                        </div>
                    </div>

                </div><input type="hidden" name="javax.faces.ViewState" id="javax.faces.ViewState" value="j_id3" autocomplete="off">
            </form>
        </div>
        <div  id="lmain">
            <div class="container">        
                <div class="ft1" > 
                    郑重提示：彩票有风险，投注需谨慎。不向未满18周岁的青少年出售彩票
                </div>
                <div class="ft3">
                    Copyright&copy;2016 EW享赢版权所有
                </div>
            </div>
        </div>
    </body>
</html>