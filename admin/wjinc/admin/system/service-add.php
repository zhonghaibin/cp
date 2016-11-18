<article class="module width_full" id="addservice" style="width:300px;">
<input type="hidden" value="<?=$this->user['username']?>" />
<header><h3 class="tabs_involved">添加客服</h3></header>
<form name="add_Service" method="post" onkeydown="">
<div class="tab_content">
    <table class="tablesorter" cellspacing="0" width="100%">
    <tbody>
        <tr> 
            <td>客服名称</td> 
            <td><input type="text" name="serviceName" value=""/></td>
        </tr>
    </tbody> 
    </table>
</div><!-- end of .tab_container -->
<footer>
    <div class="submit_link">
        <a onclick="this.href='/admin778899.php/System/serviceAddNew/'+$(':input[name=\'serviceName\']').val()"  href="#" target="ajax" call= "serviceAddNew" dataType="html"><input type="submit" value="添加" class="alt_btn"/></a>
    </div>
</footer>
</form>
</article><!-- end of content manager article -->
