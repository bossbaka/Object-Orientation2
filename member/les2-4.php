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
<title>บทที่ 2</title>
<link rel="stylesheet" type="text/css" href="../admin/style.css">
</head>

<body background="../pic/bg.jpg" >

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
   <li><a href='less-test.php#less'>เนื้อหาบทเรียน</a>
      <ul>
         <li><a href='les1-1.php'>บทที่ 1</a></li>
         <li><a href='les2-1.php'>บทที่ 2</a></li>
         <li><a href='les3-1.php'>บทที่ 3</a></li>
         <li><a href='les4-1.php'>บทที่ 4</a></li>
         <li><a href='les5-1.php'>บทที่ 5</a></li>
         <li><a href='les6-1.php'>บทที่ 6</a></li>
         <li><a href='les7-1.php'>บทที่ 7</a></li>
         <li><a href='les8-1.php'>บทที่ 8</a></li>
         <li><a href='les9-1.php'>บทที่ 9</a></li>
         <li><a href='les10-1.php'>บทที่ 10</a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='less-test.php#test'>แบบทดสอบ</a>
      <ul>
         <li><a href='test1-1.php'>บทที่ 1</a></li>
         <li><a href='test2-1.php'>บทที่ 2</a></li>
         <li><a href='test3-1.php'>บทที่ 3</a></li>
         <li><a href='test4-1.php'>บทที่ 4</a></li>
         <li><a href='test5-1.php'>บทที่ 5</a></li>
         <li><a href='test6-1.php'>บทที่ 6</a></li>
         <li><a href='test7-1.php'>บทที่ 7</a></li>
         <li><a href='test8-1.php'>บทที่ 8</a></li>
         <li><a href='test9-1.php'>บทที่ 9</a></li>
         <li><a href='test10-1.php'>บทที่ 10</a></li>
      </ul>
   </li>
   
   <li><a href='about.php'>เกี่ยวกับเรา</a></li>
</ul>
</div>
	</td>
</tr>
</table>

<div class="textbox">
<h1>บทที่ 2 Abstractions หน้าที่ 4</h1>
<p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; - เริ่มจาก Association ระหว่าง Member กับ MemberCard<br><center><img src="../pic/f9.jpg"></center><br>&nbsp;&nbsp;&nbsp; - นำผลลัพธ์จากข้อ 1 รวมเข้ากับ Association ระหว่าง Member กับ Book<br><center><img src="../pic/f10.jpg"></center><br>&nbsp;&nbsp;&nbsp; - นำผลลัพธ์จากข้อ 2 รวมเข้ากับ Association ระหว่าง Bookกับ CompactDisk<br><center><img src="../pic/f11.jpg"></center><br>&nbsp;&nbsp;&nbsp; - นำผลลัพธ์จากข้อ 3 รวมเข้ากับ Association ระหว่าง Member กับ Media<br><center><img src="../pic/f12.jpg"></center><br>&nbsp;&nbsp;&nbsp; <strong>2.4.4 Mandatory และ Optional Class</strong><br>&nbsp;&nbsp;&nbsp; Mandatory Class คือ Class ที่ต้องมีส่วนร่วมอยู่ใน Association เสมอ จะขาดไม่ได้ ข้อสังเกตคือ Mandatory Class จะมี min-card ไม่เท่ากับ 0<br>&nbsp;&nbsp;&nbsp; Optional Class คือ Class ที่ไม่จำเป็นต้องมีส่วนร่วมอยู่ใน Association โดย Optional Class คือ Class ที่มี Min-card เท่ากับ 0<br>&nbsp;&nbsp;&nbsp; <strong>2.4.5 ประเภทความสัมพันธ์ใน Association</strong><br>&nbsp;&nbsp;&nbsp; - One-to-One Association คือ Association ที่ Class ทั้งสองข้างของ Association มี max-card เป็น 1 ทั้งคู่<br>&nbsp;&nbsp;&nbsp; - One-to-Many Association คือ Association ที่ Class ข้างหนึ่งของ Association มี max-card เป็น 1  ในขณะเดียวกันที่ Class อีกข้างหนึ่งมี Max-card มีค่ามากกว่า 1<br>&nbsp;&nbsp;&nbsp; - Many-to-Many Association คือ Association ที่ Class ทั้งสองข้างของ Association มี max-card มีค่ามากกว่า 1 ทั้งคู่
<br><strong>2.5 Aggregation Abstraction</strong><br>&nbsp;&nbsp;&nbsp; Aggregation Abstraction คือ กระบวนการหาความสัมพันธ์ระหว่าง Class ที่เราสนใจในลักษณะที่ Class หนึ่งเป็นองค์ประกอบของ Class หนึ่ง หรือ ความสัมพันธ์แบบ Whole – Part<br>&nbsp;&nbsp;&nbsp; ในโลกแห่งความเป็นจริงพบว่า วัตถุหลายๆ ชนิดในโลกเกิดมาจากการรวมตัวกันของวัตถุต่างๆ เช่น คนเกิดมาจากการรวมตัวกันของ ลำตัว แขน ขา หัว และ คอมพิวเตอร์เกิดจากการรวมตัวกันของ Mainboard, Ram, Rom, Disk Drive, Case เป็นต้น<br>&nbsp;&nbsp;&nbsp; <strong>2.5.1 การจำลอง Aggregation ด้วย UML</strong><br>&nbsp;&nbsp;&nbsp; การจำลอง Aggregation จะใช้เส้นตรงที่มีลูกศรเป็น สี่เหลี่ยมข้าวหลามตัด ลากเชื่อมจาก Part Class ไปยัง Whole Class กำกับ Minimum และ Maximum Multiplicity ไว้ที่ Whole Class<br>&nbsp;&nbsp;&nbsp; <strong>ตัวอย่าง 2.4</strong><br>&nbsp;&nbsp;&nbsp; รถยนต์ ประกอบด้วยเครื่องยนต์หนึ่งเครื่องยนต์ ตัวถังหนึ่งตัวถัง และล้อจำนวน 4 ล้อ ในขณะที่เรือยนต์ ประกอบด้วย หนึ่งเครื่องยนต์ หนึ่งใบพัดและ หนึ่งหางเสือ
													<br><center><img src="../pic/f13.jpg"></center><br>&nbsp;&nbsp;&nbsp; <strong>ตัวอย่าง 2.5 อธิบาย Aggregation ด้วย UML</strong><br>&nbsp;&nbsp;&nbsp; - ชั้นเรียน เกิดจากการรวมกันของนักเรียนอย่างน้อย 1 คน อาจารย์ผู้สอนอย่างน้อย 1 คนและ อุปกรณ์การสอน ซึ่งอาจจะมีหรือไม่มีก็ได้<br>&nbsp;&nbsp;&nbsp; - อาคารเรียน เกิดจากการรวมตัวกันของห้องเรียนหลายๆ ห้อง
													<br><center><img src="../pic/f14.jpg"></center>
													</div>
													<hr width="800" size=3> <br>
<table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  <li><a href="les2-3.php">Previous</a></li>
  <li><a href="les2-1.php">1</a></li>
  <li><a href="les2-2.php">2</a></li>
  <li><a href="les2-3.php">3</a></li>
  <li><a href="les2-4.php">4</a></li>
  <li><a href="les2-5.php">5</a></li>
  <li><a href="les2-5.php">Next</a></li>
</ul></td>
  </tr>
</table>
<br><br><br>

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
