<?php
include "include/connectionDb.php";
session_start();
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Blog</title>
<link rel="stylesheet" href="include/style.css" type="text/css" />
<style type="text/css">
body {
	background-image: url(image/hd-background-images-beautiful-background-hd-wallpapers-pulse-of-hd-background-images.jpg);
	background-repeat: no-repeat;
	background-color: #FFFFFF;
}
body,td,th {
	color: #6699CC;
}
</style>
</head>

<script type="text/javascript" src="ajax/ajaxlogin.js"></script>
<script type="text/javascript" src="ajax/blog.js"></script>
<script language="JavaScript" type="text/javascript">
function confirmLogout() {
	if(!confirm('คุณ <?=$_SESSION[user];?> ต้องการออกจากระบบ ?')){
		return;
	}
	doLogout('LOGOUT');
}
</script>   

<body img src="1.jpg">


<table width="100%" height="40" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td bgcolor="#000033" align="right">
    <div id="login_table">
<?
  echo "<form name=frmMain id=frmMain>";
  
  if (isset($_SESSION['user']) && (isset($_SESSION['userid']))) {
  echo "ยินดีต้อนรับ คุณ <strong><font color=white>$_SESSION[user]</font></strong> เข้าสู่ระบบ <button onClick=confirmLogout()>ออกจากจากระบบ</button>"; 
} else { 
  echo "Login : <input size=15 type=text name=login id=login maxlength=15> Password : <input size=15 type=password name=password id=password maxlength=15> <input type=submit name=submit value=เข้าสู่ระบบ OnClick=\"return check_login(frmMain.login.value, frmMain.password.value, 'LOGIN')\"/><br><a href=frmRegister.php target=_blank>สมัครสมาชิกใหม่</a>";  	
} 
  echo "</form>";
?>    
	</div>
    </td>
  </tr>
</table>

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>

<table width="100%" border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td width="17%">
                   
    <strong>บล็อกสมาชิก</strong><br />
<?
		$sql="Select  * from tbl_user ORDER BY blog_name ASC";
		$result=mysql_query($sql);
		if(mysql_num_rows($result)== 0) {
			echo "ยังไม่มีบล็อกสมาชิก";
		} else {		
			while ($data=mysql_fetch_array($result)) {
				echo "&raquo; <a href=\"JavaScript:doListOwner('$data[user_id]');\">$data[blog_name]</a><br>";	
			}
		}
?>		    
  
    </td>
      
    <td width="83%" valign="top">

<?   if (isset($_SESSION['user'])) { ?>
<div class="content">
<strong><p align="left">สร้างหัวข้อใหม่</p></strong><br />
<form name="frmEntry" id="frmEntry">
<table width="100%" border="1" cellspacing="2" cellpadding="2">
  <tr>
    <td width="20%">หัวข้อ :</td>
    <td width="80%"><input type="text" size="55" name="title" id="title"></td>
  </tr>
  <tr>
    <td valign="top">รายละเอียด :</td>
    <td><textarea name="detail" cols="45" rows="5" id="detail"></textarea></td>
  </tr> 
  <tr>
    <td></td>  
    <td><input type="button" name="submit" value="ตกลง" onClick="return check_data(frmEntry.title.value, frmEntry.detail.value, 'ADD')"></td>
  </tr>
</table>
</form>
</div>
<? } ?>

<br><br>
<div id="blogdetail">    
<strong>หัวข้อใหม่</p></strong><br />
<?php
$sql = "SELECT tbl_blog.*, tbl_user.*, DATE_FORMAT(tbl_blog.date_post, '%d-%m-%Y %H:%i:%s') AS datepost FROM tbl_blog, tbl_user WHERE tbl_blog.user_id=tbl_user.user_id";

if($_SESSION['user']) {
	$sql .= " AND tbl_user.login = '$_SESSION[user]'";
}
$sql .= " ORDER BY tbl_blog.blog_id DESC;";

$result = mysql_query($sql);

if(mysql_num_rows($result)== 0) {
	echo "ยังไม่มีหัวข้อใหม่";
} else {
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
?>
</div>

    </td>
  </tr>
</table>

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '129310947927255',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>



</body>
</html>
