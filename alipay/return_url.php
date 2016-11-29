<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 * ************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?php
//计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if ($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            //商户订单号
            $out_trade_no = $_GET['out_trade_no'];

            //支付宝交易号

            $trade_no = $_GET['trade_no'];

            //交易状态
            $trade_status = $_GET['trade_status'];

            include '../xy_config.php';
            $conn = mysql_connect($dbhost, $conf['db']['user'], $conf['db']['password']);
            if (!$conn) {
                die('Could not connect: ' . mysql_error());
            }
            mysql_select_db($dbname, $conn);
            mysql_query("SET NAMES UTF8");
            @session_start(); //启动session会话  
            $chaxun = mysql_query("SELECT state FROM xy_order WHERE order_number = '" . $out_trade_no . "'");
            $chaxun2 = mysql_query("select actionIP from xy_member_recharge where rechargeid= '" . $out_trade_no . "'");
            $actionIP = mysql_result($chaxun2, 0);
            $chaxun3 = mysql_query("select id from xy_member_recharge where rechargeid= '" . $out_trade_no . "'");
            $id = mysql_result($chaxun3, 0);
            $chaxun4 = mysql_query("select uid from xy_member_recharge where rechargeid= '" . $out_trade_no . "'");
            $uid = mysql_result($chaxun4, 0);
            $chaxun5 = mysql_query("select coin from xy_members where uid= '" . $uid . "'");
            $coin = mysql_result($chaxun5, 0);
            $chaxun7 = mysql_query("select username from xy_members where uid= '" . $uid . "'");
            $attach = mysql_result($chaxun7, 0);
//        $chaxun6 = mysql_query("select value from xy_params where name='czzs'");
//        $czzs = mysql_result($chaxun6,0);
//        if($czzs){
//                $amount=$amount*(1+number_format($czzs/100,2,'.',''));
//        }
            $chaxun6 = mysql_query("select amount from xy_member_recharge where rechargeid = '" . $out_trade_no . "'");
            $amount = mysql_result($chaxun6, 0);
            $inserts = "insert into xy_coin_log (uid,type,playedId,coin,userCoin,fcoin,liqType,actionUID,actionTime,actionIP,info,extfield0,extfield1) values ('" . $uid . "',0,0,'" . $amount . "','" . $coin . "'+'" . $amount . "',0,1,0,UNIX_TIMESTAMP(),'" . $actionIP . "','支付宝充值自动到账','" . $id . "','" . $out_trade_no . "')";
            $update1 = "UPDATE xy_order SET state = 2 WHERE order_number = '" . $out_trade_no . "'";
            $update2 = "UPDATE xy_members SET coin = coin+'" . $amount . "' WHERE username = '" . $attach . "'";
            $update3 = "update xy_member_recharge set state=2,rechargeTime=UNIX_TIMESTAMP(),rechargeAmount='" . $amount . "',coin='" . $coin . "',info='支付宝充值自动到账' where rechargeid='" . $out_trade_no . "'";

            $jiancha = mysql_result($chaxun, 0);
            if ($jiancha == 0) {
                if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
                    if (mysql_query($update1, $conn)) {
                        mysql_query($update2, $conn);
                        mysql_query($update3, $conn);
                        mysql_query($inserts, $conn);
                        //echo "您已成功充值，请重新登陆平台界面查看,谢谢!";
                        echo "<html>\n";
                        echo "<head>\n";
                        echo "<title></title>\n";
                        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
                        echo "<meta http-equiv=\"Cache-Control\" content=\"no-cache, must-revalidate\">\n";
                        echo "<style type=\"text/css\">\n";
                        echo " .Prompt_con dd {padding:20px 0;margin:0;display:inline-block;float:left;}\n";
                        echo " /*提示页面*/\n";
                        echo ".Prompt_top, .Prompt_btm, .Prompt_ok, .Prompt_x {background:url(./message.gif) no-repeat; display:inline-block }\n";
                        echo ".Prompt {width:640px;margin:100px auto 180px; }\n";
                        echo ".Prompt_top {background-position:0 0; height:15px;width:100%;}\n";
                        echo ".Prompt_con {border-left:1px solid #E7E7E7;border-right:1px solid #E7E7E7;background:#fff;overflow:hidden;}\n";
                        echo ".Prompt_btm { background-position:0 -27px; height:6px;width:100%;}\n";
                        echo ".Prompt_con dl{overflow:hidden;background:#fff;}\n";
                        echo ".Prompt_con dt {font-size:18px;margin:0;padding:15px; border-bottom:2px solid #E7E7E7;font-weight: bold;_height:20px;}\n";
                        echo ".Prompt_con dd {padding:20px 0;margin:0;display:inline-block;}\n";
                        echo ".Prompt_con dd h2 {display:inline-block;}\n";
                        echo ".Prompt_ok{ background-position:-68px -39px; width:68px; height:68px; }\n";
                        echo ".Prompt_x{ background-position:15px -39px; width:85px; height:68px; }\n";
                        echo "*提示页面end*/\n";
                        echo "</style>\n";
                        echo "<script type=\"text/javascript\">\n";
                        echo "var t=10;//设定跳转的时间\n";
                        echo "setInterval(\"refer()\",1000); //启动1秒定时\n";
                        echo "function refer(){\n";
                        echo "    if(t==0){\n";
                        echo "       location=\"{$weburl}\"; //设定跳转的链接地址\n";
                        echo "    }\n";
                        echo "    document.getElementById('show').innerHTML=\"您已成功充值! <span style='color:red'>\"+t+\"</span>秒后跳转到平台首页\"; //显示倒计时\n";
                        echo "   t--; //计数器递减\n";
                        echo "}\n";
                        echo "</script>\n";
                        echo "<base target=\"_self\" />\n";
                        echo "</head><body>\n";
                        echo "\n";
                        echo "\n";
                        echo " <div class=\"Prompt\">\n";
                        echo "   <div class=\"Prompt_top\"></div>\n";
                        echo " <div class=\"Prompt_con\">\n";
                        echo "   <dl>\n";
                        echo "     <dt>TIPS</dt>\n";
                        echo "     <dd><span class=\"Prompt_ok\"></span></dd>\n";
                        echo "     <dd>\n";
                        echo "     <h2 id=\"show\" style=\"color:#d00000;padding:30px 0 0 25px;\"></h2>\n";
                        echo "    \n";
                        echo "     </dd>\n";
                        echo "   </dl>\n";
                        echo "   <div class=\"c\"></div>\n";
                        echo "   </div>\n";
                        echo "   <div class=\"Prompt_btm\"></div>\n";
                        echo " </div>\n";
                        echo "</body>\n";
                        echo "</html>\n";
                    } else {
                        //echo "数据投递出错";
                         echo "<html>\n";
                        echo "<head>\n";
                        echo "<title></title>\n";
                        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
                        echo "<meta http-equiv=\"Cache-Control\" content=\"no-cache, must-revalidate\">\n";
                        echo "<style type=\"text/css\">\n";
                        echo " .Prompt_con dd {padding:20px 0;margin:0;display:inline-block;float:left;}\n";
                        echo " /*提示页面*/\n";
                        echo ".Prompt_top, .Prompt_btm, .Prompt_ok, .Prompt_x {background:url(./message.gif) no-repeat; display:inline-block }\n";
                        echo ".Prompt {width:640px;margin:100px auto 180px; }\n";
                        echo ".Prompt_top {background-position:0 0; height:15px;width:100%;}\n";
                        echo ".Prompt_con {border-left:1px solid #E7E7E7;border-right:1px solid #E7E7E7;background:#fff;overflow:hidden;}\n";
                        echo ".Prompt_btm { background-position:0 -27px; height:6px;width:100%;}\n";
                        echo ".Prompt_con dl{overflow:hidden;background:#fff;}\n";
                        echo ".Prompt_con dt {font-size:18px;margin:0;padding:15px; border-bottom:2px solid #E7E7E7;font-weight: bold;_height:20px;}\n";
                        echo ".Prompt_con dd {padding:20px 0;margin:0;display:inline-block;}\n";
                        echo ".Prompt_con dd h2 {display:inline-block;}\n";
                        echo ".Prompt_ok{ background-position:-68px -39px; width:68px; height:68px; }\n";
                        echo ".Prompt_x{ background-position:15px -39px; width:85px; height:68px; }\n";
                        echo "*提示页面end*/\n";
                        echo "</style>\n";
                        echo "<script type=\"text/javascript\">\n";
                        echo "var t=10;//设定跳转的时间\n";
                        echo "setInterval(\"refer()\",1000); //启动1秒定时\n";
                        echo "function refer(){\n";
                        echo "    if(t==0){\n";
                        echo "       location=\"http://ew.com\"; //设定跳转的链接地址\n";
                        echo "    }\n";
                        echo "    document.getElementById('show').innerHTML=\"充值失败! <span style='color:red'>\"+t+\"</span>秒后跳转到平台首页\"; //显示倒计时\n";
                        echo "   t--; //计数器递减\n";
                        echo "}\n";
                        echo "</script>\n";
                        echo "<base target=\"_self\" />\n";
                        echo "</head><body>\n";
                        echo "\n";
                        echo "\n";
                        echo " <div class=\"Prompt\">\n";
                        echo "   <div class=\"Prompt_top\"></div>\n";
                        echo " <div class=\"Prompt_con\">\n";
                        echo "   <dl>\n";
                        echo "     <dt>TIPS</dt>\n";
                        echo "     <dd><span class=\"Prompt_x\"></span></dd>\n";
                        echo "     <dd>\n";
                        echo "     <h2 id=\"show\" style=\"color:#d00000;padding:30px 0 0 25px;\"></h2>\n";
                        echo "    \n";
                        echo "     </dd>\n";
                        echo "   </dl>\n";
                        echo "   <div class=\"c\"></div>\n";
                        echo "   </div>\n";
                        echo "   <div class=\"Prompt_btm\"></div>\n";
                        echo " </div>\n";
                        echo "</body>\n";
                        echo "</html>\n";
                    }
                } else {
                    //echo "交易失败";
                     echo "<html>\n";
                        echo "<head>\n";
                        echo "<title></title>\n";
                        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
                        echo "<meta http-equiv=\"Cache-Control\" content=\"no-cache, must-revalidate\">\n";
                        echo "<style type=\"text/css\">\n";
                        echo " .Prompt_con dd {padding:20px 0;margin:0;display:inline-block;float:left;}\n";
                        echo " /*提示页面*/\n";
                        echo ".Prompt_top, .Prompt_btm, .Prompt_ok, .Prompt_x {background:url(./message.gif) no-repeat; display:inline-block }\n";
                        echo ".Prompt {width:640px;margin:100px auto 180px; }\n";
                        echo ".Prompt_top {background-position:0 0; height:15px;width:100%;}\n";
                        echo ".Prompt_con {border-left:1px solid #E7E7E7;border-right:1px solid #E7E7E7;background:#fff;overflow:hidden;}\n";
                        echo ".Prompt_btm { background-position:0 -27px; height:6px;width:100%;}\n";
                        echo ".Prompt_con dl{overflow:hidden;background:#fff;}\n";
                        echo ".Prompt_con dt {font-size:18px;margin:0;padding:15px; border-bottom:2px solid #E7E7E7;font-weight: bold;_height:20px;}\n";
                        echo ".Prompt_con dd {padding:20px 0;margin:0;display:inline-block;}\n";
                        echo ".Prompt_con dd h2 {display:inline-block;}\n";
                        echo ".Prompt_ok{ background-position:-68px -39px; width:68px; height:68px; }\n";
                        echo ".Prompt_x{ background-position:15px -39px; width:85px; height:68px; }\n";
                        echo "*提示页面end*/\n";
                        echo "</style>\n";
                        echo "<script type=\"text/javascript\">\n";
                        echo "var t=10;//设定跳转的时间\n";
                        echo "setInterval(\"refer()\",1000); //启动1秒定时\n";
                        echo "function refer(){\n";
                        echo "    if(t==0){\n";
                        echo "       location=\"http://ew.com\"; //设定跳转的链接地址\n";
                        echo "    }\n";
                        echo "    document.getElementById('show').innerHTML=\"充值失败! <span style='color:red'>\"+t+\"</span>秒后跳转到平台首页\"; //显示倒计时\n";
                        echo "   t--; //计数器递减\n";
                        echo "}\n";
                        echo "</script>\n";
                        echo "<base target=\"_self\" />\n";
                        echo "</head><body>\n";
                        echo "\n";
                        echo "\n";
                        echo " <div class=\"Prompt\">\n";
                        echo "   <div class=\"Prompt_top\"></div>\n";
                        echo " <div class=\"Prompt_con\">\n";
                        echo "   <dl>\n";
                        echo "     <dt>TIPS</dt>\n";
                        echo "     <dd><span class=\"Prompt_x\"></span></dd>\n";
                        echo "     <dd>\n";
                        echo "     <h2 id=\"show\" style=\"color:#d00000;padding:30px 0 0 25px;\"></h2>\n";
                        echo "    \n";
                        echo "     </dd>\n";
                        echo "   </dl>\n";
                        echo "   <div class=\"c\"></div>\n";
                        echo "   </div>\n";
                        echo "   <div class=\"Prompt_btm\"></div>\n";
                        echo " </div>\n";
                        echo "</body>\n";
                        echo "</html>\n";
                }
            } else {
                //echo "您已充值，请勿反复刷新,谢谢!";
                echo "<html>\n";
                        echo "<head>\n";
                        echo "<title></title>\n";
                        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
                        echo "<meta http-equiv=\"Cache-Control\" content=\"no-cache, must-revalidate\">\n";
                        echo "<style type=\"text/css\">\n";
                        echo " .Prompt_con dd {padding:20px 0;margin:0;display:inline-block;float:left;}\n";
                        echo " /*提示页面*/\n";
                        echo ".Prompt_top, .Prompt_btm, .Prompt_ok, .Prompt_x {background:url(./message.gif) no-repeat; display:inline-block }\n";
                        echo ".Prompt {width:640px;margin:100px auto 180px; }\n";
                        echo ".Prompt_top {background-position:0 0; height:15px;width:100%;}\n";
                        echo ".Prompt_con {border-left:1px solid #E7E7E7;border-right:1px solid #E7E7E7;background:#fff;overflow:hidden;}\n";
                        echo ".Prompt_btm { background-position:0 -27px; height:6px;width:100%;}\n";
                        echo ".Prompt_con dl{overflow:hidden;background:#fff;}\n";
                        echo ".Prompt_con dt {font-size:18px;margin:0;padding:15px; border-bottom:2px solid #E7E7E7;font-weight: bold;_height:20px;}\n";
                        echo ".Prompt_con dd {padding:20px 0;margin:0;display:inline-block;}\n";
                        echo ".Prompt_con dd h2 {display:inline-block;}\n";
                        echo ".Prompt_ok{ background-position:-68px -39px; width:68px; height:68px; }\n";
                        echo ".Prompt_x{ background-position:15px -39px; width:85px; height:68px; }\n";
                        echo "*提示页面end*/\n";
                        echo "</style>\n";
                        echo "<script type=\"text/javascript\">\n";
                        echo "var t=10;//设定跳转的时间\n";
                        echo "setInterval(\"refer()\",1000); //启动1秒定时\n";
                        echo "function refer(){\n";
                        echo "    if(t==0){\n";
                        echo "       location=\"http://ew.com\"; //设定跳转的链接地址\n";
                        echo "    }\n";
                        echo "    document.getElementById('show').innerHTML=\"充值失败! <span style='color:red'>\"+t+\"</span>秒后跳转到平台首页\"; //显示倒计时\n";
                        echo "   t--; //计数器递减\n";
                        echo "}\n";
                        echo "</script>\n";
                        echo "<base target=\"_self\" />\n";
                        echo "</head><body>\n";
                        echo "\n";
                        echo "\n";
                        echo " <div class=\"Prompt\">\n";
                        echo "   <div class=\"Prompt_top\"></div>\n";
                        echo " <div class=\"Prompt_con\">\n";
                        echo "   <dl>\n";
                        echo "     <dt>TIPS</dt>\n";
                        echo "     <dd><span class=\"Prompt_x\"></span></dd>\n";
                        echo "     <dd>\n";
                        echo "     <h2 id=\"show\" style=\"color:#d00000;padding:30px 0 0 25px;\"></h2>\n";
                        echo "    \n";
                        echo "     </dd>\n";
                        echo "   </dl>\n";
                        echo "   <div class=\"c\"></div>\n";
                        echo "   </div>\n";
                        echo "   <div class=\"Prompt_btm\"></div>\n";
                        echo " </div>\n";
                        echo "</body>\n";
                        echo "</html>\n";
            }


            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            //echo "验证失败";
            echo "<html>\n";
                        echo "<head>\n";
                        echo "<title></title>\n";
                        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
                        echo "<meta http-equiv=\"Cache-Control\" content=\"no-cache, must-revalidate\">\n";
                        echo "<style type=\"text/css\">\n";
                        echo " .Prompt_con dd {padding:20px 0;margin:0;display:inline-block;float:left;}\n";
                        echo " /*提示页面*/\n";
                        echo ".Prompt_top, .Prompt_btm, .Prompt_ok, .Prompt_x {background:url(./message.gif) no-repeat; display:inline-block }\n";
                        echo ".Prompt {width:640px;margin:100px auto 180px; }\n";
                        echo ".Prompt_top {background-position:0 0; height:15px;width:100%;}\n";
                        echo ".Prompt_con {border-left:1px solid #E7E7E7;border-right:1px solid #E7E7E7;background:#fff;overflow:hidden;}\n";
                        echo ".Prompt_btm { background-position:0 -27px; height:6px;width:100%;}\n";
                        echo ".Prompt_con dl{overflow:hidden;background:#fff;}\n";
                        echo ".Prompt_con dt {font-size:18px;margin:0;padding:15px; border-bottom:2px solid #E7E7E7;font-weight: bold;_height:20px;}\n";
                        echo ".Prompt_con dd {padding:20px 0;margin:0;display:inline-block;}\n";
                        echo ".Prompt_con dd h2 {display:inline-block;}\n";
                        echo ".Prompt_ok{ background-position:-68px -39px; width:68px; height:68px; }\n";
                        echo ".Prompt_x{ background-position:15px -39px; width:85px; height:68px; }\n";
                        echo "*提示页面end*/\n";
                        echo "</style>\n";
                        echo "<script type=\"text/javascript\">\n";
                        echo "var t=10;//设定跳转的时间\n";
                        echo "setInterval(\"refer()\",1000); //启动1秒定时\n";
                        echo "function refer(){\n";
                        echo "    if(t==0){\n";
                        echo "       location=\"http://ew.com\"; //设定跳转的链接地址\n";
                        echo "    }\n";
                        echo "    document.getElementById('show').innerHTML=\"充值失败! <span style='color:red'>\"+t+\"</span>秒后跳转到平台首页\"; //显示倒计时\n";
                        echo "   t--; //计数器递减\n";
                        echo "}\n";
                        echo "</script>\n";
                        echo "<base target=\"_self\" />\n";
                        echo "</head><body>\n";
                        echo "\n";
                        echo "\n";
                        echo " <div class=\"Prompt\">\n";
                        echo "   <div class=\"Prompt_top\"></div>\n";
                        echo " <div class=\"Prompt_con\">\n";
                        echo "   <dl>\n";
                        echo "     <dt>TIPS</dt>\n";
                        echo "     <dd><span class=\"Prompt_x\"></span></dd>\n";
                        echo "     <dd>\n";
                        echo "     <h2 id=\"show\" style=\"color:#d00000;padding:30px 0 0 25px;\"></h2>\n";
                        echo "    \n";
                        echo "     </dd>\n";
                        echo "   </dl>\n";
                        echo "   <div class=\"c\"></div>\n";
                        echo "   </div>\n";
                        echo "   <div class=\"Prompt_btm\"></div>\n";
                        echo " </div>\n";
                        echo "</body>\n";
                        echo "</html>\n";
        }
mysql_close($conn);
        ?>
        <title>支付宝即时到账交易接口</title>
    </head>
    <body>
    </body>
</html>