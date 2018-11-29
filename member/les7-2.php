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
<title>บทที่ 7</title>
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
<h1>บทที่ 7 Persistent Data Design หน้าที่ 2</h1>
<p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; <strong>7.1.2 หลักการในการแปลง Class ให้เป็น Table</strong><br>&nbsp;&nbsp;&nbsp; - กำหนดให้ Attribute ตัวใดตัวหนึ่ง หรือกลุ่มใดกลุ่มหนึ่งเป็น Primary Key<br>&nbsp;&nbsp;&nbsp; - สร้าง Table ที่มีทุกๆ Attributes ของ Class นั้น และมี Primary Key ตามที่กำหนดมาแล้ว<br>&nbsp;&nbsp;&nbsp; - Attribute หรือกลุ่มของ Attribute ที่เป็น Primary Key ต้องถูกกำหนดเป็น Not Null เสมอ<br>&nbsp;&nbsp;&nbsp; - สำหรับ Attributes อื่นๆ ที่ไม่ได้ถูกเลือกให้เป็น Primary Key ให้พิจารณาว่า Attributes ใดเป็น Null ได้ และ Attributes ใดเป็น Null ไม่ได้<br>&nbsp;&nbsp;&nbsp; - ในการออกแบบ Table ไม่ต้องสนใจในส่วนของ Function ให้มุ่งความสนใจไปยัง Attributes ต่างๆ เท่านั้น
													<br>&nbsp;&nbsp;&nbsp; <strong>ตัวอย่าง 7.1</strong><br><center><img src="../pic/f40.jpg"></center><br>&nbsp;&nbsp;&nbsp; <strong>7.1.3 หลักการแปลง Class ที่มีความสัมพันธ์กันแบบ Aggregation ให้เป็น Table ที่สัมพันธ์กัน</strong><br>&nbsp;&nbsp;&nbsp; ออกแบบ Table จาก Class ทั้ง 2 ข้างของเครื่องหมาย Aggregation ที่ได้แนะนำไปแล้ว<br>&nbsp;&nbsp;&nbsp; การแสดงความสัมพันธ์ของ Table ใน Relational Database นั้น ให้นำเอา Primary Key (อาจจะเป็น Field เดียวหรือกลุ่มของ Field ก็ได้) ของ Main Class มาเป็น Foreign 	Key ของ Composite Class ซึ่งก็เหมือนกับการเอาชื่อของพ่อแม่ไปเก็บไว้ที่ลูก 	เมื่อพ่อแม่พาลูกออกไปเที่ยว เวลาที่ลูกสูญหาย ตำรวจจะได้ทราบพ่อแม่คือใคร แต่ถ้าหากปฏิบัติในทางกลับกันตำรวจจะไม่สามารถตามหาลูกที่สูญหายได้ <br><br>&nbsp;&nbsp;&nbsp; <strong>7.1.4 หลักการแปลง Class ที่มีความสัมพันธ์กันแบบ Association ให้เป็น Table ที่สัมพันธ์กัน</strong><br>&nbsp;&nbsp;&nbsp; <strong>1. One-to-One Association</strong><br>&nbsp;&nbsp;&nbsp; - ออกแบบ Table ของ Class ทั้งสองข้างของเครื่องหมาย Association<br>&nbsp;&nbsp;&nbsp; - ให้เลือกเอา Primary Key ของ Table ตัวใดก็ได้ไปเป็น Foreign Key ของอีก Table หนึ่ง<br>&nbsp;&nbsp;&nbsp; - การใส่ Foreign Key ให้พิจารณาว่า Table ที่ถูกอ้างถึงนั้น มี Minimum Cardinality เป็นอะไร เช่น ถ้าเป็น 0..1 Foreign Key จะเป็นค่าว่างได้ แต่ถ้ากลับกัน เป็น 1..1 	Foreign Key จะเป็นค่าว่างไม่ได้<br>&nbsp;&nbsp;&nbsp; <strong>2. One-to-Many Association</strong><br>&nbsp;&nbsp;&nbsp; หลักในการสร้าง Table จาก One-to-Many Association นั้น มีหลักการเดียวกันกับการสร้าง Table จาก Aggregation Abstraction โดย Table ในด้าน One จะเหมือนกับ Table ของ Main Class หรือ Aggregation Association และ Table ในด้าน Many จะเหมือนกับ Table ของ Composite Class ใน Aggregation นั่นคือให้นำเอา Primary Key ของ Table ในด้าน One ไปเป็น Foreign Key ของ Table ในด้าน Many<br>&nbsp;&nbsp;&nbsp; <strong>3. Many-to-Many Association</strong><br>&nbsp;&nbsp;&nbsp; - สร้าง Table ของ Class ทั้งสองข้างของ Association<br>&nbsp;&nbsp;&nbsp; - สร้าง Table อีกหนึ่ง Table ที่มีอย่างน้อย 2 Column ซึ่งก็คือ Primary Key ของ 	Table ทั้งสอง และให้ Column ทั้งหมดเป็น Key ของ Table ดังกล่าว ซึ่งจะเรียกว่าเป็น Association Table<br>&nbsp;&nbsp;&nbsp; - ให้ส่วนหนึ่งของ Primary Key ที่เป็น Primary Key ของ Table ข้างใดข้างหนึ่งเป็น Foreign Key อ้างอิงไปยัง Table นั้นๆ<br><br>&nbsp;&nbsp;&nbsp; <strong>7.1.5 หลักการแปลง Class ที่มีความสัมพันธ์กันแบบ Generalization ให้เป็น Table ที่สัมพันธ์กัน</strong><br>&nbsp;&nbsp;&nbsp; <strong>ตัวอย่าง 7.2 การสร้าง Table จากข้อความ</strong><br>&nbsp;&nbsp;&nbsp; “นักเรียนทุกๆ คน จะต้องเข้าอยู่ในชมรมฟุตบอล หรือชมรมเทนนิส หรืออาจจะอยู่ทั้ง 2 ชมรมเลยก็ได้” เป็นตัวอย่างของ Generalization แบบ Total-Overlapping ซึ่งสามารถสร้าง Table โดยยึดหลักการการสร้าง Table ดังนี้
													<br><center><img src="../pic/f41.jpg"></center>
													</div>
													<hr width="800" size=3> <br>
<table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  <li><a href="les7-1.php">Previous</a></li>
  <li><a href="les7-1.php">1</a></li>
  <li><a href="les7-2.php">2</a></li>
 
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
