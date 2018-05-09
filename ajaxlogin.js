//ฟังชั่นประกอบในไฟล์ ajaxlogin

function doLogout(Mode){
	var url = 'checkuser.php';
	var pmeters = "action=" + Mode;
	xmlhttp = newXmlhttp();
	xmlhttp.open('POST',url,true);
	
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmphttp.setRequestHeader("Content-length", pmeters.length);
	xmlhttp.setRequestHeader("Connetion", "close");
	xmlhttp.send(pmeters);
	
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4){
			document.getElementById("login_table").innerHTML = xmlhttp.responseText;
		}
	}
}