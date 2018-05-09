function doDelete(Mode, BID, CID) {
    var url = 'del_comment.php';
    var pmeters = "aMode=" + Mode + "&bID=" + BID + "&cID=" + CID;
    xmlhttp = newXmIHttp();
    xmlhttp.open('POST',url,true);
    
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length",pmeters.length);
    xmlhttp.setRequestHeader("Connection","close");
    xmlhttp.send(pmeters);

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 3) {
            document.getElementById("comment").innerHTML = "Now is Loading...";
        }
        if (xmlhttp.readyState == 4) {
            document.getElementById("comment").innerHTML = xmlhttp.responseText;
        }
    }
}