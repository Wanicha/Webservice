<?php
include "include/connectionDb.php";

$bid = $_POST['bID'];
$cid = $_POST['cID'];
$mode = $_POST['aMode'];

if($mode=="DELETE") {  

	$result = mysql_query("SELECT * FROM tbl_blog WHERE blog_id='$bid'"); 
	$row = mysql_fetch_array($result);
	
	if ($row['user_id']==$_SESSION['userid']) {
		$sql = "DELETE FROM tbl_comment where comment_id='$cid'";
		$result=@mysql_query($sql) or die(mysql_error());
	}

}

	$result = mysql_query("SELECT COUNT(*) AS numans  FROM tbl_comment WHERE ref_blog_id='$bid' ORDER BY comment_id DESC"); 
	$row = mysql_fetch_array($result);
	$numans = $row['numans'];
?>        
		<div style="padding-bottom:10px;" >
        <span style="font-size:15px;color:#666;" ><b>ร่วมแสดงความคิดเห็น (<?=$numans;?>)</b></span> 
        </div> 

<?

	$result = mysql_query("SELECT * FROM tbl_comment WHERE ref_blog_id='$bid' ORDER BY comment_id DESC"); 
	while ($row = mysql_fetch_array($result)) {
		$cid=$row['comment_id'];
		$name=$row['name'];
		$detail=$row['detail'];
		$date_post=$row['date_post'];
		$time_post=$row['time_post'];
?>

        <div class="content">
        <table width="90%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td rowspan="2"><span class="answer"><b><?=$name;?></b></span> <font style="color:#666">แสดงความคิดเห็นเมื่อ : <span class="date"><?=$date_post;?> - <?=$time_post;?></span><br /><br /><?=$detail;?></font></td>
          </tr>
<?
	$result = mysql_query("SELECT * FROM tbl_blog WHERE blog_id='$strID'"); 
	$row = mysql_fetch_array($result);
	
	if ($row['user_id']==$_SESSION['userid']) {
?>		          
          <tr>
          	<td align="right"><img src="image/icon_wrong.gif" border="0" width="20" height="20" onClick="doDelete('DELETE', '<?=$strID;?>', '<?=$cid;?>')"/></td>                    
          </tr>
<? } ?>          
        </table>
        </div>   
        <div style="padding-bottom:10px;" ></div>     
<?
}

mysql_close($objConnect);
?>