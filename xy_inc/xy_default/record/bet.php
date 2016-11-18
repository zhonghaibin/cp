<?php 
		$this->getSystemSettings();
		if($this->settings['tzjl']){?>
		<div class="touzhu-true">
			<table width="100%">
				<thead>
					<tr>
					    <td>单号</td><td>投注时间</td><td>彩种</td><td>玩法</td><td>期号</td><td>投注号码</td><td>倍数</td><td>模式</td><td>金额(元)</td><td>奖金(元)</td>
						<td>操作</td>
					</tr>
				</thead>
				<tbody id="order-history"><?php $this->display('index/inc_game_order_history.php'); ?></tbody>
				<?}?>
			</table>
		</div>