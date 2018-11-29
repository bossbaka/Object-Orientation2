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

<div class="textbox"><h1>บทที่ 2 Abstractions หน้าที่ 1</h1>
  <p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; <strong>2.1 Abstractions</strong><br>&nbsp;&nbsp;&nbsp; เราได้รู้จักกับ Class (เรียกอีกอย่างหนึ่งว่า Abstract Data Type) ซึ่งหมายถึงกลุ่มของ Objects ที่มีความเหมือนหรือคล้ายคลึงกันในแง่ใดแง่หนึ่ง หรือในหลายๆ แง่ โดยสิ่งที่ใช้ในการกำหนดความเหมือนหรือคล้ายคลึงดังกล่าวนั้นก็คือ Concept นั่นเอง เราสามารถบอกได้ว่า Object ใน Class เดียวกัน ล้วนแล้วแต่มี Concept เดียวกัน โดยขึ้นอยู่กับ Domain ที่เรากำหนด<br>&nbsp;&nbsp;&nbsp; กระบวนการในการให้ Concept กับ Objects ต่างๆ ใน Real World เพื่อสร้าง Class นั้น เราเรียกว่า Abstractions ซึ่งแบ่งออกได้ 4 กระบวนการย่อยๆ คือ<br>&nbsp;&nbsp;&nbsp; 1. Classification Abstraction<br>&nbsp;&nbsp;&nbsp; 2. Aggregation Abstraction<br>&nbsp;&nbsp;&nbsp; 3. Generalization Abstraction<br>&nbsp;&nbsp;&nbsp; 4. Association Abstraction<br>&nbsp;&nbsp;&nbsp; การใช้งาน Abstraction เพื่อการวิเคราะห์ Problem Domain นั้น ไม่ได้มีข้อกำหนดตายตัวว่าใน Problem Domain หนึ่งๆ จะต้องใช้ทุก Abstraction หรือ จะใช้ Abstraction ตามลำดับก่อนหรือหลังอย่างไร แต่ส่วนมากแล้ว Classification มักจะเป็น Abstraction แรกที่ถูกใช้ หลังจากนั้นจะขึ้นอยู่กับมุมมองและวิจารณญาณของผู้วิเคราะห์ออกแบบระบบ ที่จะใช้ Abstraction ใดที่เหมาะสมเพื่อการวิเคราะห์ Problem Domain และในความจริงพบว่า Abstraction หนึ่งๆ นั้นมักจะถูกใช้มากกว่า 1 ครั้งเสมอ เพื่อการวิเคราะห์ Problem Domain เพียงหนึ่งเดียว
													<strong>2.2 Classification Abstraction</strong><br>&nbsp;&nbsp;&nbsp; กระบวนการในการให้แนวคิดกับโครงร่าง หรือ Object ในโลกแห่งความเป็นจริง ที่มีลักษณะเฉพาะเป็นของตนเองและแตกต่างจากสิ่งอื่นเพื่อก่อให้เกิดแนวคิดของ Class<br>&nbsp;&nbsp;&nbsp; <strong>2.2.1 การกำหนด Problem Domain</strong><br>หัวใจสำคัญของ Classification Abstraction คือ Concept หมายถึง แนวคิดที่มีต่อ Object ที่เราให้ความสนใจ<br>&nbsp;&nbsp;&nbsp; Concept เป็นเครื่องมือสำคัญที่ช่วยจัดหมวดหมู่ที่ไม่ซ้ำกันให้กับ Object ใน Problem หลังจากที่เราจัดหมวดหมู่ของ Object แล้ว ความคิดรวบยอดที่เรามีต่อกลุ่มของ Object แต่ละกลุ่มก็คือ Class<br>&nbsp;&nbsp;&nbsp; เมื่อ Classification Abstraction คือ กระบวนการในการสร้าง Class จาก Object และ Object เหล่านั้นต้องอยู่ใน Problem Domain ที่เราสนใจ ดังนั้น สิ่งที่ควรทำเป็นอันดับแรก คือ การกำหนดขอบเขตของ Problem Domain เราสามารถกำหนด Problem Domain ได้จากการสอบถามความต้องการ (Requirement) จากผู้ใช้ระบบและผู้ที่เกี่ยวข้อง (User and Stakeholder)<br>&nbsp;&nbsp;&nbsp; ข้อควรจำในการกำหนด Problem Domain คือ Problem Domain ที่แน่ชัดมักจะยังไม่สามารถกำหนดได้ในตอนต้นของการวิเคราะห์ระบบ แต่การกำหนดภาพรวมของ Problem Domain ต้องแน่ชัด<br>&nbsp;&nbsp;&nbsp; <strong>2.2.2 การหา Object และ Class ใน Problem Domain</strong><br>&nbsp;&nbsp;&nbsp; สิ่งแรกที่ต้องทำ เมื่อเรามี Problem Domain แล้ว คือ พิจารณาว่ามี Object อะไรภายใน Domain บ้าง โดยไม่จำเป็นต้องคำนึงถึงกิจกรรมที่เกิดขึ้นในระบบ<br>&nbsp;&nbsp;&nbsp; ดังนั้น ควรที่จะ หาคำนามทั้งหมดที่มีอยู่ใน Problem Domain แล้วจึงมาแยกแยะว่า สิ่งใดเป็น Object สิ่งใดเป็น Attribute ของ Object<br>&nbsp;&nbsp;&nbsp; <strong>ตัวอย่างที่ 2.1</strong> หนังสือเล่มหนึ่ง ปกสีเหลือง ภายในประกอบด้วยเนื้อหาเกี่ยวกับ Object Oriented หนังสือเล่มนี้มีหน้าจำนวน 50 หน้า
													<br><center><img src="../pic/f1.jpg"></center>
<br>&nbsp;&nbsp;&nbsp; <strong>ตัวอย่างที่ 2.2</strong> การประมวลผลข้อมูลด้านการเงินของธนาคารแห่งหนึ่ง มี 2 ประเภท ได้แก่ การประมวลผลแบบ Batch การประมวลผลแบบ Real-Time และการประมวลผลในแต่ละครั้งจะมีเวลาที่ใช้ในการประมวลผลไม่แน่นอน ขึ้นอยู่กับขนาดของข้อมูลที่เข้ามาสู่ระบบ โดยการประมวลผลแบบ Batch ในแต่ละวันจะมีเวลาเริ่มประมวลผลที่แน่นอน ในขณะที่การประมวลผลแบบ Real-Time ต้องพร้อมสำหรับการประมวลผลเสมอ เพราะเวลาของการเข้ามาของข้อมูลไม่แน่นอน</div>
													<hr width="800" size=3><br>
 <table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  
  <li><a href="les2-1.php">1</a></li>
  <li><a href="les2-2.php">2</a></li>
  <li><a href="les2-3.php">3</a></li>
  <li><a href="les2-4.php">4</a></li>
  <li><a href="les2-5.php">5</a></li>
  <li><a href="les2-2.php">Next</a></li>
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
