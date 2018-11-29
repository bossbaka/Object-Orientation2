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
<h1>บทที่ 2 Abstractions หน้าที่ 2</h1>
<p>&nbsp;</p>
<strong>&nbsp;&nbsp;&nbsp; 2.2.3 กำหนด Attribute และ Method</strong><br>&nbsp;&nbsp;&nbsp; เมื่อกำหมดได้แล้วว่าสิ่งใดอยู่ใน Problem Domain แล้ว สิ่งที่ต้องทำต่อไป คือ รวบรวม Object ที่คุณสมบัติเหมือนกันไว้ในหมวดหมู่หรือ Class เดียวกัน แล้วกำหนด Attribute และ Method ของ Class เหล่านั้น<br>&nbsp;&nbsp;&nbsp; คำนามและคำวิเศษณ์ที่เป็นตัวบ่งชี้ Attribute จะทำหน้าที่ ดังนี้<br>&nbsp;&nbsp;&nbsp; - เป็นสิ่งที่กำหนด Unique Identity ของ Object ของ Class เช่น รหัสประจำตัวประชาชน เลขที่ ISBN ของหนังสือ<br>&nbsp;&nbsp;&nbsp; - เป็นสิ่งที่กำหนดคุณลักษณะต่างๆ ที่สามารถมองเห็นได้<br>&nbsp;&nbsp;&nbsp; - เป็นสิ่งที่กำหนดคุณลักษณะต่างๆ ที่ไม่สามารถมองเห็น แต่มีอยู่จริงของ Class เช่น ประเภทหนังสือ ราคาหนังสือ อัตราค่าธรรมเนียม<br>&nbsp;&nbsp;&nbsp; - เป็นสิ่งที่บอกถึงสถานะของ Class<br>&nbsp;&nbsp;&nbsp; Method จะใช้คำกริยา เป็นตัวบ่งชี้ Object ทุกตัวตามหลักของ OO เป็น Passive Object
													<br><strong>2.3 Encapsulation และ Information Hiding</strong><br>&nbsp;&nbsp;&nbsp; Class หนึ่งๆ ประกอบด้วย Attribute และ Method ซึ่งสามารถมองเห็นในอีกมุมมองได้ว่า กลุ่มของ Attribute และ กลุ่มของ Method ถูกบรรจุไว้ในกล่องเพียงกล่องเดียว เปรียบเสมือนการนำยาหลายๆ ตัวมาผสมกันแล้วบรรจุลงไว้ในแคปซูลในความเป็นจริงแล้ว Capsule ไม่ได้ใส เราไม่สามารถรู้ได้ว่าภายใน Capsule ประกอบด้วยตัวยาอะไรบ้าง<br>&nbsp;&nbsp;&nbsp; Encapsulation คือ กระบวนการในการซ่อนรายละเอียดของคุณลักษณะต่างๆและรายละเอียดของการทำงานของ Class โดยสิ่งต่างๆ ภายนอก Class จะติดต่อกับ Class ได้ ต้องติดต่อผ่านช่องทางที่ Class เตรียมไว้ให้เท่านั้น เรียกว่า Public Interface<br>&nbsp;&nbsp;&nbsp; หลักการ คือ การมอง Class จากภายใน จะเห็นรายละเอียดของ Class ทั้งหมด และการมอง Class จากภายนอก จะเห็นรายละเอียดเท่าที่ Class เปิดเผยเท่านั้น Information Hiding หมายถึงการซ่อนรายละเอียดของ Attribute และ Method ของ Class จากภายนอก<br><strong>&nbsp;&nbsp;&nbsp; 2.3.1 Visibility</strong><br>&nbsp;&nbsp;&nbsp; Information Hiding ของ Class มีหลายระดับ แตกต่างกันออกไป บางรายละเอียดอาจเปิดเผยให้ภายนอกมองเห็นและใช้งานได้โดยตรง แต่บางอย่างอาจต้องการการปกปิดไม่ยอมให้ภายนอกเห็น<br>&nbsp;&nbsp;&nbsp; เราจะเรียกระดับการมองเห็นแบบนี้ ว่า Visibility แบ่งออกเป็น 3 ระดับ<br>&nbsp;&nbsp;&nbsp; 1. Private จะไม่ถูกเปิดเผยแก่ภายนอกและไม่สามารถเข้าถึงโดยตรงจากภายนอก<br>&nbsp;&nbsp;&nbsp; 2. Protected จะไม่ถูกเปิดเผยแก่ภายนอกและไม่สามารถเข้าได้โดยตรงจากภายนอก แต่สามารถเข้าถึงได้จากภายในตัว Class เอง จะถูกถ่ายทอดให้กับ Subclass และสามารถเข้าถึงได้จากภายใน Subclass<br>&nbsp;&nbsp;&nbsp; 3. Public จะถูกเปิดเผยและถูกเข้าถึงได้โดยตรงจากภายนอก ไม่มีการปกปิดใดๆ<br>&nbsp;&nbsp;&nbsp; <strong>2.3.2 การจำลองภาพของ Class ด้วย UML</strong><br>&nbsp;&nbsp;&nbsp; <strong>- ต้องจำลอง Visibility ของ Attribute/Method ของ Class เสมอ</strong><br>&nbsp;&nbsp;&nbsp;   UML กำหนดให้ใช้เครื่องหมายลบ (-) แทน Visibility private<br>&nbsp;&nbsp;&nbsp;   เครื่องหมายชาร์ป (#) แทน Visibility protected<br>&nbsp;&nbsp;&nbsp;   เครื่องหมายบวก (+) แทน Visibility public
													<br><center><img src="../pic/f3.jpg"></center><br>&nbsp;&nbsp;&nbsp; <strong>- การอธิบายรายละเอียดของ Attributes และ Methods</strong><br>&nbsp;&nbsp;&nbsp; Method ที่ไม่มีการส่งค่าคืน คือ Method ที่เมื่อดำเนินการใดๆ แล้ว จะไม่มีการส่งผลลัพธ์ (Return) ออกสู่ภายนอก<br>&nbsp;&nbsp;&nbsp; Method ที่มีการส่งค่าคืน คือ Method ที่เมื่อดำเนินการใดๆ แล้ว จะส่งผลลัพธ์กลับคืนสู่ภายนอก  โดยจะเรียกค่าที่ Return ออกจาก Method ว่า Method Signature เรียกสั้นๆ ว่า Signature<br>&nbsp;&nbsp;&nbsp; <strong>- หลักนิยมในการตั้งชื่อ Class, Attribute และ Method</strong><br>&nbsp;&nbsp;&nbsp; 1. ต้องเป็นชื่อที่สื่อความได้ และตรงกับความหมายของ Class, Attribute Method เช่น MemberCard<br>&nbsp;&nbsp;&nbsp; 2. ชื่อ Class ควรขึ้นต้นด้วยตัวอักษรภาษาอังกฤษตัวใหญ่<br>&nbsp;&nbsp;&nbsp; 3. ชื่อ Method หรือ Attribute ควรขึ้นต้นด้วยตัวอักษรภาษาอังกฤษตัวเล็ก<br>&nbsp;&nbsp;&nbsp; 4. ชื่อ Method ที่ใช้ควรกำหนดค่าของ Attribute ควรใช้คำว่า set นำหน้าชื่อ Method<br>&nbsp;&nbsp;&nbsp; 5. ชื่อ Method ที่ใช้อ่านค่าของ Attribute ควรใช้คำว่า get นำหน้าชื่อ Method<br>&nbsp;&nbsp;&nbsp; การตั้งชื่อ Class Attribute และ Methods ที่สอดคล้องกับหลักการด้านบน มีข้อดี คือ สามารถเดาโครงสร้างของ Class ได้<br>&nbsp;&nbsp;&nbsp Classification Abstraction เป็นกระบวนการสร้าง Class จาก Object ต่างๆ ที่มีอยู่ใน Problem Domain ที่เราให้ความสนใจ ทำให้ผู้พัฒนาระบบได้ Class พื้นฐานจากกระบวนการนี้ แต่สิ่งที่ยังไม่มีคือ ความสัมพันธ์ของ Class พื้นฐานเหล่านั้น</div>
													<hr width="800" size=3> <br>
<table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  <li><a href="les2-1.php">Previous</a></li>
  <li><a href="les2-1.php">1</a></li>
  <li><a href="les2-2.php">2</a></li>
  <li><a href="les2-3.php">3</a></li>
  <li><a href="les2-4.php">4</a></li>
  <li><a href="les2-5.php">5</a></li>
  <li><a href="les2-3.php">Next</a></li>
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
