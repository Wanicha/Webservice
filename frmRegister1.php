<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ajax Member</title>
<link rel="stylesheet" href="include/style.css" type="text/css" />
<style type="text/css">
body {
	background-image: url(image/11.jpg);
	background-color: #666666;
}
body,td,th {
	color: #FFCC00;
}
</style>
</head>

<script type="text/javascript" src="ajax/ajaxmember.js"></script>
 
<body>
<center>
<form name="form1" id="form1">

  <table cellspacing=5 cellpadding=0 width=450 align=center>
    <tr>
      <td align="center" colspan="2"><h1>สมัครสมาชิก</h1></td>
    </tr>  
    <tr>
      <td align="right">ชื่อบล็อก:</td>
      <td><input name="txtTitle" type="text" id="txtTitle" size="25" /></td>
    </tr>        
    <tr>
      <td align="right">Login:</td>
      <td><input name="txtlogin" type="text" id="txtlogin" size="25" /></td>
    </tr>
    <tr>
      <td align="right">Password:</td>
      <td><input name="password" type="password" id="password" size="25" /></td>
    </tr> 
    <tr>
      <td align="right" valign="top">Confirm Password:</td>
      <td><input name="repassword" type="password" id="repassword" size="25" onKeyUp="checkpass(form1.password.value, form1.repassword.value)"/><br><div id="msg"></div></td>
    </tr>                
    <tr>
      <td align="right" valign="top">พิมพ์อักขระสีแดงในภาพ:</td>
      <td><img id="imgCaptcha" src="redcaptcha.php" /><br><input type="text" id="txtCaptcha" name="txtCaptcha" size="3" maxlength="3" disabled> <img src="image/icon_refresh.jpg" width="17" height="18" border="0" onClick="javascript:refreshCap()"><br><div id="msg3"></div></td>
    </tr>  
    <tr>
      <td>&nbsp;</td>
      <td><input type="button" name="btnSubmit" id="btnSubmit" value="สมัครสมาชิก" disabled OnClick="check_data(form1.txtTitle.value, form1.txtlogin.value, form1.password.value, form1.txtCaptcha.value, 'ADD')"><br><br><div id="result"></div></td>
    </tr>
  </table>
</form>
</center>
</body>
</html>
