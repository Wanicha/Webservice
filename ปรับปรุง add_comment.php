<?php
session_start();
include "include/connectionDb.php";
include "include/function.php";

$strMode = $_POST["aMode"];
$detail= $_REQUEST['aDetail'];
$name = $_REQUEST['aName'];
$strID = $_REQUEST["bID"];

if($strMode == "ADD")
{
	$sql = "INSERT INTO tbl_comment VALUES (0, '$name', '$detail', NOW(), '$strID')";	
	@mysql_query($sql) or die(mysql_error());
}

	$result = mysql_query("SELECT COUNT(*) AS numans  FROM tbl_comment WHERE ref_blog_id='$strID' ORDER BY comment_id DESC"); 
	$row = mysql_fetch_array($result);
	$numans = $row['numans'];
?>        
		<div style="padding-bottom:10px;" >
        <span style="font-size:15px;color:#666;" ><b>ร่วมแสดงความคิดเห็น (<?=$numans;?>)</b></span> 
        </div> 

<?

	$result = mysql_query("SELECT *, DATE_FORMAT(date_post, '%d-%m-%Y  %H:%i:%s') AS datepost FROM tbl_comment WHERE ref_blog_id='$strID' ORDER BY comment_id DESC"); 
	while ($row = mysql_fetch_array($result)) {
		$cid=$row['comment_id'];
		$name=$row['name'];
		$detail = nl2br(htmlspecialchars($row['detail']));
		$date_post=$row['datepost'];
?>

        <div class="content">
        <table width="90%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td rowspan="2"><span class="answer"><b><?=$name;?></b></span> <font style="color:#666">แสดงความคิดเห็น : <span class="date"><?=$date_post;?></span><br /><br /><?=$detail;?></font></td>
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