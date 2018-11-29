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
<h1>บทที่ 7 Persistent Data Design หน้าที่ 1</h1>
<p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; <strong>7.1 Relational Database</strong><br>&nbsp;&nbsp;&nbsp; Relational Database คือระบบฐานข้อมูลที่อาศัย Relation หรือตาราง (Table) เพื่อแสดงค่าและความสัมพันธ์ของข้อมูล ข้อมูลที่เก็บอยู่ในแต่ละช่องของ Table เรียกว่า Data Item ในทาง Relational Database แต่ละกลุ่มของ Data Item จะมีชื่อของตนเอง เรียกชื่อนั้นว่า Field Name หรือ Column Name กลุ่มของข้อมูลที่มี Column Name เหมือนกัน เรียกว่า Column และเมื่อนำ Column หลายๆ Column ที่แตกต่างกันมาเรียงต่อกันจะได้ Tuple หรือ Row ของข้อมูล และ Row หลายๆ Row เมื่อรวมกันจะได้ Table และเมื่อนำเอา Table ที่มีความสัมพันธ์กันมารวมกันจะได้ฐานข้อมูล (Database) นั่นเอง
													<br><center><img src="../pic/f37.jpg"></center><br>&nbsp;&nbsp;&nbsp; ในแต่ละ Row ของ Database จะเป็นกลุ่มของ Data Item ที่บ่งชี้ถึง Entry หรือกลุ่มของ Attributes ของ Object แต่ละตัว ดังนั้นในแต่ละ Row จะต้องมี Data Item อย่างน้อย 1 ตัวที่จะเป็นตัวบ่งชี้ (Identity) ว่า Row นั้นบรรจุข้อมูลที่ต่าง Row กัน กล่าวคือ จะต้องเลือกเอา Column อย่างน้อย 1 Column มาเป็นตัวบ่งชี้ดังกล่าว ซึ่งตัวบ่งชี้ของ Row ใด Row หนึ่ง จะต้องไม่ซ้ำกับตัวบ่งชี้ของ Row อื่น และเรียก Column ที่เป็นตัวบ่งชี้นั้นว่า Key หรือ Primary Key ตัวอย่างเช่น คนไทยมีหมายเลขบัตรประชาชน เป็น Primary Key เพราะหมายเลขบัตรประชาชนของคนไทยแต่ละคน ไม่มีทางซ้ำกันได้เลย<br>&nbsp;&nbsp;&nbsp; ในขณะเดียวกัน เมื่อต้องการที่จะแสดงความสัมพันธ์ระหว่าง Table หนึ่งกับอีก Table หนึ่ง สิ่งที่จำเป็นต้องมีคือ ข้อมูลสักตัวหนึ่งที่จะสามารถบ่งชี้ถึงความสัมพันธ์ระหว่าง 2 Table ได้ ซึ่งในหลักการของ Relational Database นั้น จะใช้การอ้างอิง (Reference) เพื่อบ่งชี้ความสัมพันธ์ระหว่าง 2 Table สิ่งที่ใช้เพื่อการอ้างอิงนี้เรียกว่า Foreign Key ซึ่งหมายถึง Column หนึ่งใน Table ที่จะเก็บ Primary Key ของอีก Table หนึ่งไว้เพื่อใช้ในการอ้างถึง หรือแสดงความสัมพันธ์
													<br><center><img src="../pic/f38.jpg"></center><br>&nbsp;&nbsp;&nbsp; จากรูปเป็นภาพแสดง ตัวอย่างของ Primary Key และ Foreign Key ในภาพ เป็น Table ของบุคคล (Person) และจังหวัด (Province) โดย Data Item ที่แสดงด้วยตัวเอียงหนาขีดเส้นใต้ คือ Primary Key (Primary Key ของ Person คือ Id ในขณะที่ Primary Key ของ Province คือ Prov_Id ) และตัวอักษรเอียงคือ Foreign Key ตัวอย่างเช่น ใน Table Person จะมี Foreign Key ชื่อ Address ซึ่งในความเป็นจริงแล้วค่าที่อยู่ใน Column นี้ได้จะต้องเป็นค่าใดค่าหนึ่งใน Column Prov_Id ของ Table Province กล่าวคือ ค่าใน Column Address จะต้องอ้างอิงตาม Prov_Id เสมอนั่นเอง จากทั้งสอง Table ข้างต้น จะตีความหมายได้ว่า Kit อยู่ที่จังหวัด Ayutthaya ในขณะที่ Noi อยู่ที่จังหวัด Bangkok นั่นเอง<br>&nbsp;&nbsp;&nbsp; จากที่ผ่านมาได้พูดถึง Class Diagram จะพบว่า Class ใด Class หนึ่งใน Class Diagram นั้น ต้องมีความสัมพันธ์กันในรูปแบบใดรูปแบบหนึ่ง (Aggregation, Generalization หรือ Association) กับ Class อื่นอย่างน้อย 1 Class เสมอ ดังนั้นการออกแบบ Relational Database เพื่อเก็บข้อมูล (หรือ Attributes) ของ Class ต่างๆ จึงจำเป็นต้อง แสดงความสัมพันธ์ของ Table เช่นเดียวกัน ใน Relational Database นั้น สิ่งที่ใช้เพื่อเชื่อมความสัมพันธ์ระหว่าง Table ก็คือ Foreign Key นั่นเอง
													<br>&nbsp;&nbsp;&nbsp; <strong>7.1.1 หลักการในการแปลงจาก Class Diagram สู่ Relational Database</strong>
													<br><center><img src="../pic/f39.jpg"></center><br>&nbsp;&nbsp;&nbsp; ตัวอย่างนี้ เป็นประโยคในการสร้าง Table ที่ชื่อ Person ซึ่งมีข้อมูลหรือ Column ต่างๆ ดังนี้<br>&nbsp;&nbsp;&nbsp; -Id		ใช้เพื่อเก็บหมายเลขประจำตัวของบุคคล<br>&nbsp;&nbsp;&nbsp; -Name		ใช้เพื่อเก็บชื่อของบุคคล<br>&nbsp;&nbsp;&nbsp; -Sex, Age, Height	ใช้เพื่อเก็บ เพศ อายุ และ ส่วนสูง ของบุคคล<br>&nbsp;&nbsp;&nbsp; -Char(n)		 หมายถึง การกำหนดชนิดและขนาดของข้อมูลให้เป็นตัวอักษรที่มีขนาด n เช่น Id Char(10) หมายถึงให้ Column Id มีชนิดเป็นตัวอักษร ซึ่งมีความยาวได้สูงสุด 10 ตัวอักษร<br>&nbsp;&nbsp;&nbsp; -Integer และ Real	หมายถึง การกำหนดชนิดของข้อมูลให้เป็น จำนวนเต็มและ		จำนวนจริง ตามลำดับ<br>&nbsp;&nbsp;&nbsp; การมีวลี Not Null อยู่ท้าย Column ใด หมายถึง Column นั้น จะต้องมีค่าเสมอ<br>&nbsp;&nbsp;&nbsp; -Primary Key = Id	หมายถึง การกำหนดให้ Id เป็น Primary Key ของ Table นี้<br>&nbsp;&nbsp;&nbsp; -Foreign Key Job Reference Job_DB หมายถึง การกำหนดให้ Column ชื่อ Job เป็น Foreign Key อ้างอิงไปยัง Table ชื่อ Job_DB
																																								</div>
													<hr width="800" size=3> <br>
<table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  
  <li><a href="les7-1.php">1</a></li>
  <li><a href="les7-2.php">2</a></li>
  <li><a href="les7-2.php">Next</a></li>
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
