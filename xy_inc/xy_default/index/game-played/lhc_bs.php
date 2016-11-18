<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
 <div class="dGameStatus hklhc" action="tzlhcSelect" length="1">
    
        <span class="sTitle">特别号色波<span class="sNote"><!--&nbsp;(&nbsp;最低限额：5&nbsp;)(&nbsp;单注限额：30,000&nbsp;)(&nbsp;单号限额：100,000&nbsp;)--></span></span>
        <table>
            <tbody><tr>
    
                <td width="70">
                    <span class="sBallRed">红波</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPRR" style="color: BLUE;"><?=$this->getLHCRte('RteSPRR',$this->played)?></span><input type="text" maxlength="5" id="CdtSPRR" name="SPCLR" acno="红波">
                </td>
    
                <td width="70">
                    <span class="sBallBlue">蓝波</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPBB" style="color: BLUE;"><?=$this->getLHCRte('RteSPBB',$this->played)?></span><input type="text" maxlength="5" id="CdtSPBB" name="SPCLR" acno="蓝波">
                </td>
    
                <td width="70">
                    <span class="sBallGreen">绿波</span>
                </td>
                <td class="">
                    <span class="sRte" id="RteSPGG" style="color: BLUE;"><?=$this->getLHCRte('RteSPGG',$this->played)?></span><input type="text" maxlength="5" id="CdtSPGG" name="SPCLR" acno="绿波">
                </td>
    </tr>

        </tbody></table>
        <div class="space"></div>
    </div>
     
    <div class="dGameStatus hklhc" action="tzlhcSelect" length="1">
    
        <span class="sTitle">特别号半波<span class="sNote"><!--&nbsp;(&nbsp;最低限额：5&nbsp;)(&nbsp;单注限额：30,000&nbsp;)(&nbsp;单号限额：100,000&nbsp;)--></span></span>
        <table>
            <tbody><tr>
    
                <td width="70">
                    <span class="sBallRed">红大</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPHCRD" style="color: BLUE;"><?=$this->getLHCRte('RteSPHCRD',$this->played)?></span><input type="text" maxlength="5" id="CdtSPHCRD" name="SPHC" acno="红大">
                </td>
    
                <td width="70">
                    <span class="sBallBlue">蓝大</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPHCBD" style="color: BLUE;"><?=$this->getLHCRte('RteSPHCBD',$this->played)?></span><input type="text" maxlength="5" id="CdtSPHCBD" name="SPHC" acno="蓝大">
                </td>
    
                <td width="70">
                    <span class="sBallGreen">绿大</span>
                </td>
                <td class="">
                    <span class="sRte" id="RteSPHCGD" style="color: BLUE;"><?=$this->getLHCRte('RteSPHCGD',$this->played)?></span><input type="text" maxlength="5" id="CdtSPHCGD" name="SPHC" acno="绿大">
                </td>
    </tr><tr>

                <td width="70">
                    <span class="sBallRed">红小</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPHCRS" style="color: BLUE;"><?=$this->getLHCRte('RteSPHCRS',$this->played)?></span><input type="text" maxlength="5" id="CdtSPHCRS" name="SPHC" acno="红小">
                </td>
    
                <td width="70">
                    <span class="sBallBlue">蓝小</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPHCBS" style="color: BLUE;"><?=$this->getLHCRte('RteSPHCBS',$this->played)?></span><input type="text" maxlength="5" id="CdtSPHCBS" name="SPHC" acno="蓝小">
                </td>
    
                <td width="70">
                    <span class="sBallGreen">绿小</span>
                </td>
                <td class="">
                    <span class="sRte" id="RteSPHCGS" style="color: BLUE;"><?=$this->getLHCRte('RteSPHCGS',$this->played)?></span><input type="text" maxlength="5" id="CdtSPHCGS" name="SPHC" acno="绿小">
                </td>
    </tr><tr>

                <td width="70">
                    <span class="sBallRed">红单</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPHCRO" style="color: BLUE;"><?=$this->getLHCRte('RteSPHCRO',$this->played)?></span><input type="text" maxlength="5" id="CdtSPHCRO" name="SPHC" acno="红单">
                </td>
    
                <td width="70">
                    <span class="sBallBlue">蓝单</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPHCBO" style="color: BLUE;"><?=$this->getLHCRte('RteSPHCBO',$this->played)?></span><input type="text" maxlength="5" id="CdtSPHCBO" name="SPHC" acno="蓝单">
                </td>
    
                <td width="70">
                    <span class="sBallGreen">绿单</span>
                </td>
                <td class="">
                    <span class="sRte" id="RteSPHCGO" style="color: BLUE;"><?=$this->getLHCRte('RteSPHCGO',$this->played)?></span><input type="text" maxlength="5" id="CdtSPHCGO" name="SPHC" acno="绿单">
                </td>
    </tr><tr>

                <td width="70">
                    <span class="sBallRed">红双</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPHCRE" style="color: BLUE;"><?=$this->getLHCRte('RteSPHCRE',$this->played)?></span><input type="text" maxlength="5" id="CdtSPHCRE" name="SPHC" acno="红双">
                </td>
    
                <td width="70">
                    <span class="sBallBlue">蓝双</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPHCBE" style="color: BLUE;"><?=$this->getLHCRte('RteSPHCBE',$this->played)?></span><input type="text" maxlength="5" id="CdtSPHCBE" name="SPHC" acno="蓝双">
                </td>
    
                <td width="70">
                    <span class="sBallGreen">绿双</span>
                </td>
                <td class="">
                    <span class="sRte" id="RteSPHCGE" style="color: BLUE;"><?=$this->getLHCRte('RteSPHCGE',$this->played)?></span><input type="text" maxlength="5" id="CdtSPHCGE" name="SPHC" acno="绿双">
                </td>
    </tr>

        </tbody></table>
        <div class="space"></div>
    </div>
     
    <div class="dGameStatus hklhc" action="tzlhcSelect" length="1">
    
        <span class="sTitle">特别号半半波<span class="sNote"><!--&nbsp;(&nbsp;最低限额：5&nbsp;)(&nbsp;单注限额：30,000&nbsp;)(&nbsp;单号限额：100,000&nbsp;)--></span></span>
        <table>
            <tbody><tr>
    
                <td width="70">
                    <span class="sBallRed">红大单</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPRDO" style="color: BLUE;"><?=$this->getLHCRte('RteSPRDO',$this->played)?></span><input type="text" maxlength="5" id="CdtSPRDO" name="SPHHC" acno="红大单">
                </td>
    
                <td width="70">
                    <span class="sBallBlue">蓝大单</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPBDO" style="color: BLUE;"><?=$this->getLHCRte('RteSPBDO',$this->played)?></span><input type="text" maxlength="5" id="CdtSPBDO" name="SPHHC" acno="蓝大单">
                </td>
    
                <td width="70">
                    <span class="sBallGreen">绿大单</span>
                </td>
                <td class="">
                    <span class="sRte" id="RteSPGDO" style="color: BLUE;"><?=$this->getLHCRte('RteSPGDO',$this->played)?></span><input type="text" maxlength="5" id="CdtSPGDO" name="SPHHC" acno="绿大单">
                </td>
    </tr><tr>

                <td width="70">
                    <span class="sBallRed">红大双</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPRDE" style="color: BLUE;"><?=$this->getLHCRte('RteSPRDE',$this->played)?></span><input type="text" maxlength="5" id="CdtSPRDE" name="SPHHC" acno="红大双">
                </td>
    
                <td width="70">
                    <span class="sBallBlue">蓝大双</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPBDE" style="color: BLUE;"><?=$this->getLHCRte('RteSPBDE',$this->played)?></span><input type="text" maxlength="5" id="CdtSPBDE" name="SPHHC" acno="蓝大双">
                </td>
    
                <td width="70">
                    <span class="sBallGreen">绿大双</span>
                </td>
                <td class="">
                    <span class="sRte" id="RteSPGDE" style="color: BLUE;"><?=$this->getLHCRte('RteSPGDE',$this->played)?></span><input type="text" maxlength="5" id="CdtSPGDE" name="SPHHC" acno="绿大双">
                </td>
    </tr><tr>

                <td width="70">
                    <span class="sBallRed">红小单</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPRSO" style="color: BLUE;"><?=$this->getLHCRte('RteSPRSO',$this->played)?></span><input type="text" maxlength="5" id="CdtSPRSO" name="SPHHC" acno="红小单">
                </td>
    
                <td width="70">
                    <span class="sBallBlue">蓝小单</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPBSO" style="color: BLUE;"><?=$this->getLHCRte('RteSPBSO',$this->played)?></span><input type="text" maxlength="5" id="CdtSPBSO" name="SPHHC" acno="蓝小单">
                </td>
    
                <td width="70">
                    <span class="sBallGreen">绿小单</span>
                </td>
                <td class="">
                    <span class="sRte" id="RteSPGSO" style="color: BLUE;"><?=$this->getLHCRte('RteSPGSO',$this->played)?></span><input type="text" maxlength="5" id="CdtSPGSO" name="SPHHC" acno="绿小单">
                </td>
    </tr><tr>

                <td width="70">
                    <span class="sBallRed">红小双</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPRSE" style="color: BLUE;"><?=$this->getLHCRte('RteSPRSE',$this->played)?></span><input type="text" maxlength="5" id="CdtSPRSE" name="SPHHC" acno="红小双">
                </td>
    
                <td width="70">
                    <span class="sBallBlue">蓝小双</span>
                </td>
                <td class="boldborder">
                    <span class="sRte" id="RteSPBSE" style="color: BLUE;"><?=$this->getLHCRte('RteSPBSE',$this->played)?></span><input type="text" maxlength="5" id="CdtSPBSE" name="SPHHC" acno="蓝小双">
                </td>
    
                <td width="70">
                    <span class="sBallGreen">绿小双</span>
                </td>
                <td class="">
                    <span class="sRte" id="RteSPGSE" style="color: BLUE;"><?=$this->getLHCRte('RteSPGSE',$this->played)?></span><input type="text" maxlength="5" id="CdtSPGSE" name="SPHHC" acno="绿小双">
                </td>
    </tr>

        </tbody></table>
        <div class="space"></div>
    </div>
    <div id="dResult">
        <input type="button" value="重设" onclick="resetTotalCredit();" name="重设">
        <input type="button" value="确定" onclick="bringRte();" name="确定">
        <span id="sTotalCredit" class="sTotal FontBold">0</span>
        <span>总计额度</span>
    </div>
    <div class="space"></div>
