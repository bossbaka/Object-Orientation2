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
<title>:: Home ::</title>
<link rel="stylesheet" type="text/css" href="admin/style.css">

<script>
function clockTimer()
{
	var date = new Date();
	var time = [date.getHours(),date.getMinutes(),date.getSeconds()]; // |[0] = Hours| |[1] = Minutes| |[2] = Seconds|
	var dayOfWeek = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
	var days = date.getDay();
	
	if(time[0] < 10){time[0] = "0"+ time[0];}
	if(time[1] < 10){time[1] = "0"+ time[1];}
	if(time[2] < 10){time[2] = "0"+ time[2];}
	
	var current_time = [time[0],time[1],time[2]].join(':');
	var clock = document.getElementById("clock");
	var day = document.getElementById("dayOfWeek");
	
	clock.innerHTML = current_time;
	day.innerHTML = dayOfWeek[days];
		
	setTimeout("clockTimer()", 1000);
}


</script>
<script src="jquery.mobile-1.4.5.js"></script>
<script src="jquery.mobile-1.4.5.js"></script>
</head>

<body background="pic/bg.jpg" ackgr onload="clockTimer();">

<header class="menu">
<table width="1000" border="0" align="center">
  <tr>
    <td width="300" height="66"><img src="pic/logo1.png" width="294" height="52"></td>
    <td width="700" align="right"><div class="bx-login"><form ACTION="<?php echo $loginFormAction; ?>" method="POST" id="login">
      <input type="text" name="user" id="user" placeholder="Username">
  <input name="pass" id="password" type="password" placeholder="Password">
  <input type="submit" name="submit" id="submit" value="Login">
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

<br><br><br>
 <div class="h11">OBJECT ORIENTATION<br>3901-2003</div>                           
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>




<table width="1000" border="0" align="center">
  <tr>
    <td><div class="box-4 box-4">
			<div class="box-content">
        <h2>จุดประสงค์รายวิชา</h2>
				<p>1. เพื่อให้มีความเข้าใจหลักการวิเคราะห์และออกแบบเชิงวัตถุ<br>
                2. เพื่อให้สามารถปฏิบัติการวิเคาะห์และออกแบบเชิงวัตถุ<br>
                3. เพื่อให้มีกิจนิสัยในการทำงานด้วยความประณีต รอบคอบและปลอดภัย ตระหนักถึงคุณ ภาพของงานและมีจริยธรรมในงานอาชีพ
                </p>
			</div>
		</div></td>
  </tr>
</table>
<br>

<table width="1000" border="0" align="center">
  <tr>
    <td><div class="box-4 box-4">
			<div class="box-content">
        <h2>มาตรฐานรายวิชา</h2>
				<p>1. วิเคราะห์และออกแบบเชิงวัตถุ<br>
                2. ปฏิบัติการออกแบบและวิเคราะห์เชิงวัตถุ<br>
                </p>
			</div>
		</div></td>
  </tr>
</table>
<br>

<table width="1000" border="0" align="center">
  <tr>
    <td><div class="box-4 box-4">
			<div class="box-content">
        <h2>คำอธิบายรายวิชา</h2>
				<p>ศึกษาและปฏิบัติ Application Development Process, Basic Principle of Object Orientation, Data Type, Encapsulation, Polymorphism, Inheritance, Object Life Cycle Process Analysis, Design and Testing
                </p>
			</div>
		</div></td>
  </tr>
</table>

<br><br><br>
<table width="1000" border="0">
  <tr>
    <td align="center" width="1000"><div class="clockpage">
      <span id="clock">12:00:00</span>
			<span id="dayOfWeek">Friday</span>
		</div></td>
  </tr>
</table>
<br><br><br>

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


<p id="back-to-top" style="display: black; opacity;">
<a href="#top">
<span></span>
</a>
</p>
</body>
</html>