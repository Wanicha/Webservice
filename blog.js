function newXmlHttp() {
    var xmlhttp = false;

    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

    } catch(e){
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

        } catch(e){
            xmlhttp = false;
        }
    }

    if(!xmlhttp && document.createElement) {
        xmlhttp = new XMLHttpRequest();

    }
     return xmlhttp;
}

function check_data(title, desc,Mode) {
    var cancle = false;
    if (title.length==0) {
        alert('กรุณาป้อนหัวข้อก่อน');
        document.frmEntry.title.focus();
        cancle=true;

    } else

    if (desc.length==0) {
        alert('กรุณาป้อนรายละเอียดก่อน');
        document.frmEntry.detail.focus();
        cancle=true;

    }
    if (cancle==false) {
        doAddEntry(Mode);

    }
    return false;
}

function doAddEntry(Mode) {
    var url = 'add_entry.php';
    var pmeters = "bDetail=" + encodeURI(document.getElementById("detail").value) +
    "&bTitle=" + encodeURI(document.getElementById("title").value) +

    "&bMode=" + Mode;
    xmlhttp = newXmlHttp();
    xmlhttp.open('POST',url.true);

    xmlhttp.setRequestHeader("Content-type","application/x-www-from-urlencoded");
    xmlhttp.setRequestHeader("Content-length",pmeters.length);
    xmlhttp.setRequestHeader("Contention","close");
    xmlhttp.send(pmeters);

    xmlhttp.onreadystatechange = function() {

        if (xmlhttp.readyState==3) {
            document.getElementById("blogdetail").innerHTML= "Now is Loadind....";

        }
        
        if (xmlhttp.readyState==4) {
            document.getElementById("blogdetail").innerHTML= xmlhttp.responseText;
            document.getElementById("title").value = '';
            document.getElementById("detail").value = '';
            
            function doListOwner(ID) {
                
                    var url = 'list_blog.php';
                    var pmeters = "bID=" + ID;
                    xmlhttp = newXmlHttp();
                    xmlhttp.open('POST',url.true);
                    
                        xmlhttp.setRequestHeader("Content-type","application/x-www-from-urlencoded");
                        xmlhttp.setRequestHeader("Content-length",pmeters.length);
                        xmlhttp.setRequestHeader("Contention","close");
                        xmlhttp.send(pmeters);
                    
                        xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 3 ) {
                    document.getElementById("blogdetail").innerHTML = "Now is Loadind ";
                
                }
                if (xmlhttp.readyState==4) {
                    document.getElementById("blogdetail").innerHTML = xmlhttp.responseText;
                }
                        }
                    }
        }
    }
}