<?php
include "include/connectionDb.php";

$userid=$_GET['userid'];
$bid=$_GET['bid'];

	$result = mysql_query("SELECT *, DATE_FORMAT(date_post, '%d-%m-%Y  %H:%i:%s') AS datepost FROM tbl_blog, tbl_user WHERE tbl_blog.user_id=tbl_user.user_id AND tbl_blog.user_id='$userid' AND tbl_blog.blog_id='$bid' ORDER BY tbl_blog.blog_id DESC"); 
	$row = mysql_fetch_array($result);	

	$blogname = $row['blog_name'];
	$bid = $row['blog_id'];
	$title = $row['title'];
	$detail = nl2br(htmlspecialchars($row['detail']));
	$date_post = $row['datepost'];
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title;?></title>
<link rel="stylesheet" href="include/style.css" type="text/css" />
<style type="text/css">
body {
	background-image: url(image/hd-background-images-beautiful-background-hd-wallpapers-pulse-of-hd-background-images.jpg);
	background-color: #FFFFFF;
}
body,td,th {
	color: #6666FF;
}
</style>
</head>
<script type="text/javascript" src="ajax/blog.js"></script>

<body Onload="doAddComment('', '<?=$bid;?>');" >

<div id="container">
  <div class="content">
    <span class="answer"><h1><?=$title;?></h1></span>
    
    <table width="700" border="0" cellspacing="5" cellpadding="0">
      <tr>
        <td>โดย : <span class="user"><?=$blogname;?></span>  เมื่อ : <span class="date"><?=$date_post;?></span><br>
		<br><?=$detail;?><br /><br />
        </td>
        
        <td width="200" rowspan="2" align="center">
        <div id="blog">
		  <div class="content"><span class="answer">บล็อกของ <?=$blogname;?> ทั้งหมด</span><br>
          
<?php

	$result = mysql_query("SELECT *, DATE_FORMAT(date_post, '%d-%m-%Y  %H:%i:%s') AS datepost FROM tbl_blog WHERE user_id='$userid' ORDER BY blog_id DESC"); 
	while ($row = mysql_fetch_array($result)) {
		echo "<img src=image/arrow.png border=0 width=9 height=9> <a href='blog.php?bid=$row[blog_id]&userid=$row[user_id]'>" .$row['title'] . " <span class=date>$row[datepost]</span><br>";	
	}
?>
          
          </div>
        </div>
        </td>
      </tr>
           
      <tr>
        <td>
		<br />

<div id="comment"></div>   

<div class="content">
<form name="frmAns">
<table width="500" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC">ร่วมแสดงความคิดเห็น</td>
  </tr>
  <tr>
    <td valign="top">รายละเอียด :</td>
    <td><textarea name="detail" cols="45" rows="5" id="detail"></textarea></td>
  </tr>
  <tr>
    <td>ชื่อ :</td>
    <td>
   <? if (isset($_SESSION['user'])) {
	 	echo "<input name=txtname type=text id=txtname value=$_SESSION[user] size=55>";  
   } else {
	   echo "<input name=txtname type=text id=txtname size=55>";
   }
   ?>
	</td>
  </tr>  
  <tr>
    <td></td>  
    <td><input type="button" name="submit" value="ตกลง" onClick="return check_comment(frmAns.detail.value, frmAns.txtname.value, '<?=$bid;?>', 'ADD')"></td>
  </tr>
</table>
</form>
</div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
       
  </div>
</div>

</body>
</html>
