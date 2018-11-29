<?php require_once('Connections/myconnect.php'); ?>
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

if (isset($_POST['user'])) {
  $loginUsername=$_POST['user'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "member/index.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_myconnect, $myconnect);
  
  $LoginRS__query=sprintf("SELECT user_register, pass_register FROM number_register WHERE user_register=%s AND pass_register=%s",
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
<html>
<head>
<meta charset="utf-8">
<title>เกี่ยวกับเรา</title>
<link rel="stylesheet" type="text/css" href="admin/style.css">
</head>

<body background="pic/bg.jpg" >

<header class="menu">
<table width="1000" border="0" align="center">
  <tr>
    <td width="300" height="66"><img src="pic/logo1.png" width="294" height="52"></td>
    <td width="700" align="right"><div class="bx-login"><form ACTION="<?php echo $loginFormAction; ?>" method="POST" id="logina">
      <input type="text" name="user" id="user" placeholder="Username">
  <input name="pass" type="password" placeholder="Password">
  <input type="submit" name="button" id="button" value="Login">
    </form></div></td>
  </tr>
 </table>
</header>


<table width="1000" height="70" border="0"></table>
<div class="pic"></div>
<br><br>
<table width="1000" align="center" cellpadding="0"  cellspacing="0">
<tr class="font-rsu">
	<td>
	<div id='cssmenu'>
	<ul class="font-rsu">
   <li><a href='index.php'>หน้าหลัก</a></li>
   <li><a href='Check_User.php'>เนื้อหาบทเรียน</a></li>
   <li><a href='Check_User.php'>แบบทดสอบ</a></li>
   <li><a href='register.php'>สมัครสมาชิก</a></li>
   <li><a href='about.php'>เกี่ยวกับเรา</a></li>
</ul>
</div>
	</td>
</tr>
</table>


<br><br>

<table width="1000" border="0" class="font-php"><tr><td><div class="welcome">เกี่ยวกับเรา</div><hr size="2" color="#e6e6e6"></td></tr></table><br>


<table width="1000"  align="center" border="0" class="font1">
									<tr>
										<td width="500" valign="top">
																	 จัดทำโดย<br><br>
																	  นายภิเษก  ปิ่นเปีย <br>
																	  ระดับชั้น ปวส.1/1 เลขที่ 6 <br> 
                                                                      แผนกเทคโนโลยีสารสนเทศ<br>
																	  รหัสนักศึกษา 5739010006 <br>
																	  ศึกษาอยู่ที่ วิทยาลัยเทคนิคสระบุรี <br>
																	  <br><br>
										<td align="left"><img src="pic/profile.jpg" usemap="#Map" class="ig"></td>												
										</td>
									</tr>
</table>
<br><br><br><br>
<div class="footer">
  <table width="1000" border="0" align="center" cellspacing="20">
<tr valign="top">
  <td width="420"><strong><em>Website</em></strong><br>
    <strong><em>By Phisek Pinpia</em></strong></td>
  <td width="300"><p><strong><em> Contact <br> E-mail : <a href="mailto:@gmail.com" class="fontfooter">@gmail.com</a> <br> Tel. 089242XXXX</em></strong></p> <div align="right"><a href="https://th-th.facebook.com" target="new"><img src="pic/facebook.png"></a> <a href="https://twitter.com/?lang=th" target="new"><img src="pic/twitter.png"></a> <img src="pic/rss.png"></div></td>
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

<map name="Map">
  <area shape="rect" coords="180,296,237,372" href="admin/index.php">
</map>
</body>
</html>
