<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('#editor_1',{
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : false,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link']
				});
			});
</script>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header><h3 class="tabs_involved">系统设置</h3></header>
	<form name="system_install" action="/admin778899.php/system/updateSettings" method="post" target="ajax" call="sysSettings" onajax="sysSettingsBefor">
	<table class="tablesorter left" cellspacing="0" width="100%">
		<thead>
			<tr>
				<td width="160" style="text-align:left;">配置项目</td>
				<td style="text-align:left;">配置值</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>平台名称</td>
				<td><input type="text" value="<?=$this->settings['webName']?>" name="webName"/></td>
			</tr>
			<tr>
				<td>网站开关</td>
				<td>
					<label><input type="radio" value="1" name="switchWeb" <?=$this->iff($this->settings['switchWeb'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="switchWeb" <?=$this->iff(!$this->settings['switchWeb'],'checked="checked"')?>/>关闭</label>
				</td>
			</tr>
			<tr>
				<td>网站关闭公告</td>
				<td>
					<textarea name="webCloseServiceResult" cols="56" rows="5"><?=$this->settings['webCloseServiceResult']?></textarea>
				</td>
			</tr>
            <tr>
				<td>总投注开关</td>
				<td>
					<label><input type="radio" value="1" name="switchBuy" <?=$this->iff($this->settings['switchBuy'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="switchBuy" <?=$this->iff(!$this->settings['switchBuy'],'checked="checked"')?>/>关闭</label>
				</td>

			</tr>
			<tr>
				<td>代理投注开关</td>
				<td>
					<label><input type="radio" value="1" name="switchDLBuy" <?=$this->iff($this->settings['switchDLBuy'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="switchDLBuy" <?=$this->iff(!$this->settings['switchDLBuy'],'checked="checked"')?>/>关闭</label>
				</td>
			</tr>
			<tr>
				<td>总代投注开关</td>
				<td>
					<label><input type="radio" value="1" name="switchZDLBuy" <?=$this->iff($this->settings['switchZDLBuy'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="switchZDLBuy" <?=$this->iff(!$this->settings['switchZDLBuy'],'checked="checked"')?>/>关闭</label>
				</td>
			</tr>
			<tr>
				<td>上级充值开关</td>
				<td>
					<label><input type="radio" value="1" name="recharge" <?=$this->iff($this->settings['recharge'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="recharge" <?=$this->iff(!$this->settings['recharge'],'checked="checked"')?>/>关闭</label>
				</td>
			</tr>
			<tr>
				<td>投注模式</td>
				<td>
					<label><input type="checkbox" name="yuanmosi" value="<?=$this->settings['yuanmosi']?>" <?=$this->iff($this->settings['yuanmosi']==1,'checked="checked"')?>/>元</label>
					<label><input type="checkbox" name="jiaomosi" value="<?=$this->settings['jiaomosi']?>" <?=$this->iff($this->settings['jiaomosi']==1,'checked="checked"')?>/>角</label>
					<label><input type="checkbox" name="fenmosi"  value="<?=$this->settings['fenmosi']?>"  <?=$this->iff($this->settings['fenmosi']==1, 'checked="checked"')?>/>分</label>
					<label><input type="checkbox" name="limosi"   value="<?=$this->settings['limosi']?>"   <?=$this->iff($this->settings['limosi']==1,  'checked="checked"')?>/>厘</label>
					<br />
				</td>
			</tr>
			<script type="text/javascript">
			     $("input[name=yuanmosi]").click(function(){if($(this).attr("checked")==true){$(this).val(1);}else{if(<? echo $this->settings['yuanmosi'];?>==0){$(this).val(1);}else{$(this).val(0);}}})
			     $("input[name=jiaomosi]").click(function(){if($(this).attr("checked")==true){$(this).val(1);}else{if(<? echo $this->settings['jiaomosi'];?>==0){$(this).val(1);}else{$(this).val(0);}}})
			     $("input[name=fenmosi]").click(function(){if($(this).attr("checked")==true){$(this).val(1);}else{if(<? echo $this->settings['fenmosi'];?>==0){$(this).val(1);}else{$(this).val(0);}}})
			     $("input[name=limosi]").click(function(){if($(this).attr("checked")==true){$(this).val(1);}else{if(<? echo $this->settings['limosi'];?>==0){$(this).val(1);}else{$(this).val(0);}}})
		    </script>
			<tr>
				<td>系统彩种利润</td>
				<td>
					<label><input type="radio" value="2" name="LiRunLv" <?=$this->iff($this->settings['LiRunLv'],'checked="checked"')?>/>2%盈利</label>
					<label><input type="radio" value="-900" name="LiRunLv" <?=$this->iff($this->settings['LiRunLv']==-900,'checked="checked"')?>/>随机</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp设置好后须重启开将器才能生效
				</td>
			</tr>
			<tr>
				<td>返点最大值</td>
				<td><input type="text" class="textWid1" value="<?=$this->settings['fanDianMax']?>" name="fanDianMax"/>%</td>
			</tr>
			<tr>
				<td>上下级返点最小差值</td>
				<td><input type="text" class="textWid1" value="<?=$this->settings['fanDianDiff']?>" name="fanDianDiff"/>%</td>
			</tr>
			<tr>
				<td>最大返点限制</td>
				<td>
                	  元模式：<input type="text" class="textWid1" value="<?=$this->settings['betModeMaxFanDian0']?>" name="betModeMaxFanDian0"/>%
                	　角模式：<input type="text" class="textWid1" value="<?=$this->settings['betModeMaxFanDian1']?>" name="betModeMaxFanDian1"/>%
                	　分模式：<input type="text" class="textWid1" value="<?=$this->settings['betModeMaxFanDian2']?>" name="betModeMaxFanDian2"/>%
					  厘模式：<input type="text" class="textWid1" value="<?=$this->settings['betModeMaxFanDian3']?>" name="betModeMaxFanDian3"/>%
                </td>
			</tr>
			<tr>
				<td>最大投注限制</td>
				<td>
                	  最大注数：<input type="text" class="textWid1" value="<?=$this->settings['betMaxCount']?>" name="betMaxCount"/>注
                	　最大中奖：<input type="text" class="textWid1" value="<?=$this->settings['betMaxZjAmount']?>" name="betMaxZjAmount"/>元
                </td>
			</tr>
			<tr>
				<td>充值限制</td>
				<td>
                	最低金额：<input type="text" class="textWid1" value="<?=$this->settings['rechargeMin']?>" name="rechargeMin"/>元&nbsp;&nbsp; 
                    最高金额：<input type="text" class="textWid1" value="<?=$this->settings['rechargeMax']?>" name="rechargeMax"/>元
                    <br /><br />
                	支付宝/财付通：最低金额 <input type="text" class="textWid1" value="<?=$this->settings['rechargeMin1']?>" name="rechargeMin1"/>元&nbsp;&nbsp;最高金额 <input type="text" class="textWid1" value="<?=$this->settings['rechargeMax1']?>" name="rechargeMax1"/>元&nbsp;&nbsp;
                    
                </td>
			</tr>
			<tr>
				<td>提现限制</td>
				<td>
                	消费满：<input type="text" class="textWid1" value="<?=$this->settings['cashMinAmount']?>" name="cashMinAmount"/>%&nbsp;&nbsp;
					最低金额：<input type="text" class="textWid1" value="<?=$this->settings['cashMin']?>" name="cashMin"/>元&nbsp;&nbsp;
					最高金额：<input type="text" class="textWid1" value="<?=$this->settings['cashMax']?>" name="cashMax"/>元&nbsp;&nbsp;
					时间段： 从 <input type="time" value="<?=$this->settings['cashFromTime']?>" name="cashFromTime" class="textWid1"/> 到 <input type="time" value="<?=$this->settings['cashToTime']?>" name="cashToTime" class="textWid1"/>
                    &nbsp&nbsp 22:00-02:00<br /><br />
                	支付宝/财付通：最低金额 <input type="text" class="textWid1" value="<?=$this->settings['cashMin1']?>" name="cashMin1"/>元&nbsp;&nbsp;最高金额 <input type="text" class="textWid1" value="<?=$this->settings['cashMax1']?>" name="cashMax1"/>元&nbsp;&nbsp;
				</td>
			</tr>
			<tr>
				<td>提款排队人数</td>
				<td><input type="text" class="textWid1" value="<?=$this->settings['cashPersons']?>" name="cashPersons"/>人&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 排队人数=真实+后台</td>
			</tr>
			<tr>
				<td>清理账号规则</td>
				<td>账户金额低于&nbsp;<input type="text" class="textWid1" value="<?=$this->settings['clearMemberCoin']?>" name="clearMemberCoin" id="clearMemberCoin"/>元，&nbsp;且&nbsp;<input type="text" class="textWid1" value="<?=$this->settings['clearMemberDate']?>" name="clearMemberDate" id="clearMemberDate"/> &nbsp;天未登录&nbsp;&nbsp;<a method="post" target="ajax" onajax="clearUsersBefor" call="clearDataSuccess" title="数据清除不可修复，是否继续！" dataType="json" id="alt_btn3" href="/admin778899.php/System/clearUser">清理</a></td>
			</tr>
			<tr>
				<td>清理数据</td>
				<td>清除当前 <input type="date" readonly="readonly" id="clearData" /> 以前的投注、帐变、管理员日志、会员登录日志、提现、充值、采集记录数据&nbsp;&nbsp;<a method="post" target="ajax" onajax="clearDataBefor" call="clearDataSuccess" title="数据清除不可修复，是否继续！" dataType="json" id="alt_btn3" href="/admin778899.php/System/clearData">清理</a></td>
			</tr>
			<tr>
				<td>清理数据 2</td>
				<td>仅清除当前 <input type="date" readonly="readonly" id="clearData2" /> 以前的采集记录数据&nbsp;&nbsp;<a method="post" target="ajax" onajax="clearDataBefor2" call="clearDataSuccess2" title="采集记录数据清除不可修复，是否继续！" dataType="json" id="alt_btn3" href="/admin778899.php/System/clearData2">清理</a></td>
			</tr>
			<tr>
				<td>赠送活动</td>
				<td>首次注册绑定工行送<input class="textWid1" type="text" value="<?=$this->settings['huoDongRegister']?>" name="huoDongRegister"/>元 &nbsp;&nbsp;每天签到每次送<input type="text" class="textWid1" value="<?=$this->settings['huoDongSign']?>" name="huoDongSign"/>元，如果为0则关闭活动</td>
			</tr>
			<tr>
				<td>充值赠送 活动</td>
                <td>
                	  每次充值赠送本人：<input type="text" class="textWid1" value="<?=$this->settings['czzs']?>" name="czzs"/>%，如果为0则关闭活动
                </td>
			</tr>
			<tr>
				<td>推广注册活动</td>
				<td>每发展一个会员，赠送<input class="textWid1" type="text" value="<?=$this->settings['regReceiveMoney']?>" name="regReceiveMoney"/>元 &nbsp;&nbsp;同一IP最多注册<input type="text" class="textWid1" value="<?=$this->settings['maxRegCount']?>" name="maxRegCount"/>个账户，如果为0则关闭活动</td>
			</tr>
			<tr>
				<td>充值佣金 活动</td>
				<td>每天首次充值金额<input class="textWid1" type="text" value="<?=$this->settings['rechargeCommissionAmount']?>" name="rechargeCommissionAmount"/>元以上，上家送<input type="text" class="textWid1" value="<?=$this->settings['rechargeCommission']?>" name="rechargeCommission"/>元佣金，上上家送<input class="textWid1" type="text" value="<?=$this->settings['rechargeCommission2']?>" name="rechargeCommission2"/>元佣金，如果为0则关闭活动</td>
			</tr>
			<tr>
				<td>消费佣金 活动</td>
				<td>
				<p>每天消费达<input class="textWid1" type="text" value="<?=$this->settings['conCommissionBase']?>" name="conCommissionBase"/>元时，上家送<input  class="textWid1"type="text" value="<?=$this->settings['conCommissionParentAmount']?>" name="conCommissionParentAmount"/>元佣金，上上家送<input  class="textWid1"type="text" value="<?=$this->settings['conCommissionParentAmount2']?>" name="conCommissionParentAmount2"/>元佣金，如果为0则关闭活动</p>
				</p></td>
			</tr>
			<tr>
			<td rowspan="2">亏损佣金活动</td>
				<td>
				<p>每天亏损达<input class="textWid1" type="text" value="<?=$this->settings['lossCommissionBase1']?>" name="lossCommissionBase1"/>元时，上家送<input  class="textWid1"type="text" value="<?=$this->settings['lossCommissionParentAmount3']?>" name="lossCommissionParentAmount3"/>元佣金，如果为0则关闭活动</p>
					</p>
				</td>
			</tr>
			<tr>
				<td>
				<p>每天亏损达<input class="textWid1" type="text" value="<?=$this->settings['lossCommissionBase']?>" name="lossCommissionBase"/>元时，上家送<input  class="textWid1"type="text" value="<?=$this->settings['lossCommissionParentAmount']?>" name="lossCommissionParentAmount"/>元佣金，上上家送<input  class="textWid1"type="text" value="<?=$this->settings['lossCommissionParentAmount2']?>" name="lossCommissionParentAmount2"/>元佣金，如果为0则关闭活动</p>
					</p>
				</td>
			</tr>
			<tr>
				<td>分红发放比例</td>
				<td>
					13.0&nbsp;账户分红比例<input name="bonusScale1" class="textWid1" type="text" value="<?=$this->settings['bonusScale1']?>"/>%&nbsp;
					12.9&nbsp;账户分红比例<input name="bonusScale2" class="textWid1" type="text" value="<?=$this->settings['bonusScale2']?>"/>%
				</td>
			</tr>
			<tr>
				<td>滚动公告</td>
				<td>
					<textarea name="webGG" cols="56" rows="5"><?=$this->settings['webGG']?></textarea>
				</td>
			</tr>
			<tr>
				<td>弹窗标题</td>
				<td>
					<input type="text" class="textWid" value="<?=$this->settings['picGGTitle']?>" name="picGGTitle"/>*&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 360浏览器须在浏览器地址栏尾部切换至IE兼容模式再保存设置方可生效，否则前台无法弹窗
				</td>
			</tr>
			<tr>
				<td>弹窗内容</td>
				<td>
					<textarea id="editor_1" style="height:300px;" name="picGG" cols="30" rows="5"><?=$this->unescape($this->settings['picGG'])?></textarea>
				</td>
			</tr>
			<tr>
				<td>积分比例</td>
				<td>
					<input type="text" class="textWid1" value="<?=$this->settings['scoreProp']?>" name="scoreProp"/> 每消费1元积的分数
				</td>
			</tr>
			<tr>
				<td>积分规则</td>
				<td>
					<textarea name="scoreRule" cols="30" rows="3"><?=$this->settings['scoreRule']?></textarea>
				</td>
			</tr>
            <tr>
				<td>在线客服状态</td>
				<td>
					<label><input type="radio" value="1" name="kefuStatus" <?=$this->iff($this->settings['kefuStatus'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="kefuStatus" <?=$this->iff(!$this->settings['kefuStatus'],'checked="checked"')?>/>关闭</label>

				</td>
			</tr>
			<tr>
				<td>在线客服链接</td>
				<td>
					<textarea name="kefuGG" cols="56" rows="5"><?=$this->settings['kefuGG']?></textarea>
				</td>
			</tr>
			<tr>
				<td>QQ客服状态</td>
				<td>
					<label><input type="radio" value="1" name="qqkefuStatus" <?=$this->iff($this->settings['qqkefuStatus'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="qqkefuStatus" <?=$this->iff(!$this->settings['qqkefuStatus'],'checked="checked"')?>/>关闭</label>
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					须开启临时会话功能
				</td>
			</tr>
			<tr>
				<td>QQ号码</td>
				<td>
					<textarea name="qqkefuGG" cols="56" rows="5"><?=$this->settings['qqkefuGG']?></textarea>
				</td>
			</tr>
		</tbody>
	</table>
	<footer>
		<div class="submit_link">
			<input type="submit" value="保存修改设置" title="保存设置" class="alt_btn">&nbsp;&nbsp;
			<input type="button" onclick="load('system/settings')" value="重置" title="重置原来的设置" >
		</div>
	</footer>
	</form>
</article>