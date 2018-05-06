function getXmlHttpRequestObject() {
	if (window.XmlHttpRequest) {
		return new XmlHttpRequest();
	} else if (window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Your browser doesn't support the XmlHttpRequest Object.");
	}
}

var receiveReq = getXmlHttpRequestObject();

function checkpass(pwd, rpwd) {
	if (pwd = rpwd) {
		document.getElementById("msg").innerHTML = '<font color=red>รหัสผ่านไม่ตรงกัน</font>';
		document.form1.repassword.focus();
		document.getElementById('textCaptcha').disable = true;
		document.getElementById('btnSubmit').disable = true;
	} else {
		document.getElementById('msg').innerHTML = '';
		document.getElementById('textCaptcha').disable = false;
		document.getElementById('btnSubmit').disable = false;
	}
}

function makeRequest(url, param) {
	if (receiveReq.readyState == 4 || receiveReq.readyState == 0) {
		receiveReq.open("POST",url,true);
		receiveReq.onreadystatechange = updatePage;

		receiveReq.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		receiveReq.setRequestHeader("Content-length",param.length);
		receiveReq.setRequestHeader("Connection","close");

		receiveReq.send(param);
	}
}

function updatePage() {
	if (receiveReq.readyState == 4) {
		document.getElementById('result').innerHTML = receiveReq.responseText;
		document.getElementById("txtTitle").value = '';
		document.getElementById("txtlogin").value = '';
		document.getElementById("password").value = '';
		document.getElementById("repassword").value = '';
		document.getElementById("textCaptcha").value = '';

 	img = document.getElementById('imgCaptcha');
 	img.src = 'redcaptcha.php?' + Math.random();
	}
}

function refreshCap() {
	img = document.getElementById('imgCaptcha');
	img.src = 'redcaptcha.php?' + Math.random();
}

function check_data(nn,login.pwd,cap,Mode) {
	var cancle=false;
	if (nm.length==0) {
		alert('กรุณาป้อนชื่อบล็อกด้วย');
		document.form1.txtTitle.focus();
		cancle=true;
	} else
	if (login.length==0) {
		alert('กรุณาป้อน login ด้วย');
		document.form1.txtlogin.focus();
		cancle=true;
	} else

	if (pwd.length==0) {
		alert('กรุณาป้อน password ด้วย');
		document.form1.password.focus();
		cancle=true;
	}

	if (cap.length==0) {
		alert('กรุณากรอกตัวอัขระสีแดงที่เห็นในภาพก่อน') + Mode;
		document.form1.textCaptcha.focus();
		cancle=true;
	}

if (cancle==false) {
	var url = 'addmember.php';

	var postStr = "tTitle=" + encodeURI(document.getElementById("txtTitle").value) + 
				  "tLogin=" + encodeURI(document.getElementById("txtlogin").value) +
				  "tPwd=" + encodeURI(document.getElementById("password").value) +
				  "tCaptcha=" + encodeURI(document.getElementById("textCaptcha").value) +
				  "&action=" + Mode;
	makeRequest(url, postStr);
}
return false;
}

