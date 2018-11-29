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
<h1>บทที่ 2 Abstractions หน้าที่ 3</h1>
<p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; <strong>2.4 Association Abstraction</strong><br>&nbsp;&nbsp;&nbsp; ความสัมพันธ์ขั้นพื้นฐานที่สุดคือความสัมพันธ์ที่อยู่บนระนาบเดียวกันหมายความว่า สิ่งของทั้งสองสิ่งที่มีความสัมพันธ์กันเป็นสิ่งที่มีความสำคัญเท่าเทียมกัน ไม่ใช่องค์ประกอบของกันเช่น คนเป็นเจ้าของรถยนต์  แม่มีลูก  สามีรักภรรยา  ดินสออยู่ในกระเป๋า ตามแนวทางของ OO เรียกความสัมพันธ์เรียกความสัมพันธ์ในลักษณะนี้ว่า Association Relationship และเรียกกระบวนการค้นหาความสัมพันธ์ลักษณะนี้ ว่า Association Abstraction<br>&nbsp;&nbsp;&nbsp; <strong>2.4.1 Role และ Association Name</strong><br>&nbsp;&nbsp;&nbsp; เมื่อ Class 2 Class มีความสัมพันธ์แบบ Association ต่อกันแล้ว Association ต้องเป็น Association ที่อธิบายได้ ซึ่งบอกได้ว่า Association แต่ละตัวได้ด้วยชื่อของ Association<br>&nbsp;&nbsp;&nbsp; ใน Association Abstraction หนึ่งๆ Class แต่ละ Class จะแสดงบทบาทอย่างใดอย่างหนึ่งเสมอ  เช่น คนงานในสถานที่ทำงาน Class คน จะแสดงบทบาทเป็น ผู้ถูกจ้าง ในขณะเดียวกัน บริษัท จะแสดงบทบาทเป็น  ผู้จ้าง<br>&nbsp;&nbsp;&nbsp; <strong>2.4.2  Multiplicity</strong><br>&nbsp;&nbsp;&nbsp; การพิจารณา Association ระหว่าง Class สิ่งที่ต้องคำนึงถึง คือ ค่าที่เป็นไปได้ของจำนวนสมาชิกใน Class หนึ่งๆ ที่มีส่วนร่วมใน Association ซึ่งจะเรียกค่าของจำนวนสมาชิกของ Class ที่เป็นไปได้ใน Association ว่า Multiplicity<br>&nbsp;&nbsp;&nbsp; จะเรียกจำนวนที่น้อยที่สุดของสมาชิกของ Class ที่มีส่วนร่วมใน Association ว่า Minimum Multiplicity (Min-card) และเรียกจำนวนที่มากที่สุดของสมาชิกของ Class ที่มีส่วนร่วมใน Association ว่า Maximum Multiplicity (Max-card)<br>&nbsp;&nbsp;&nbsp; <strong>ตัวอย่าง 2.3</strong> ความสัมพันธ์ของ Class ในระบบห้องสมุด<br>&nbsp;&nbsp;&nbsp; 1. สมาชิกของห้องสมุดมีบัตรสมาชิกได้เพียงหนึ่งใบ<br>&nbsp;&nbsp;&nbsp; 2. ในการยืมหนังสือแต่ละครั้ง สมาชิกสามารถยืมได้อย่างน้อย 1 เล่มอย่างมาก 5 เล่ม<br>&nbsp;&nbsp;&nbsp; 3. หนังสือบางเล่มจะมีแผ่น CD โดยแผ่น CD จะถูกแยกไว้ที่บรรณารักษ์ แผ่น CD ที่มากับหนังสือจะมีจำนวนเท่าใดก็ได้ <br>&nbsp;&nbsp;&nbsp; 4. สมาชิกสามารถแจ้งความจำนงค์ขอให้ห้องสมุดจัดหาสื่อวิชาการต่างๆ โดยสมาชิกสามารถแจ้งความจำนงค์ได้มากกว่าหนึ่งรายการ และสื่อหนึ่งรายการอาจถูกแจ้งความจำนงค์โดยสมาชิกมากกว่าหนึ่งคน<br>&nbsp;&nbsp;&nbsp; - Association ระหว่าง Member กับ MemCard<br><img src="../pic/f4.jpg">
													<br>&nbsp;&nbsp;&nbsp; - Association ระหว่าง Member กับ Book<br><img src="../pic/f5.jpg">
													<br>&nbsp;&nbsp;&nbsp; - Association ระหว่าง Bookกับ CompactDisk<br><img src="../pic/f6.jpg">
													<br>&nbsp;&nbsp;&nbsp; - Association ระหว่าง Mediaกับ Member<br><img src="../pic/f7.jpg">
													<br>&nbsp;&nbsp;&nbsp; <strong>2.4.3 การจำลอง Association Abstraction ด้วย UML</strong><br>&nbsp;&nbsp;&nbsp; การเขียนสัญลักษณ์แสดง Association ของ Class 2 Class แสดงด้วยเส้นตรงลากเชื่อมระหว่าง Class ทั้งสอง เส้นที่ลากเชื่อมต้องมีชื่อของ Association กำกับเสมอ รวมถึงลูกศรเพื่อแสดงเส้นทางในการอ่านความสัมพันธ์ Min Card และ Max Card ของทั้งสองกำกับที่ปลายเส้นที่ติดกับ Class
													<br><center><img src="../pic/f8.jpg"></center>
													</div>
													<hr width="800" size=3> <br>
<table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  <li><a href="les2-2.php">Previous</a></li>
  <li><a href="les2-1.php">1</a></li>
  <li><a href="les2-2.php">2</a></li>
  <li><a href="les2-3.php">3</a></li>
  <li><a href="les2-4.php">4</a></li>
  <li><a href="les2-5.php">5</a></li>
  <li><a href="les2-4.php">Next</a></li>
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
