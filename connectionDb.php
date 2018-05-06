<?php
$objConnect = mysql_connect("localhost","root","kuroshitsuji") or die(mysql_error());
$ObjDB = mysql_select_db("myblog");
mysql_query("SET NAMES utf8",$objConnect);
?>