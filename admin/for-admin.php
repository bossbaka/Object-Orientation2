<?php require_once('../Connections/myconnect.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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

mysql_select_db($database_myconnect, $myconnect);
$query_Recordset1 = "SELECT * FROM number_register";
$Recordset1 = mysql_query($query_Recordset1, $myconnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>:: For-Admin ::</title>
<link rel="stylesheet" type="text/css" href="style.css">


</head>

<body background="../pic/bg.jpg" link="#000000" vlink="#ff5d5d" alink="#0033cc">

<header class="menu">
<table width="1000" border="0" align="center">
  <tr>
    <td width="300" height="66"><img src="../pic/logo1.png" width="294" height="52"></td>
    <td width="700" align="right"><div class="bx-search"><form action="search.php" method="post" id="se"><input name="word" type="text" id="word"></form></div></td>
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
<table width="1000" border="0"  align="center" cellspacing="25">
	<tr>
		<td class="welcome"><center>
		  พื้นที่หน้า การจัดการของแอดมิน
		</center><hr size="2" color="#e6e6e6">
		ข้อมูลสมาชิก&nbsp;</td>
	</tr>
</table>
<table width="997" border="1"  align="center" cellpadding="3" class="table-datamember">
  <tr>
      <td width="30" align="center">รหัส</td>
      <td width="80">Username</td>
      <td width="80">Password</td>
      <td width="120">E-mail</td>
      <td width="120">ชื่อ</td>
      <td width="120">นามสกุล</td>
      <td width="170">ที่อยู่</td>
      <td width="80">เบอร์โทร</td>
      <td align="center">การจัดการ</td>
  </tr>
    <?php do { ?>
      <tr>
        <td align="center"><?php echo $row_Recordset1['id_register']; ?></td>
        <td><?php echo $row_Recordset1['user_register']; ?></td>
        <td><?php echo $row_Recordset1['pass_register']; ?></td>
        <td><?php echo $row_Recordset1['email_register']; ?></td>
        <td><?php echo $row_Recordset1['name_register']; ?></td>
        <td><?php echo $row_Recordset1['lass_register']; ?></td>
        <td><?php echo $row_Recordset1['add_register']; ?></td>
        <td><?php echo $row_Recordset1['tel_register']; ?></td>
        <td align="center"><a href="delete.php?id_register=<?php echo $row_Recordset1['id_register']; ?>">ลบ</a> ! <a href="update.php?id_register=<?php echo $row_Recordset1['id_register']; ?>">แก้ไข</a></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</div>
<br>
<table width="1000" border="0">
  <tr class="linkcolor">
<td>| <a href="insert.php">เพิ่มข้อมูล</a> |</td></tr>
  <tr>
    <td align="right"><div link="fff" alink="fff" vlink="ffffff"><strong class="linkcolor"><a href="<?php echo $logoutAction ?>">LOGOUT</a></strong></div></td>
  </tr>
</table>
<br><br><br><br><br><br><br><br><br><br>
  
<div class="footer">
  <table width="1000" border="0" align="center" cellspacing="20">
<tr valign="top">
  <td width="420"><strong><em>Website</em></strong><br>
    <strong><em>By Phisek Pinpia</em></strong></td>
  <td width="300"><p><strong><em> Contact <br> E-mail : <a href="mailto:boss@gmail.com" class="fontfooter">boss@gmail.com</a> <br> Tel. 089242XXXX</em></strong></p> <div align="right"><a href="https://th-th.facebook.com" target="new"><img src="../pic/facebook.png"></a> <a href="https://twitter.com/?lang=th" target="new"><img src="../pic/twitter.png"></a> <img src="../pic/rss.png"></div></td>
  	</tr>
</table>
</div>>

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
<?php
mysql_free_result($Recordset1);
?>
>