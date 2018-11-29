<?php require_once('../Connections/myconnect.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['user_name'])) {
  $loginUsername=$_POST['user_name'];
  $password=$_POST['user_pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "for-admin.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_myconnect, $myconnect);
  
  $LoginRS__query=sprintf("SELECT user_name, user_pass FROM admin_system WHERE user_name=%s AND user_pass=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $myconnect) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!doctype html>
<html><head>
<meta charset="utf-8">
<title>:: home admin ::</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body background="../pic/bg.jpg" >

<header class="menu">
<table width="1000" border="0" align="center">
  <tr>
    <td width="300" height="66"><img src="../pic/logo1.png" width="294" height="52"></td>
    <td width="700" align="right"></td>
  </tr>
 </table>
</header>
 <table width="1000" height="70" border="0"></table>
<div class="controller"></div>
<br><br>

<table width="1000" align="center" cellpadding="0"  cellspacing="0">
<tr class="font-rsu">
	<td>
	<div id='cssmenu'>
	<ul class="font-rsu">
   <li><a href='../index.php'>หน้าหลัก</a></li>
   <li><a href='../Check_User.php'>เนื้อหาบทเรียน</a>
   </li>
   <li class='has-sub'><a href='../Check_User.php'>แบบทดสอบ</a></li>
   <li><a href='../about.php'>เกี่ยวกับเรา</a></li>
</ul>
</div>
	</td>
</tr>
</table>
<br>
<table width="1000" border="0"  align="center" cellspacing="25">
	<tr>
		<td class="welcome"><center>
		  ยินดีต้อนรับเข้าสู่หน้า ล็อกอินแอดมิน
		</center></td>
	</tr>
</table>

<table align="center" cellspacing="20"  class="box">
  <tr align="center" valign="top">
    <td class="login-admin"><br><p class="font-loginadmin">Login</p><br><hr>
      <p>&nbsp;</p>
      <form ACTION="<?php echo $loginFormAction; ?>" method="POST" id="form1" style="width:250px">
        <p>
        <input name="user_name" type="text" id="user_name" style="width:250px;height:25px" placeholder="Username">
      </p>
    	<br>
      <p>
        <input type="password" name="user_pass" id="user_pass" style="width:250px;height:25px" placeholder="Password">
      </p>
      <br><br>
      <div align="right"><input name="ok" type="submit" id="ok" value="Login" style="width:100px;height:35px"></div>
  </form></td>
  </tr>
</table>

<br><br><br><br>


<div class="footer">
  <table width="1000" border="0" align="center" cellspacing="20">
<tr valign="top">
  <td width="420"><strong><em>Website</em></strong><br>
    <strong><em>By Phisek Pinpia</em></strong></td>
  <td width="300"><p><strong><em> Contact <br> E-mail : <a href="mailto:boss@gmail.com" class="fontfooter">boss@gmail.com</a> <br> Tel. 089242XXXX</em></strong></p> <div align="right"><a href="https://th-th.facebook.com" target="new"><img src="../pic/facebook.png"></a> <a href="https://twitter.com/?lang=th" target="new"><img src="../pic/twitter.png"></a> <img src="../pic/rss.png"></div></td>
  	</tr>
</table>
</div>


 <div class="footer2">
<table width="1000" border="0" >
<tr>
    <td><center>OBJECT ORIENTATION Copyright &copy; 2015 All Right Reserved. ## Happy New Year 2015 :P ##</center></td>
  </tr>
</table></div>





<p id="back-to-top" style="display: black; opacity;">
<a href="#top">
<span></span>
</a>
</p>
</body>
</html>