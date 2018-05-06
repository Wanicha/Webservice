<?php

function newXmlHttp() {
var xmlhttp = false;

	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch { 
		try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch {
		xmlhttp = false;	
		}
	}

	if (!xmlhttp && document.createElement) {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function check_login(username,passwd,Mode) {
	var cancle=false;
	if (username.length==0) {
		alert('กรุณาป้อน login ก่อน');
		document.form1.login.focus();
		cancle=true;
	} else if (passwd.length==0) {
		alert('กรุณาป้อน Password ก่อน')ว
		document.form1.Password.focus();
		cancle=true;
	}

	if (cancle==false) {
		doLogin(Mode);
	}
	return false;
}

function doLogin(Mode) {

	var url = 'checkuser.php';
	var pmeters = "tLogin=" + encodeURI(document.getElementByID("login").value) +
				  "&tPassed=" + encodeURI(document.getElementByID("password").value) +
				  "&action=" + Mode;
	xmlhttp = newXmlHttp();
	xmlhttp.open('POST',url,true);

	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length",pmeter.length);
	xmlhttp.setRequestHeader("Connection","close");
	xmlhttp.send(pmeters);

	xmlhttp.onreadstatechang = function() {
		if (xmlhttp.readyState == 3) {
			document.getElementByID("login_table").innerHTML = "Now is Loading...";
		}

		if (xmlhttp.readyState == 4) {
			if (xmlhttp.responseText=="Y") {
				window.location.href="index2.php";
			} else {
				document.getElementByID("login_table").innerHTML = xmlhttp.responseText;
			}
		}
	}
}
?>