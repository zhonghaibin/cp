<?php
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
 */

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代

	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
	
    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
	
	//商户订单号

	$out_trade_no = $_POST['out_trade_no'];

	//支付宝交易号

	$trade_no = $_POST['trade_no'];

	//交易状态
	$trade_status = $_POST['trade_status'];
        
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
                       return "success";
                    } else {
                       return "fail";
                    }
                } else {
                     return "success";
                }
            } else {
                return "success";
            }

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
        
//	echo "success";		//请不要修改或删除
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "fail";

    //调试用，写文本函数记录程序运行情况是否正常
    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
}
        mysql_close($conn);
?>