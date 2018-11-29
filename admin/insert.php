<?php require_once('../Connections/myconnect.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO number_register (id_register, user_register, pass_register, email_register, name_register, lass_register, add_register, tel_register) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_register'], "int"),
                       GetSQLValueString($_POST['user_register'], "text"),
                       GetSQLValueString($_POST['pass_register'], "text"),
                       GetSQLValueString($_POST['email_register'], "text"),
                       GetSQLValueString($_POST['name_register'], "text"),
                       GetSQLValueString($_POST['lass_register'], "text"),
                       GetSQLValueString($_POST['add_register'], "text"),
                       GetSQLValueString($_POST['tel_register'], "text"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($insertSQL, $myconnect) or die(mysql_error());

  $insertGoTo = "for-admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>:: เพิ่มข้อมูล ::</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body background="../pic/bg.jpg"  link="#000000" vlink="#ff5d5d" alink="#0033cc">

<header class="menu">
<table width="1000" border="0" align="center">
  <tr>
    <td width="300" height="66"><img src="../pic/logo1.png" width="294" height="52"></td>
    <td width="700" align="right"><div class="bx-search"><form action="search.php" method="post" id="se2"><input name="word" type="text" id="word"></form></div></td>
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
   <li><a href='../member/index.php'>หน้าหลัก</a></li>
   <li><a href='../member/less-test.php'>เนื้อหาบทเรียน</a></li>
   <li class='has-sub'><a href='../member/less-test.php'>แบบทดสอบ</a></li>
   <li><a href='../member/about.php'>เกี่ยวกับเรา</a></li>
</ul>
</div>
	</td>
</tr>
</table>
<br>
<table width="1000" border="0" class="font-php"><tr><td><div class="welcome">หน้า การเพิ่มข้อมูล</div><hr size="2" color="#e6e6e6"><br>
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <table align="center" cellpadding="10" class="fontphp">
          <tr valign="baseline">
            <td nowrap align="right">รหัส :</td>
            <td><input type="text" name="id_register" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">Username :</td>
            <td><input type="text" name="user_register" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">Password :</td>
            <td><input type="text" name="pass_register" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">E-mail :</td>
            <td><input type="text" name="email_register" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">ชื่อ :</td>
            <td><input type="text" name="name_register" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">นามสกุล :</td>
            <td><input type="text" name="lass_register" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">ที่อยู่ :</td>
            <td><input type="text" name="add_register" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">เบอร์โทร :</td>
            <td><input type="text" name="tel_register" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input type="submit" value="Insert record"></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1">
      </form>
<p>&nbsp;</p></td></tr></table>

<br>
<table width="1000" border="0">
  <tr class="linkcolor">
    <td align="right"><a href="for-admin.php">ย้อนกลับ</a></td>
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
</table>

<p id="back-to-top" style="display: black; opacity;">
<a href="#top">
<span></span>
</a>
</p>
</body>
</html>

