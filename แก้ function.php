<?php
function rudeword($input){
	$words = array("xxx", "yyyy", "zzzz"); //ใส่คำหยาบที่นี่

	$replace = "<font color=red>***</font>";
	for($i=0; $i<count($words);$i++) {
		$input=str_replace(trim($words[$i]), $replace,$input);
	}
		return $input;	
}
?>