<?php
function rudeword($input) {
	$words array("xxx","yyy","zzz"); //ใส่คำหยาบ

	$replace = "<font color=red>***</font>";
	for ($i=0; $i<count($word); $i++) {
		$input = str_replace(trim($words[$i]), $replace, $input);
	}
	return $input;
}
?>