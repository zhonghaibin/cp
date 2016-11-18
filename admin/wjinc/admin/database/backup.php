<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<form name="database_install" action="/admin778899.php/database/dataBackup" method="post" target="ajax" call="dataBackup" onajax="dataBackupBefor">
    <header>
		<h3 class="tabs_involved">数据库备份
			<div class="submit_link wz">
            <input type="submit" value="开始备份数据库" title="数据库备份" class="alt_btn">
			</div>
		</h3>
	</header>
	<table class="tablesorter" cellspacing="0" width="100%">
		<thead>
			<tr>
            	<td>文件名</td>
				<td>备份时间</td>
                <td>文件大小</td>
				<td>管理选项</td>
			</tr>
		</thead>
		<tbody>

           <?php
function MyScandir($FilePath='./',$Order=0){
$FilePath = opendir($FilePath);
while (false !== ($filename = readdir($FilePath))) {
  $FileAndFolderAyy[] = $filename;
}
$Order == 0 ? sort($FileAndFolderAyy) : rsort($FileAndFolderAyy);
return $FileAndFolderAyy;
}
$DataDir = "./databak888/";
if(is_dir($DataDir)){ //文件夹是否存在
$FileArr = MyScandir($DataDir);
foreach ($FileArr as $i => $n){
        if($n != 'PHPMyAdminInitialData.sql' && $i>1){
                $FileTime = date('Y-m-d H:i:s',filemtime($DataDir.$n));
                $FileSize = filesize($DataDir.$n)/1024;

                if ($FileSize < 1024){
                        $FileSize = number_format($FileSize,2) . ' KB';
                } else {
                        $FileSize = '<font color="#FF0000">' . number_format($FileSize/1024,2) . '</font> MB';
                }
				$sAS .= "<a href=\"/admin778899.php/database/dataBackup\" target=\"ajax\" method=\"post\" onajax=\"sysBeforeActionBackup\"  call=\"sysReloadBackup\" action=\"Dow\" file=\"$n\" title=\"确定下载当前备份吗？\">下载</a> | \n";
				//$sAS .= "<a href=\"/admin778899.php/database/dataBackup\" target=\"ajax\" method=\"post\" onajax=\"sysBeforeActionBackup\"  call=\"sysReloadBackup\" action=\"RL\" file=\"$n\" title=\"确定将数据库还原到当前备份吗？\">还原</a> | \n";
				$sAS .= "<a href=\"/admin778899.php/database/dataBackup\" target=\"ajax\" method=\"post\" onajax=\"sysBeforeActionBackup\" call=\"sysReloadBackup\" action=\"Del\" file=\"$n\" title=\"确定删除当前备份吗？\">删除</a>\n";

                echo "<tr>
                <td>$n</td>
                <td>$FileTime</td>
                <td>$FileSize</td>
                <td>$sAS</td>
                </tr>";
                unset($FileTime,$FileSize,$sAS);
        }
    }
}

?>
		</tbody>
	</table>
    <div class="tips" style="padding:10px; line-height:22px;">
    <b>备注说明：</b><br />
     1、本操作只对数据库中当前网站数据(表前缀为 "xy_" 的表)进行备份。如果您的数据库中有多个网站，其它站点不受影响；<br />
     2、备份后的数据可以进行还原操作或通过 phpMyAdmin 导入。<br />
    </div>
	<footer>
		<div class="submit_link">
        	<input type="hidden" name="Action" value="backup" />
			<input type="button" onclick="load('database/backup')" value="刷新备份数据" title="刷新备份数据" >
		</div>
	</footer>
	</form>
</article>
