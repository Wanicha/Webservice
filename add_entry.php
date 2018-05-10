<?php
session_start();
include "include/connectionDb.php";
include "include/function.php";

$strMode = $_POST["bMode"];
$detail= rudeword($_POST['bDetail']);
$title = $_POST['bTitle'];

if($strMode == "ADD")
{
	$sql = "INSERT INTO tbl_blog VALUES	(0, '$title', '$detail', NOW(), '$_SESSION[userid]')";					
	@mysql_query($sql) or die(mysql_error());
}

$sql = "SELECT tbl_blog.*, tbl_user.*, DATE_FORMAT(tbl_blog.date_post, '%d-%m-%Y %H:%i:%s') AS datepost FROM tbl_blog, tbl_user WHERE tbl_blog.user_id=tbl_user.user_id";

if($_SESSION['user']) {
	$sql .= " AND tbl_user.login = '$_SESSION[user]'";
}
$sql .= " ORDER BY tbl_blog.blog_id DESC;";

$result = mysql_query($sql);

if(mysql_num_rows($result)== 0) {
	echo "ไม่พบบล็อกในหมวดนี้";
}
else {
	while($data = mysql_fetch_array($result)) {
		$user = $data['login'];
		$blogname = $data['blog_name'];
		$blogid = $data['blog_id'];
		$title = $data['title'];
		$detail = $data['detail'];
		$userid = $data['user_id'];
		$date = $data['datepost'];
		
		$resultAns = mysql_query("SELECT COUNT(*) AS numans  FROM tbl_comment WHERE ref_blog_id='$blogid'"); 
		$row = mysql_fetch_array($resultAns);
		$numans = $row['numans'];
			
		echo "<a href=blog.php?bid=$blogid&userid=$userid target=_blank>$title</a><br>" . substr_replace($detail, "...", 100) . "<div style=\"font-size: 8pt; color: gray;\">โดย: <b>$user</b>  - ($numans ความคิดเห็น) - [$date]</div><br />";
	}
}

mysql_close($objConnect);
?>