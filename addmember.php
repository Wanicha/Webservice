<?php
session_start();
include "include/connectionDB.php";

$strTitle = $_POST["tTitle"];
$strLogin = $_POST['tLogin'];
$strPwd = $_POST['tPwd'];
$strCaptcha = $_POST['tCaptcha'];
$strMode = $_POST["action"];

if ($strMode=="ADD") {
	if ($_SESSION["security_code"] == $strCaptcha) {

		$sql = "INSERT INTO tbl_user VALUES (0, '$strLogin','$strPwd','$strTitle')";
		$result = @mysql_query($sql) or die(mysql_error());

		if ($result) {
			echo "<font color=#009900>บันทึกข้อมูลเรียบร้อยแล้ว</font><br><a href=\"javascript:window.close();\">หน้าต่างนี้</a>";
		} else {
			echo "<font color=#FF0000>ไม่สามารบันทึกข้อมูลได้</font>";
		}

	} else {
		echo "<font color=#FF0000>คุณไม่ผ่านการตรวจสอบ <br>กรุณาลองใหม่อีกครั้ง</font>";
	} 

}
mysql_close($objConnect);
?>