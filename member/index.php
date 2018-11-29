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
	
  $logoutGoTo = "../index.php";
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

$MM_restrictGoTo = "../index.php";
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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>:: Home ::</title>
<link rel="stylesheet" type="text/css" href="../admin/style.css">

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
</head>

<body background="../pic/bg.jpg" ackgr onload="clockTimer();">

<header class="menu">
<table width="1000" border="0" align="center">
  <tr>
    <td width="300" height="66"><img src="../pic/logo1.png" width="294" height="52"></td>
    <td width="700" align="right"><div class="test2">ยินดีต้อนรับคุณ <?php echo $_SESSION['MM_Username']; ?> <a href="<?php echo $logoutAction ?>" class="test1">Log out</a></div></td>
  </tr>
 </table>
</header>
<table width="1000" height="70" border="0"></table>
<div class="pictop"></div>
<br><br>
<table width="1000" align="center" cellpadding="0"  cellspacing="0">
<tr class="font-rsu">
	<td>
	  <div id='cssmenu'>
	<ul class="font-rsu">
   <li><a href='index.php'>หน้าหลัก</a></li>
   <li><a href='less-test.php#less'>เนื้อหาบทเรียน</a></li>
   <li><a href='less-test.php#test'>แบบทดสอบ</a></li>
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
  <td width="300"><p><strong><em> Contact <br> E-mail : <a href="mailto:@gmail.com" class="fontfooter">@gmail.com</a> <br> Tel. 089242XXXX</em></strong></p> <div align="right"><a href="https://th-th.facebook.com" target="new"><img src="../pic/facebook.png"></a> <a href="https://twitter.com/?lang=th" target="new"><img src="../pic/twitter.png"></a> <img src="../pic/rss.png"></div></td>
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