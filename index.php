<?php
include "include/connectDb.php";
session_start();
?>

<html lang="en">
<head>
  <title>Tree Blog</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 750px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>

  <script type="text/javascript" src="ajax/ajaxlogin.js"></script>
  <script type="text/javascript" src="ajax/blog.js"></script>
  <script language="JavaScript" type="text/javascript">
  function confirmLogout(){
      if(!confrim('<?=$_SESSION[user];?>ต้องการออกจากระบบ?')){
        return;
      }
      doLogout('LOGOUT');
  }
  </script>

</head>
<body>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><img src="logo.png"class="img-responsive img-circle margin" width="50" height="120"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">TREEBLOG</a></li>
        <li class="active"><a href="#">ABOUT</a></li>
        <form class="navbar-form navbar-left" method="POST" action="">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" name="kw">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
    
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span>Sing up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
      </ul>

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '129310947927255',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>

    </div>
  </div>
</nav>


  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <strong>BLOG USER</strong><br/>
      <?
        $sql = "Select * from tbl_user ORDER BY blog_name ASC";
        $sql = mysql_query($sql);
        if(mysql_num_rows($result)==0){
            echo "ยังไม่มีสมาชิก";
        } else {
                  while ($data = mysql_fetch_array($result)) {
                          echo "&raquo; <a href=\"JavaScript:doListOwner('$data[user_id]');
                          \">$data[blog_name]</a><br>";
                  }
        }
  ?>

    </div>

    <td width="80%" valign="top">
      <? if(isset($_SESSION['user'])) { ?>
      <div class="content">
      <strong><p align="left">สร้างหัวข้อใหม่</p></strong><br />
      <from name="frmEntry" id="frmEntry">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="20%">หัวข้อ :</td>
          <td width="80%"><input type="text" size="55" name="title" id="title"></td>
      </tr>
    <tr>
      <td valign="TOP">รายละเอียด :</td>
      <td><textarea name="detail" cols="45" rows="5" id="detail"></textarea></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="button" name="submit"> value="ตกลง" onClick="return check_data
        (frmEntry.title.value, frmEntry.detail.value, 'ADD')"></td>
      </tr>
      </table>
      </from>
      </div>
    <? } ?>
    <br><br>

    <div id="blogdetail"> 
      <h1>TREEBLOG</h1>
      <?php
      $sql = "SELECT tbl_blog.*, tbl_user.*, DATE_FORMAT(tbl_blog.date_post, '%d-%m-%Y%H:%i:%s')AS datepost FROM tbl_blog,tbl_user WHERE tbl_blog.user_id=tbl_user.user_id";
      if ($_SESSION['user'])  {
        $sql .= "AND tbl_user.login = '$_SESSION[user]'";
      }
      $sql .= "ORDER BY tbl_blog.blog_id DESC;";
      $result = mysql_query($sql);

      if (mysql_num_row($result)==0) {
        echo "ยังไม่มีหัวข้อใหม่";
      } else{
        While ($data = mysql_fatch_array($result)){
          $user = $data['login'];
          $blogname = $data['blog_name'];
          $blogid = $data['blog_id'];
          $title = $data['title'];
          $detail = $data['detail'];
          $userid = $data['user_id'];
          $date = $data['datepost'];

          $resultAns = mysql("SELECT COUNT(*) AS numans FROM tbl_comment 
          WHERE ref_blog_id='$blogid'");
          $row = mysql_fetch_array($resultAns);
          $nuumans = $row['numans'];

          echo "<a href=blog.php?bid=$blogid&userid=$userid target=_blank>$title</a><br>
          ".substr_replace($detail), "..." , 100 . "<div style=\"fontsize: 8pt; color: gray;\">
          โดย: <b>$user</b> - ($numans ความคิดเห็น) - [$date]</div><br />";
        }
      }
      ?>
    </div>
  
  
</body>
</html>
