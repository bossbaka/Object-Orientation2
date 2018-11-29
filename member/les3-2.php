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
<title>บทที่ 3</title>
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
<h1>บทที่ 3 Use Case Modeling หน้าที่ 2</h1>
<p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; <strong>3.2 ความสัมพันธ์ใน Use Case Diagram</strong><br>&nbsp;&nbsp;&nbsp; แต่ละ Use Case ภายใน Use Case Diagram สามารถมีความสัมพันธ์กันได้ จำแนกออกเป็น 3 ประเภท ได้แก่<br>&nbsp;&nbsp;&nbsp; <strong>3.2.1 Generalization/Specialization</strong><br>&nbsp;&nbsp;&nbsp; ระหว่าง Use Case จะมีคุณสมบัติไม่แตกต่างจาก Class ซึ่ง Use Case ที่ถูก Inherit จะเรียกว่า Parent Use Case ส่วน Use Case ที่ Inherit คุณสมบัติจาก Use Case อื่น จะเรียกว่า Child Use Case ซึ่งจะคล้ายกับ Superclass และ subclass Child Use Case อาจมีคุณสมบัติ Polymorphism คือ Child Use Case อาจมีกิจกรรมภายในที่แตกต่างหรือดัดแปลงกิจกรรมภายในของ Use Case ได้<br>&nbsp;&nbsp;&nbsp; เราจะใช้ Generalization/Specialization ในกรณีที่ต้องการแสดงความสัมพันธ์ในการจำแนกประเภทของ Use Case เช่น การตรวจสอบความถูกต้องของผู้ใช้ระบบ สามารถทำได้หลายวิธี ได้แก่ การตรวจสอบจาก Password และการตรวจสอบจากลายนิ้วมือ<br>&nbsp;&nbsp;&nbsp; ใน UML จะใช้เส้นตรงมีหัวศรสามเหลี่ยมใสเป็นสัญลักษณ์
													<br><center><img src="../pic/f20.jpg"></center><br>&nbsp;&nbsp;&nbsp; <strong>3.2.2 Include</strong><br>&nbsp;&nbsp;&nbsp; เป็นความสัมพันธ์ของ Use Case ที่พบบ่อย ความสัมพันธ์ในกรณีที่ Use Case หนึ่งไปเรียกใช้หรือดึงเอากิจกรรมของอีก Use Case หนึ่ง เพื่อให้กิจกรรมนั้นเกิดขึ้นจริงในตนเอง สรุปคือ กิจกรรมใน Use Case หนึ่ง อาจจะถูกผนวกเข้าไปรวมกับกิจกรรมของอีก Use Case หนึ่ง เรียกความสัมพันธ์นี้ว่า Include โดย Use Case ที่ทำหน้าที่ดึงกิจกรรมมาจาก Use Case อื่น เรียกว่า Base Use Case ส่วน Use Case ที่ถูกเรียกใช้หรือถูกดึงกิจกรรม เรียกว่า Include Use Case<br>&nbsp;&nbsp;&nbsp; ใน UML จะใช้ลูกศรที่มี Sterotype เป็น <<  >> ลากจาก Base ไปยัง Included
													<br><center><img src="../pic/f21.jpg"></center><br>&nbsp;&nbsp;&nbsp; ความสัมพันธ์ระหว่าง Use Case แบบ Include เป็นการสนับสนุนการนำกลับมาใช้ใหม่ของ Use Case คือ Use Case หนึ่งสามารถถูก Include ได้โดย Base Use Caseหลายๆ ตัวและสามารถถูก Include ได้มากกว่าหนึ่งครั้ง<br>&nbsp;&nbsp;&nbsp; <strong>3.2.3 Extends</strong><br>&nbsp;&nbsp;&nbsp; ความสัมพันธ์ระหว่าง Use Case อีกลักษณะหนึ่ง ที่สามารถเกิดขึ้นในกรณีที่บาง Use Case ดำเนินกิจกรรมของตนเองไปตามปรกติ แต่อาจมีเงื่อนไขหรือสิ่งกระตุ้นบางอย่าง ที่ส่งผลให้กิจกรรมตามปรกติของ Use Case นั้น ถูกรบกวนจนเบี่ยงเบนไป สามารถแสดงเงื่อนไขหรือสิ่งกระตุ้นเหล่านี้ได้ในรูปของ Use Case เรียกความสัมพันธ์นี้ว่า Extends เรียก Use Case ที่ถูกรบกวนหรือถูกกระตุ้นว่า Base Use Case เรียก Use Case ที่ทำหน้าที่รบกวนหรือกระตุ้นว่า Extending Use Case<br>&nbsp;&nbsp;&nbsp; เราจะใช้ความสัมพันธ์แบบ Extends เพื่อแสดงให้เห็นถึงระบบที่มีเหตุการณ์หลัก (Mandatory Events) และยังมีเหตุการณ์ทางเลือกอื่นๆ ที่สามารถเกิดขึ้นได้ (Optional Events) เหตุการณ์หลักควรมีได้เพียงหนึ่งเดียว ในขณะที่เหตุการณ์ทางเลือกอาจมีได้มากกว่าหนึ่งก็ได้<br>&nbsp;&nbsp;&nbsp; ใน UML จะใช้สัญลักษณ์ลูกศรที่มี stereotype เป็น < extends > ลากจาก Extending Use Case ไปยัง Base Use Case เพื่อแสดงความสัมพันธ์<br>&nbsp;&nbsp;&nbsp; <strong>3.2.4 Use Case Realization</strong><br>&nbsp;&nbsp;&nbsp; จุดมุ่งหมายของ Use Case คือ  อธิบายว่าระบบทำงานอะไร ไม่ใช่ระบบทำงานอย่างไร ในบางกรณี Use Case อาจมีทางเลือกของเหตุการณ์ที่หลากหลายแตกต่างกัน แต่ได้ผลลัพธ์แบบเดียวกัน เช่น การตรวจสอบผู้เข้าใช้งานระบบ อาจกระทำได้หลายวิธี เช่น ระบบ ATM ต้องระบุเลยว่า ต้องตรวจสอบผู้ใช้งานโดยการตรวจสอบ Pin Code เป็นรหัส 4 หลัก<br>&nbsp;&nbsp;&nbsp; เราจะถึอว่า การตรวจสอบด้วย Pin Code ไม่ใช่ Use Case แต่จะถือเป็น Collaboration (การร่วมมือกัน) ของ Use Case “Validate” เนื่องจาก Check Pin Code ทำหน้าที่อธิบายรายละเอียดของ Use Case “Validate User” เรียกความสัมพันธ์นี้ว่า Realization<br>&nbsp;&nbsp;&nbsp; ใน UML ใช้สัญลักษณ์คือ เส้นตรงที่มีหัวศร และมี stereotype เป็น < realize > ลากจาก Class ที่ยัง Collaboration UML จะใช้วงรีที่มีชื่อ และเส้นขอบเป็นเส้นประแทน Collaboration</div>
													<hr width="800" size=3> <br>
<table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  <li><a href="les3-1.php">Previous</a></li>
  <li><a href="les3-1.php">1</a></li>
  <li><a href="les3-2.php">2</a></li>
  <li><a href="les3-3.php">3</a></li>
  <li><a href="les3-3.php">Next</a></li>
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
