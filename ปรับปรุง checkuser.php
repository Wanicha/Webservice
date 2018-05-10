<?php
session_start();

include "include/connectionDb.php";

$strMode = $_POST["action"];
$user=$_POST["tLogin"];
$passwd=$_POST["tPassed"];

if($strMode == "LOGIN") {
	
	$sql = "SELECT * FROM tbl_user WHERE login = '$user' and password = '$passwd' ";
	$result = @mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($result);	

	if (mysql_num_rows($result) != 0) {
    	$_SESSION["user"]=$row['login'];
		$_SESSION["userid"]=$row['user_id'];
		echo "Y";
	} else {
  echo "<form name=frmMain id=frmMain>Login : <input size=15 type=text name=login id=login maxlength=15> Password : <input size=15 type=password name=password id=password maxlength=15> <input type=submit name=submit value=เข้าสู่ระบบ OnClick=\"return check_login(frmMain.login.value, frmMain.password.value, 'LOGIN')\"/></form>ชื่อ หรือ รหัสผ่าน ไม่ถูกต้อง";
		exit();
	}
	
}

if($strMode == "LOGOUT") {
	unset($_SESSION["user"]);
	unset($_SESSION["userid"]);	
	session_destroy();

  echo "<form name=frmMain id=frmMain>Login : <input size=15 type=text name=login id=login maxlength=15> Password : <input size=15 type=password name=password id=password maxlength=15> <input type=submit name=submit value=เข้าสู่ระบบ OnClick=\"return check_login(frmMain.login.value, frmMain.password.value, 'LOGIN')\"/></form><a href=frmRegister.php target=_blank>สมัครสมาชิกใหม่</a>";  

}

mysql_close($objConnect);
?>
