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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="register.php";
  $loginUsername = $_POST['username'];
  $LoginRS__query = sprintf("SELECT user_register FROM number_register WHERE user_register=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_myconnect, $myconnect);
  $LoginRS=mysql_query($LoginRS__query, $myconnect) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO number_register (user_register, pass_register, email_register, name_register, lass_register, add_register, tel_register) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['lassname'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['tel'], "text"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($insertSQL, $myconnect) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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
<title>:: สมัครสมาชิก ::</title>
<link rel="stylesheet" type="text/css" href="admin/style.css">
</head>

<body background="pic/bg.jpg"  link="#000000" vlink="#ff5d5d" alink="#0033cc">

<header class="menu">
<table width="1000" border="0" align="center">
  <tr>
    <td width="300" height="66"><img src="pic/logo1.png" width="294" height="52"></td>
    <td width="700" align="right"><div class="bx-login"><form ACTION="<?php echo $loginFormAction; ?>" method="POST">
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

<p>&nbsp;</p>
<p><br>
</p>
<table width="1000" border="0" cellspacing="10" class="font-php"><tr><td><div class="welcome">สมัครสมาชิก</div><hr size="2" color="#e6e6e6">

<form action="<?php echo $editFormAction; ?>" name="form2" method="POST" id="form2"><table width="1000" border="0"  align="center" cellspacing="10"  class="fontphp">
									<tr>
										<td  colspan="2"><div class="">กรุณากรอกรายละเอียดด้านล่างเพื่อสมัครเป็นสมาชิก</div><br></td>
									</tr>
									
									<tr><td width="180">Username</td>
									<td width="400"><input name="username" type="text" id="username"></td>
									</tr>
									<tr>
									<td width="180">Password</td>
									<td width="400"><input name="password" type="password" id="password"></td>
									</tr>
									<tr><td width="180">E-mail</td>
									<td width="400"><input name="email" type="text" id="email"></td>
									</tr>
									<tr><td width="180">ชื่อ</td>
									<td width="400"><input name="name" type="text" id="name"></td>
									</tr>
									<tr><td width="180">นามสกุล</td>
									<td width="400"><input name="lassname" type="text" id="lassname"></td>
									</tr>
                                    <tr><td width="180">ที่อยู่</td>
									<td width="400"><input name="address" type="text" id="address" ></td>
									</tr>
                                   <tr>
                                     <td width="180">เบอร์โทร</td>
									<td width="400"><input name="tel" type="text" id="tel"></td>
		  							</tr>
                                    
                                    			<tr>
										<td colspan="2"><div class="fontphp"><br><center><input name="ok" type="checkbox" id="ok" style="width:18px;height:18px"> ยืนยันยอมรับข้อกำหนดและเงื่อนไขในการใช้บริการของเรา</center></div>
										  <div align="center"><br>
										    <input type="submit" value="ตกลง" style="width:150px;height:35px">
										    <input  type="reset" value="ยกเลิก" style="width:150px;height:35px">
									      </div></td>
									</tr>
									</table>
  <input type="hidden" name="MM_insert" value="form2">
</form>

</table>
<br>


<table width="1000" border="0">
  <tr class="linkcolor">
    <td align="right"><a href="index.php">ย้อนกลับ หน้าแรก</a></td>
  </tr>
</table>


<br><br>

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
</table>
</body>
</html>