<!--//复制程序 flash+js------end-->
<?php
$this->freshSession();
$mBankId = $args[0]['mBankId'];
$sql = "select mb.*, b.name bankName, b.logo bankLogo, b.home bankHome from {$this->prename}sysadmin_bank mb, {$this->prename}bank_list b where b.isDelete=0 and mb.id=$mBankId and mb.bankId=b.id";
$memberBank = $this->getRow($sql);
if ($memberBank['bankId'] == 12) {
    ?>
    <!--左边栏body-->
    <div class="content3 wjcont">
        <div class="body">
       <!--form action="http://<?= $_SERVER['HTTP_HOST'] ?>/yeepayss/pays.php" method="POST" name="a32" href="#" target="_blank">
            <div class="chongzhi3">
                <h2>请核对充值信息：</h2>
           <ul>
            <li><span>银行类型：</span><b><?= $memberBank['bankName'] ?></b></li>
            <li><span>充值编号：</span><?= $args[0]['rechargeId'] ?></li>
            <li><span>充值金额：</span><?= $args[0]['amount'] ?>&nbsp元</li>
           </ul>
            <input name="p2_Order" type="hidden" value="<?= $args[0]['rechargeId'] ?>" />
            <input name="p3_Amt" type="hidden" value="<?= $args[0]['amount'] ?>" />
            <input name="pa_MP" type="hidden" value="<?= $this->user['username'] ?>" />
            <h3><input id="" type="submit" class="an" value="进入支付" /><input type="reset" onclick="window.location.reload();" class="an" value="重置" /></h3>
       </div>
       </form-->
            <script type="text/javascript">
                function test() {
                    var temp = document.getElementsByName("rdoBanks");
                    var bankTypeID = "";
                    for (var i = 0; i < temp.length; i++) {
                        if (temp[i].checked)
                            var bankTypeID = temp[i].value;
                    }
                    if (bankTypeID.length <= 0) {
                        alert("请输入正确的充值支付银行！");
                        return;
                    }
                    window.open("http://<?= $_SERVER['HTTP_HOST'] ?>/ipsss/redirect.php?Amount=<?= $args[0]['amount'] ?>&Billno=<?= $args[0]['rechargeId'] ?>&Attach=<?= $this->user['username'] ?>&bankNum=" + bankTypeID, '_blank', 'height=573,width=703,top=200,left=200,status=yes,toolbar=no,menubar=no,resizable=yes,scrollbars=no,location=no,titlebar=no');
                    mDaoJiShi();
                }
                //截止倒计时
                function mDaoJiShi() {
                    document.getElementById("btnCC").value = "已提交";
                    document.getElementById("btnCC").readOnly = true;
                    document.getElementById("btnCC").disabled = true;
                }
            </script>
            <div class="chongzhi3">
                <h2 style="padding-top:0px;">请核对充值信息：</h2>
                <ul>
                    <li><span>银行类型：</span><b><?= $memberBank['bankName'] ?></b></li>
                    <li><span>充值编号：</span><?= $args[0]['rechargeId'] ?></li>
                    <li><span>充值金额：</span><?= $args[0]['amount'] ?>&nbsp元</li>
                </ul>
                <h2 style="padding-top:0px;margin-top:-20px;">请选择充值银行：</h2>
                <div style="border: 1px solid #CCCCCC;background-color: #f6f6f6;padding:0 20px 20px 140px;margin-bottom: 20px;">
                    <table id="rdoBanks" border="0" style="color:#333333;border-style:None;font-size:14px;font-weight:normal;">
                        <tr>
                            <td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_0" type="radio" name="rdoBanks" value="00054" /><label for="rdoBanks_0">中信银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_1" type="radio" name="rdoBanks" value="00083" /><label for="rdoBanks_1">中国银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_2" type="radio" name="rdoBanks" value="00122" /><label for="rdoBanks_2">中国农业银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_3" type="radio" name="rdoBanks" value="00174" /><label for="rdoBanks_3">中国建设银行</label></span></td>
                        </tr><tr>
                            <td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_4" type="radio" name="rdoBanks" value="00124" /><label for="rdoBanks_4">中国工商银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_5" type="radio" name="rdoBanks" value="00196" /><label for="rdoBanks_5">浙商银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_6" type="radio" name="rdoBanks" value="00209" /><label for="rdoBanks_6">浙江泰隆商业银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_7" type="radio" name="rdoBanks" value="00128" /><label for="rdoBanks_7">招商银行</label></span></td>
                        </tr><tr>
                            <td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_8" type="radio" name="rdoBanks" value="00051" /><label for="rdoBanks_8">邮政储蓄</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_9" type="radio" name="rdoBanks" value="00016" /><label for="rdoBanks_9">兴业银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_10" type="radio" name="rdoBanks" value="00023" /><label for="rdoBanks_10">深圳发展银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_11" type="radio" name="rdoBanks" value="00084" /><label for="rdoBanks_11">上海银行</label></span></td>
                        </tr><tr>
                            <td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_12" type="radio" name="rdoBanks" value="00198" /><label for="rdoBanks_12">浦东发展银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_13" type="radio" name="rdoBanks" value="00087" /><label for="rdoBanks_13">平安银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_14" type="radio" name="rdoBanks" value="00085" /><label for="rdoBanks_14">宁波银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_15" type="radio" name="rdoBanks" value="00194" /><label for="rdoBanks_15">南京银行</label></span></td>
                        </tr><tr>
                            <td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_16" type="radio" name="rdoBanks" value="00013" /><label for="rdoBanks_16">民生银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_17" type="radio" name="rdoBanks" value="00005" /><label for="rdoBanks_17">交通银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_18" type="radio" name="rdoBanks" value="00041" /><label for="rdoBanks_18">华夏银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_19" type="radio" name="rdoBanks" value="00149" /><label for="rdoBanks_19">河北银行</label></span></td>
                        </tr><tr>
                            <td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_20" type="radio" name="rdoBanks" value="00081" /><label for="rdoBanks_20">杭州银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_21" type="radio" name="rdoBanks" value="00052" /><label for="rdoBanks_21">广发银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_22" type="radio" name="rdoBanks" value="00057" /><label for="rdoBanks_22">光大银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_23" type="radio" name="rdoBanks" value="00096" /><label for="rdoBanks_23">东亚银行</label></span></td>
                        </tr><tr>
                            <td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_24" type="radio" name="rdoBanks" value="00095" /><label for="rdoBanks_24">渤海银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_25" type="radio" name="rdoBanks" value="00212" /><label for="rdoBanks_25">北京银行</label></span></td><td><span style="margin: 3px;padding:3px;"><input id="rdoBanks_26" type="radio" name="rdoBanks" value="00056" /><label for="rdoBanks_26">北京农村商业银行</label></span></td><td></td>
                        </tr>
                    </table>
                </div><h3><input id="btnCC" type="submit" class="an" onclick="test()" value="进入支付"/><input type="reset" onclick="window.location.reload();" class="an" value="重置" /></h3></div>

            <div class="chongzhi2">
                <h3>充值说明：</h3>
                <ul>
                    <li>1、每次"充值编号"均不相同,务必将"充值编号"正确复制填写到引号汇款页面的"附言"栏目中；</li>
                    <li>2、帐号不固定，转帐前请仔细核对该帐号；</li>
                    <li>3、充值金额与网友转账金额不符，充值将无法到账；</li>
                    <li>4、转账后如10分钟未到账，请联系客服，告知您的充值编号和您的充值金额及你的银行用户姓名。</li>
                </ul>
            </div>
            <div class="bank"></div>
        </div>
        <div class="foot"></div>
    </div>
    <!--左边栏body end-->
    <?
    }elseif($memberBank['bankId']==23){
    ?>
    <!--左边栏body-->
    <div class="content3 wjcont">
        <div class="body">
            <script type="text/javascript">
                function alipay() {
                    window.open("http://<?= $_SERVER['HTTP_HOST'] ?>/ipsss/redirect.php?Amount=<?= $args[0]['amount'] ?>&Billno=<?= $args[0]['rechargeId'] ?>&Attach=<?= $this->user['username'] ?>&bankNum=" + bankTypeID, '_blank', 'height=573,width=703,top=200,left=200,status=yes,toolbar=no,menubar=no,resizable=yes,scrollbars=no,location=no,titlebar=no');
                    mDaoJiShi();
                }
                //截止倒计时
                function mDaoJiShi() {
                    document.getElementById("btnCC").value = "已提交";
                    document.getElementById("btnCC").readOnly = true;
                    document.getElementById("btnCC").disabled = true;
                }
            </script>


            <form action="http://<?= $_SERVER['HTTP_HOST'] ?>/alipay/alipayapi.php" method="POST" name="a32" href="#" target="_blank">
                <div class="chongzhi3">
                    <h2>请核对充值信息：</h2>
                    <ul>
                        <li><span>银行类型：</span><b><?= $memberBank['bankName'] ?></b></li>
                        <li><span>充值编号：</span><?= $args[0]['rechargeId'] ?></li>
                        <li><span>充值金额：</span><?= $args[0]['amount'] ?>&nbsp元</li>
                    </ul>
                    <input id="WIDout_trade_no" name="WIDout_trade_no" readonly type="hidden" value="<?= $args[0]['rechargeId'] ?>" />
                    <input id="WIDtotal_fee" name="WIDtotal_fee" type="hidden" value="0.01" />
                    <input type="hidden" id="WIDsubject" name="WIDsubject" readonly value="支付宝在线支付" class="text4" />
                    <input name="pa_MP" type="hidden" value="<?= $this->user['username'] ?>" />
                    <input type="hidden" id="WIDbody" name="WIDbody" readonly value="支付宝在线支付" class="text4" />
                    <h3><input id="" type="submit" class="an" value="进入支付" /><input type="reset" onclick="window.location.reload();" class="an" value="重置" /></h3>
                </div>
            </form>

            <!--        <div class="chongzhi3">
                     <h2 style="padding-top:0px;">请核对充值信息：</h2>
                <form action="http://<?= $_SERVER['HTTP_HOST'] ?>/alipay/alipayapi.php" class="alipayform" method="post" target="_blank">
                <ul>
                 <li><span>充值类型：</span><b><?= $memberBank['bankName'] ?></b></li>
                 <li><span>商户订单号：</span><input type="text" id="WIDout_trade_no" name="WIDout_trade_no" readonly value="<?= $args[0]['rechargeId'] ?>" class="text4" /></li>
                 <li><span>商品名称：</span><input type="text" id="WIDsubject" name="WIDsubject" readonly value="test商品" class="text4" /></li>
                 <li><span>商品描述：</span><input type="text" id="WIDbody" name="WIDbody" readonly value="即时到账测试" class="text4" /></li>
                 <li><span>付款金额：</span><input type="text" id="WIDtotal_fee" name="WIDtotal_fee" readonly value="0.01" class="text4" /><?= $args[0]['amount'] ?>&nbsp元</li>
                </ul>
                    <h3><input id="btnCC" type="submit"  value="进入支付"/><input type="reset" onclick="window.location.reload();" class="an" value="重置" /></h3>
                </div>-->
            <div class="chongzhi2">
                <h3>充值说明：</h3>
                <ul>
                    <li>1、每次"充值编号"均不相同,务必将"充值编号"正确复制填写到引号汇款页面的"附言"栏目中；</li>
                    <li>2、帐号不固定，转帐前请仔细核对该帐号；</li>
                    <li>3、充值金额与网友转账金额不符，充值将无法到账；</li>
                    <li>4、转账后如10分钟未到账，请联系客服，告知您的充值编号和您的充值金额及你的银行用户姓名。</li>
                </ul>
            </div>
            <div class="bank"></div>
        </div>
        <div class="foot"></div>
    </div>
    <!--左边栏body end-->
    <?
    }else{
    ?>
    <div class="content3 wjcont">
        <div class="body">
            <div class="chongzhi1">
                <h2>充值信息：</h2>
                <ul>
                    <li><span>银行类型：</span><b><?= $memberBank['bankName'] ?></b><strong><a href="<?= $memberBank['bankHome'] ?>" target="_blank">进入银行网站>></a></strong></li>
                    <li><span>银行账号：</span><input type="text" id="bank-account" readonly value="<?= $memberBank["account"] ?>" class="text4" />
                        <em class="copy" for="bank-account" >
                            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="62" height="43" id="copy-account" align="top">
                                <param name="allowScriptAccess" value="always" />
                                <param name="movie" value="/skin/js/copy.swf?movieID=copy-account&inputID=bank-account" />
                                <param name="quality" value="high" />
                                <param name="wmode" value="transparent">
                                <param name="bgcolor" value="#ffffff" />
                                <param name="scale" value="noscale" /><!-- FLASH原始像素显示-->
                                <embed src="/skin/js/copy.swf?movieID=copy-account&inputID=bank-account" width="62" height="43" name="copy-account" align="top" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                            </object>
                        </em>
                    </li>
                    <li><span>账户名：</span><input type="text" id="bank-username" readonly value="<?= $memberBank["username"] ?>" class="text4" />
                        <em class="copy" for="bank-username">
                            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="62" height="43" id="copy-bankuser" align="top">
                                <param name="allowScriptAccess" value="always" />
                                <param name="movie" value="/skin/js/copy.swf?movieID=copy-bankuser&inputID=bank-username" />
                                <param name="quality" value="high" />
                                <param name="wmode" value="transparent">
                                <param name="bgcolor" value="#ffffff" />
                                <param name="scale" value="noscale" /><!-- FLASH原始像素显示-->
                                <embed src="/skin/js/copy.swf?movieID=copy-bankuser&inputID=bank-username" width="62" height="43" name="copy-bankuser" align="top" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                            </object> 
                        </em>
                    </li>
                    <li><span>充值金额：</span><input type="text" id="recharg-amount" readonly value="<?= $args[0]['amount'] ?>" class="text4" />
                        <em class="copy" for="recharg-amount"><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="62" height="43" id="copy-recharg" align="top">
                                <param name="allowScriptAccess" value="always" />
                                <param name="movie" value="/skin/js/copy.swf?movieID=copy-recharg&inputID=recharg-amount" />
                                <param name="quality" value="high" />
                                <param name="wmode" value="transparent">
                                <param name="bgcolor" value="#ffffff" />
                                <param name="scale" value="noscale" /><!-- FLASH原始像素显示-->
                                <embed src="/skin/js/copy.swf?movieID=copy-recharg&inputID=recharg-amount" width="62" height="43" name="copy-recharg" align="top" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                            </object>
                        </em>
                        网银充值金额必须与网站填写金额一致方能到账！</li>
                    <li><span>充值编号：</span><input type="text" id="username" readonly value="<?= $args[0]['rechargeId'] ?>" class="text4" />
                    <em class="copy" for="username">
                        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="62" height="43" id="copy-username" align="top">
                            <param name="allowScriptAccess" value="always" />
                            <param name="movie" value="/skin/js/copy.swf?movieID=copy-username&inputID=username" />
                            <param name="quality" value="high" />
                            <param name="wmode" value="transparent">
                            <param name="bgcolor" value="#ffffff" />
                            <param name="scale" value="noscale" /><!-- FLASH原始像素显示-->
                            <embed src="/skin/js/copy.swf?movieID=copy-username&inputID=username" width="62" height="43" name="copy-username" align="top" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                        </object> 
                    </em>
                    每个充值编号仅用于一笔充值，重复使用将不能到账！</li>
            </ul>
        </div>
        <div class="chongzhi2">
            <h3>充值说明：</h3>
            <ul>
                <li>1、每次"充值编号"均不相同,务必将"充值编号"正确复制填写到引号汇款页面的"附言"栏目中；</li>
                <li>2、帐号不固定，转帐前请仔细核对该帐号；</li>
                <li>3、充值金额与网友转账金额不符，充值将无法到账；</li>
                <li>4、转账后如10分钟未到账，请联系客服，告知您的充值编号和您的充值金额及你的银行用户姓名。</li>
            </ul>
        </div>
        <div class="bank"></div>
    </div>
    <div class="foot"></div>
</div>
<?
}
?>