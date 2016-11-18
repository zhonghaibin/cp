<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
	<div class="dGameStatus hklhc" action="tzlhcSelect" length="1">
    <span class="sTitle">连尾<span class="sNote"><!--(&nbsp;备注：所勾选之尾碰组合以各组合内最高尾数赔率为该注赔率。&nbsp;)--></span></span>
    <table>
            <tbody><tr>
                <td class="boldborder"><label><input type="radio" value="SNSD2" name="txtGameItem" rel="2" pri="<?=$this->getLHCRte('RteSNSD2',$this->played)?>" class="inputnoborder">二尾碰</label></td>
                <td class="boldborder"><label><input type="radio" value="SNSD3" name="txtGameItem" rel="3" pri="<?=$this->getLHCRte('RteSNSD3',$this->played)?>" class="inputnoborder">三尾碰</label></td>
                <td class="boldborder"><label><input type="radio" value="SNSD4" name="txtGameItem" rel="4" pri="<?=$this->getLHCRte('RteSNSD4',$this->played)?>" class="inputnoborder">四尾碰</label></td>
                <td class="boldborder"><label><input type="radio" value="SNSD5" name="txtGameItem" rel="5" pri="<?=$this->getLHCRte('RteSNSD5',$this->played)?>" class="inputnoborder">五尾碰</label></td>
            </tr>
			 <tr>
                <td class="boldborder"><span class="sRte" id="RteSNSD2" style="color: BLUE;"><?=$this->getLHCRte('RteSNSD2',$this->played)?></span></td>
                <td class="boldborder"><span class="sRte" id="RteSNSD3" style="color: BLUE;"><?=$this->getLHCRte('RteSNSD3',$this->played)?></span></td>
                </td>
                <td class="boldborder"><span class="sRte" id="RteSNSD4" style="color: BLUE;"><?=$this->getLHCRte('RteSNSD4',$this->played)?></span></td>
                <td><span class="sRte" id="RteSNSD5" style="color: BLUE;"><?=$this->getLHCRte('RteSNSD5',$this->played)?></span></td>
            </tr>
        </tbody></table>
        <table>
            <tbody><tr>
    
                <td width="60"><span class="sGameStatusItem">0尾</span></td>
                <td width="150">
    
                    <span class="sNumL">10</span>
    
                    <span class="sNumL">20</span>
    
                    <span class="sNumL">30</span>
    
                    <span class="sNumL">40</span>
    
                </td>
                <td class="boldborder"><input type="checkbox" value="0" id="SD0" name="txtSD"  acno="0尾" class="inputnoborder"><span class="sRte" id="RteSD0" style="color: BLUE;display:NONE;">0.0</span></td>
        
                <td width="60"><span class="sGameStatusItem">5尾</span></td>
                <td width="150">
    
                    <span class="sNumL">05</span>
    
                    <span class="sNumL">15</span>
    
                    <span class="sNumL">25</span>
    
                    <span class="sNumL">35</span>
    
                    <span class="sNumL">45</span>
    
                </td>
                <td class=""><input type="checkbox" value="5" id="SD5" name="txtSD" acno="5尾" class="inputnoborder"><span class="sRte" id="RteSD5" style="color: BLUE; display:NONE;">0.0</span></td>
        </tr><tr>

                <td width="60"><span class="sGameStatusItem">1尾</span></td>
                <td width="150">
    
                    <span class="sNumL">01</span>
    
                    <span class="sNumL">11</span>
    
                    <span class="sNumL">21</span>
    
                    <span class="sNumL">31</span>
    
                    <span class="sNumL">41</span>
    
                </td>
                <td class="boldborder"><input type="checkbox" value="1" id="SD1" name="txtSD" acno="1尾" class="inputnoborder"><span class="sRte" id="RteSD1" style="color: BLUE;display:NONE;">0.0</span></td>
        
                <td width="60"><span class="sGameStatusItem">6尾</span></td>
                <td width="150">
    
                    <span class="sNumL">06</span>
    
                    <span class="sNumL">16</span>
    
                    <span class="sNumL">26</span>
    
                    <span class="sNumL">36</span>
    
                    <span class="sNumL">46</span>
    
                </td>
                <td class=""><input type="checkbox" value="6" id="SD6" name="txtSD" acno="6尾" class="inputnoborder"><span class="sRte" id="RteSD6" style="color: BLUE;display:NONE;">0.0</span></td>
        </tr><tr>

                <td width="60"><span class="sGameStatusItem">2尾</span></td>
                <td width="150">
    
                    <span class="sNumL">02</span>
    
                    <span class="sNumL">12</span>
    
                    <span class="sNumL">22</span>
    
                    <span class="sNumL">32</span>
    
                    <span class="sNumL">42</span>
    
                </td>
                <td class="boldborder"><input type="checkbox" value="2" id="SD2" name="txtSD" acno="2尾" class="inputnoborder"><span class="sRte" id="RteSD2" style="color: BLUE;display:NONE;">0.0</span></td>
        
                <td width="60"><span class="sGameStatusItem">7尾</span></td>
                <td width="150">
    
                    <span class="sNumL">07</span>
    
                    <span class="sNumL">17</span>
    
                    <span class="sNumL">27</span>
    
                    <span class="sNumL">37</span>
    
                    <span class="sNumL">47</span>
    
                </td>
                <td class=""><input type="checkbox" value="7" id="SD7" name="txtSD" acno="7尾" class="inputnoborder"><span class="sRte" id="RteSD7" style="color: BLUE;display:NONE;">0.0</span></td>
        </tr><tr>

                <td width="60"><span class="sGameStatusItem">3尾</span></td>
                <td width="150">
    
                    <span class="sNumL">03</span>
    
                    <span class="sNumL">13</span>
    
                    <span class="sNumL">23</span>
    
                    <span class="sNumL">33</span>
    
                    <span class="sNumL">43</span>
    
                </td>
                <td class="boldborder"><input type="checkbox" value="3" id="SD3" name="txtSD" acno="3尾" class="inputnoborder"><span class="sRte" id="RteSD3" style="color: BLUE;display:NONE;">0.0</span></td>
        
                <td width="60"><span class="sGameStatusItem">8尾</span></td>
                <td width="150">
    
                    <span class="sNumL">08</span>
    
                    <span class="sNumL">18</span>
    
                    <span class="sNumL">28</span>
    
                    <span class="sNumL">38</span>
    
                    <span class="sNumL">48</span>
    
                </td>
                <td class=""><input type="checkbox" value="8" id="SD8" name="txtSD" acno="8尾" class="inputnoborder"><span class="sRte" id="RteSD8" style="color: BLUE;display:NONE;">0.0</span></td>
        </tr><tr>

                <td width="60"><span class="sGameStatusItem">4尾</span></td>
                <td width="150">
    
                    <span class="sNumL">04</span>
    
                    <span class="sNumL">14</span>
    
                    <span class="sNumL">24</span>
    
                    <span class="sNumL">34</span>
    
                    <span class="sNumL">44</span>
    
                </td>
                <td class="boldborder"><input type="checkbox" value="4" id="SD4" name="txtSD" acno="4尾" class="inputnoborder"><span class="sRte" id="RteSD4" style="color: BLUE;display:NONE;">0.0</span></td>
        
                <td width="60"><span class="sGameStatusItem">9尾</span></td>
                <td width="150">
    
                    <span class="sNumL">09</span>
    
                    <span class="sNumL">19</span>
    
                    <span class="sNumL">29</span>
    
                    <span class="sNumL">39</span>
    
                    <span class="sNumL">49</span>
    
                </td>
                <td class=""><input type="checkbox" value="9" id="SD9" name="txtSD" acno="9尾" class="inputnoborder"><span class="sRte" id="RteSD9" style="color: BLUE;display:NONE;">0.0</span></td>
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
