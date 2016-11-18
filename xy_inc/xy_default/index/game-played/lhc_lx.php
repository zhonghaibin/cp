<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<script>
function checkANM(idStr){
	if(idStr){
		$("input[name='txtBP']").attr("checked",false);
		switch(idStr){
			case "O":
				var len=$("input[name='txtBP']").length;
				for(var i=0; i<len; i++){
					if($("input[name='txtBP']:eq("+i+")").attr("oe")==idStr){
						$("input[name='txtBP']:eq("+i+")").attr("checked",true);
					}
				}
			break;	
			
			case "E":
				var len=$("input[name='txtBP']").length;
				for(var i=0; i<len; i++){
					if($("input[name='txtBP']:eq("+i+")").attr("oe")==idStr){
						$("input[name='txtBP']:eq("+i+")").attr("checked",true);
					}
				}
			break;	

			
			default:
				var sid=idStr.split(",");
				for(var i=0; i<sid.length; i++){
					$("#ANM"+sid[i]).attr("checked",true);
				}
			break;
			
		}
		
	}
	lhcGameMsgAutoTip();
}
</script>
	<div class="dGameStatus hklhc" action="tzlhcSelect" length="1">
        <span class="sTitle">连肖<span class="sNote"><!--(&nbsp;备注：所勾选之肖碰组合以各组合内最低生肖赔率为该注赔率。&nbsp;)--></span></span>
        <table class="sQuickmenu">
            <tbody><tr>
              <td>
                  快速下注：<a onclick="checkANM('01,02,03,04,05,06'); return false;" href="#">前肖</a>│<a onclick="checkANM('07,08,09,10,11,12'); return false;" href="#">后肖</a>│<a onclick="checkANM('01,03,04,11,06,08'); return false;" href="#">天肖</a>│<a onclick="checkANM('12,02,05,07,10,09'); return false;" href="#">地肖</a>│<a onclick="checkANM('02,12,04,05,03,08'); return false;" href="#">野兽</a>│<a onclick="checkANM('01,06,08,10,11,09'); return false;" href="#">家禽</a>│<a onclick="checkANM('O'); return false;" href="#">单</a>│<a onclick="checkANM('E'); return false;" href="#">双</a>
              </td>
            </tr>
        </tbody></table>
        <table>
            <tbody><tr>
                <td class="boldborder"><label><input type="radio" value="SNBP2" name="txtGameItem" rel="2" pri="<?=$this->getLHCRte('RteSNBP2',$this->played)?>" class="inputnoborder">二肖碰</label></td>
                <td class="boldborder"><label><input type="radio" value="SNBP3" name="txtGameItem" rel="3" pri="<?=$this->getLHCRte('RteSNBP3',$this->played)?>" class="inputnoborder">三肖碰</label></td>
                <td class="boldborder"><label><input type="radio" value="SNBP4" name="txtGameItem" rel="4" pri="<?=$this->getLHCRte('RteSNBP4',$this->played)?>" class="inputnoborder">四肖碰</label></td>
                <td class="boldborder"><label><input type="radio" value="SNBP5" name="txtGameItem" rel="5" pri="<?=$this->getLHCRte('RteSNBP5',$this->played)?>" class="inputnoborder">五肖碰</label></td>
            </tr>
            <tr>
                <td class="boldborder"><span class="sRte" id="RteSNBP2" style="color: BLUE;"><?=$this->getLHCRte('RteSNBP2',$this->played)?></span></td>
                <td class="boldborder"><span class="sRte" id="RteSNBP3" style="color: BLUE;"><?=$this->getLHCRte('RteSNBP3',$this->played)?></span></td>
                </td>
                <td class="boldborder"><span class="sRte" id="RteSNBP4" style="color: BLUE;"><?=$this->getLHCRte('RteSNBP4',$this->played)?></span></td>
                <td><span class="sRte" id="RteSNBP5" style="color: BLUE;"><?=$this->getLHCRte('RteSNBP5',$this->played)?></span></td>
            </tr>    
            
        </tbody></table>
        <table>
            <tbody><tr>
    
            <td width="60">
                <span class="sGameStatusItem">牛</span>
            </td>
            <td width="150">
    
                <span class="sNumL">08</span>
    
                <span class="sNumL">20</span>
    
                <span class="sNumL">32</span>
    
                <span class="sNumL">44</span>
    
            </td>
            <td class="boldborder">
                <input type="checkbox" oe="O" value="01" id="ANM01" name="txtBP" class="inputnoborder" acno="牛"><span class="sRte" id="RteANM1" style="color: BLUE;display:NONE;">0.0</span>
                
            </td>
    
            <td width="60">
                <span class="sGameStatusItem">羊</span>
            </td>
            <td width="150">
    
                <span class="sNumL">02</span>
    
                <span class="sNumL">14</span>
    
                <span class="sNumL">26</span>
    
                <span class="sNumL">38</span>
    
            </td>
            <td class="">
                <input type="checkbox" oe="O" value="07" id="ANM07" name="txtBP" class="inputnoborder" acno="羊"><span class="sRte" id="RteANM7" style="color: BLUE;display:NONE;">0.0</span>
            </td>
    </tr><tr>

            <td width="60">
                <span class="sGameStatusItem">虎</span>
            </td>
            <td width="150">
    
                <span class="sNumL">07</span>
    
                <span class="sNumL">19</span>
    
                <span class="sNumL">31</span>
    
                <span class="sNumL">43</span>
    
            </td>
            <td class="boldborder">
                <input type="checkbox" oe="E" value="02" id="ANM02" name="txtBP" class="inputnoborder" acno="虎"><span class="sRte" id="RteANM2" style="color: BLUE;display:NONE;">0.0</span>
            </td>
    
            <td width="60">
                <span class="sGameStatusItem">猴</span>
            </td>
            <td width="150">

			    <span class="sNumL">01</span>
    
                <span class="sNumL">13</span>
    
                <span class="sNumL">25</span>
    
                <span class="sNumL">37</span>
    
                <span class="sNumL">49</span>
    
            </td>
            <td class="">
                <input type="checkbox" oe="E" value="08" id="ANM08" name="txtBP" class="inputnoborder" acno="猴"><span class="sRte" id="RteANM8" style="color: BLUE;display:NONE;">0.0</span>
            </td>
    </tr><tr>

            <td width="60">
                <span class="sGameStatusItem">兔</span>
            </td>
            <td width="150">
    
                <span class="sNumL">06</span>
    
                <span class="sNumL">18</span>
    
                <span class="sNumL">30</span>
    
                <span class="sNumL">42</span>
    
            </td>
            <td class="boldborder">
                <input type="checkbox" oe="O" value="03" id="ANM03" name="txtBP" class="inputnoborder" acno="兔"><span class="sRte" id="RteANM3" style="color: BLUE;display:NONE;">0.0</span>
            </td>
    
            <td width="60">
                <span class="sGameStatusItem">鸡</span>
            </td>
            <td width="150">
    
                <span class="sNumL">12</span>
    
                <span class="sNumL">24</span>
    
                <span class="sNumL">36</span>
    
                <span class="sNumL">48</span>
    
            </td>
            <td class="">
                <input type="checkbox" oe="O" value="09" id="ANM09" name="txtBP" class="inputnoborder" acno="鸡"><span class="sRte" id="RteANM9" style="color: BLUE;display:NONE;">0.0</span>
            </td>
    </tr><tr>

            <td width="60">
                <span class="sGameStatusItem">龙</span>
            </td>
            <td width="150">
    
                <span class="sNumL">05</span>
    
                <span class="sNumL">17</span>
    
                <span class="sNumL">29</span>
    
                <span class="sNumL">41</span>
    
            </td>
            <td class="boldborder">
                <input type="checkbox" oe="E" value="04" id="ANM04" name="txtBP" class="inputnoborder" acno="龙"><span class="sRte" id="RteANM4" style="color: BLUE;display:NONE;">0.0</span>
            </td>
    
            <td width="60">
                <span class="sGameStatusItem">狗</span>
            </td>
            <td width="150">
    
                <span class="sNumL">11</span>
    
                <span class="sNumL">23</span>
    
                <span class="sNumL">35</span>
    
                <span class="sNumL">47</span>
    
            </td>
            <td class="">
                <input type="checkbox" oe="E" value="10" id="ANM10" name="txtBP" class="inputnoborder" acno="狗"><span class="sRte" id="RteANM10" style="color: BLUE;display:NONE;">0.0</span>
            </td>
    </tr><tr>

            <td width="60">
                <span class="sGameStatusItem">蛇</span>
            </td>
            <td width="150">
    
                <span class="sNumL">04</span>
    
                <span class="sNumL">16</span>
    
                <span class="sNumL">28</span>
    
                <span class="sNumL">40</span>
    
            </td>
            <td class="boldborder">
                <input type="checkbox" oe="O" value="05" id="ANM05" name="txtBP" class="inputnoborder" acno="蛇"><span class="sRte" id="RteANM5" style="color: BLUE;display:NONE;">0.0</span>
            </td>
    
            <td width="60">
                <span class="sGameStatusItem">猪</span>
            </td>
            <td width="150">
    
                <span class="sNumL">10</span>
    
                <span class="sNumL">22</span>
    
                <span class="sNumL">34</span>
    
                <span class="sNumL">46</span>
    
            </td>
            <td class="">
                <input type="checkbox" oe="O" value="11" id="ANM11" name="txtBP" class="inputnoborder" acno="猪"><span class="sRte" id="RteANM11" style="color: BLUE;display:NONE;">0.0</span>
            </td>
    </tr><tr>

            <td width="60">
                <span class="sGameStatusItem">马</span>
            </td>
            <td width="150">
    
                <span class="sNumL">03</span>
    
                <span class="sNumL">15</span>
    
                <span class="sNumL">27</span>
    
                <span class="sNumL">39</span>
    
            </td>
            <td class="boldborder">
                <input type="checkbox" oe="E" value="06" id="ANM06" name="txtBP" class="inputnoborder" acno="马"><span class="sRte" id="RteANM6" style="color: BLUE;display:NONE;">0.0</span>
            </td>
    
            <td width="60">
                <span class="sGameStatusItem">鼠</span>
            </td>
            <td width="150">
    
                <span class="sNumL">09</span>
    
                <span class="sNumL">21</span>
    
                <span class="sNumL">33</span>
    
                <span class="sNumL">45</span>
    
            </td>
            <td class="">
                <input type="checkbox" oe="E" value="12" id="ANM12" name="txtBP" class="inputnoborder" acno="鼠"><span class="sRte" id="RteANM12" style="color: BLUE;display:NONE;">0.0</span>
            </td>
    </tr>
        </tbody></table>
        <div class="space"></div>
    </div>
    <div id="dResult">
        <input type="hidden" id="txtRate" value="0">
        <input type="button" value="重设" onclick="resetTotal();" name="重设">
        <input type="button" value="确定" onclick="checkToSubmit();" name="确定">
        <span id="sTotalCredit" class="sTotal FontBold">0</span>
        <span>总计额度</span>
        <input type="text" name="sTotalBeishu" id="sTotalBeishu" value="1" class="beishu" />
        <span>倍数</span>
    </div>
    <div class="space"></div>
