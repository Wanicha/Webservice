<?php
include "include/connectionDB.php";

$strlD = $_POST["bID"];

$sql = "SELECT tbl_blog.*. tbl_user.*.  DATE_FORMAT(tbl_blog.data_post,
'%d-%m-%Y %H:%i:%s ' AS datapost FROM tbl_blog, tbl_user WHERE tbl_blog,
user_id = tbl_user.user_id";

if($strID) {
    $sql .= "AND tbl_blog.user_id ='$strID'";
}
$sql .= "ORDER BY tbl_blog.blog_id DESC;";
$resule = mysql_query($sql);

if (mysql_num_rows($result)== 0){
     echo " ไม่พบหน้านี้";

} else {
    echo "<strong><p align=\"center\">หัวข้อบล็อกของ<font color =#red>$row[blog_name]
    </font></p></strong><br />";
    
    while ($data = mysql_fetch_array($result)){
        $blogname = $data['blog_name'];
        $blogid =  $data['blog_id'];
        $title =  $data['tittle'];
        $detail =  $data['detail'];
        $userid =  $data['user_id'];
        $data =  $data['datapost'];
        $resultAns = mysql_query("SELECT COUNT(*) AS numans FROM tbl_comment

WHERE ref_blog_id = '$blogid'");
$row = mysql_fetch_array($resultAns);
$numans = $row['numans'];

echo "<a href=blog.php?bid=$blogid&$userid target=_blank>$title</a>
<br>" . substr_replace($detail, "....", 100) ."<div style=\"font-size: 8pt; color:gray;\">โดย:
<b>$user</b> - ($numans ความคิดเห็น ) - [$data]</div><br />";

}
}

mysql_close($objConnect);
?>
    
