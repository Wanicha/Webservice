<?php
@mysql_connect("localhost", "root", "kuroshitsuji") or die(mysql_error());
mysql_query("CREATE DATABASE myblog;");
mysql_select_db("myblog");

$sql = "CREATE TABLE tbl_user(
	user_id SMALLINT AUTO_INCREMENT PRIMARY KEY,
	login VARCHAR(20),
	password VARCHAR(20),				
	blog_name VARCHAR(200));";				

$result=mysql_query($sql);
if(!$result) {
	echo "การสร้างตาราง tbl_user ผิดพลาด<br>";
} else {
	echo "การสร้างตาราง tbl_user เสร็จเรียบร้อย<br>";
}

$sql = "CREATE TABLE tbl_blog(
	blog_id  SMALLINT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(200),
	detail TEXT,
	date_post DATETIME,													
	ref_user_id SMALLINT)";

$result=mysql_query($sql);
if(!$result) {
	echo "การสร้างตาราง tbl_blog ผิดพลาด<br>";
} else {
	echo "การสร้างตาราง tbl_blog เสร็จเรียบร้อย<br>";
}

$sql = "CREATE TABLE tbl_comment(
	comment_id  SMALLINT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(80),
	detail TEXT,
	date_post DATETIME,				
	ref_blog_id  SMALLINT)";

$result=mysql_query($sql);
if(!$result) {
	echo "การสร้างตาราง tbl_comment ผิดพลาด<br>";
} else {
	echo "การสร้างตาราง tbl_comment เสร็จเรียบร้อย<br>";
}
?>