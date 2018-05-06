function check_comment(msg,nm,ID,Mode) {
    var cancle=false;
    if (msg.length==0){
        alert('กรุณาป้อนรายละเอียดก่อน');
        document.frmAns.detail.focus();
        cancle=true;
    } else 
if (nm.length==0){
    alert('กรุณาป้อนชื่อก่อน');
    document.frmAns.txtname.focus();
    cancle=true;
}
if (cancle==false) {
    doAddComment(Mode,ID);
}
return false;
}
function doAddComment(Mode,ID){
    var url='add_comment.php';
    var pmeters="aName=" +encodeURI(document.getElementByld("txtname").value)+"&aMode=" + Mode + 
    "&bID=" + ID;
    xmlhttp = newXmlHttp();
    Xmlhttp.open('POST',url,true);

    xmlhttp.setRequestHeader("Content-type" , "application/x-www-from-urlencoded");
    xmlhttp.setRequestHeader("Content-length",pmeters.length);
    xmlhttp.setRequestHeader("Connection","close");
    xmlhttp.send(pmeters);

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 3) {
            document.getElementById("comment").innerHTML = "Now is Loading...";
        
        }
        if (xmlhttp.readyState ==4) {
            document.getElementById("comment").innerHTML = xmlhttp.responseText;
            document.getElementById("detail").value ='';
        }
    }
}
