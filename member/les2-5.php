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
<h1>บทที่ 2 Abstractions หน้าที่ 5</h1>
<p>&nbsp;</p>
													&nbsp;&nbsp;&nbsp; <strong>2.5.2 Composition</strong><br>&nbsp;&nbsp;&nbsp; จากตัวอย่างที่ผ่านมาพบว่า Aggregation ของ Classroom ที่มีต่อ Student, Teacher และ TeachingMaterial กับ Aggregation ของ Building ที่มีผลต่อ Classroom มีความแตกต่างกัน คือ ถ้า Classroom ไม่มีอยู่ และนักเรียนไม่ได้อยู่ใน Classroom<br>&nbsp;&nbsp;&nbsp; นักเรียนก็ยังคงสภาพความเป็นนักเรียน ไม่ได้สูญหายไปไหน การดำรงอยู่ของ Classroom ไม่มีอิทธิพลต่อการดำรงอยู่ของ Student<br>&nbsp;&nbsp;&nbsp; แต่ใน Aggregation ของ Building ที่มีผลต่อ Classroom นั้น Classroom จะมีอยู่ได้ต้องอาศัยการมีอยู่ของ Builder เสมอ ถ้า Builder ไม่ดำรงอยู่ Classroom ก็จะไม่ได้ดำรงอยู่เช่นเดียวกัน การดำรงอยู่ของ Builder มีอิทธิพลต่อการดำรงอยู่ของ Classroom ซึ่ง Aggregation ในลักษณะนี้ เป็น Aggregation ประเภทพิเศษ เรียกว่า Composition<br>&nbsp;&nbsp;&nbsp; <strong>ตัวอย่าง 2.6 </strong>หนังสือ ประกอบด้วย สองปก คือ ปกหน้าและปกหลัง หนึ่งคำนำ หนึ่งสารบัญ และเนื้อหาบทต่างๆ 
													<br><center><img src="../pic/f15.jpg"></center><br><strong>2.6 Generalization Abstraction</strong><br>&nbsp;&nbsp;&nbsp; Abstraction ใช้จำลองความสัมพันธ์ระหว่าง Class  ที่อยู่ในระนาบเดียวกันและความสัมพันธ์ที่ต่างระนาบ เราได้รู้จักกับวิธีการสร้าง Class จาก Object ที่มีอยู่ และวิธีการสร้างความสัมพันธ์ระหว่าง Class ในเชิงที่ Class หนึ่งเป็นส่วนประกอบของอีก Class หนึ่ง ลองพิจารณาความสัมพันธ์ของ Class 2 Class ในบางกรณี เช่น “แมลงจำแนกเป็นแมลงบินและแมลงคลาน” จะพบว่า Aggregation Abstraction ไม่สามารถอธิบายความสัมพันธ์นี้ได้ เพราะแมลง ไม่ได้ประกอบด้วย แมลงบินและแมลงคลาน แต่แมลง จำแนกเป็น แมลงบินและแมลงคลาน ดังนั้นจึงมี Abstraction ใหม่ที่สามารถอธิบายความสัมพันธ์เชิง “จำแนกเป็น”<br>&nbsp;&nbsp;&nbsp; พิจารณาจากความเป็นจริงในโลก จะเห็นว่า สิ่งของหรือสิ่งมีชีวิตหลายๆ ชนิด เกิดจากการเพิ่มเติมคุณสมบัติพิเศษเข้าไป หรือบางสิ่งอาจจะเกิดจากการตัดทอนหรือละเลยคุณสมบัติบางอย่างออก เช่น รถสปอร์ต เกิดจากการเพิ่มระบบ Turbo และตัวถังแบบพิเศษเข้าไปในรถปรกติ ทำให้วิ่งเร็วขึ้น สัตว์บกและสัตว์น้ำ มีคุณสมบัติที่เหมือนกัน คือ มีชีวิต มีการเคลื่อนไหว เมื่อไม่คำนึงว่า สัตว์บกต้องอยู่บนบก และ สัตว์น้ำต้องอยู่ในน้ำ จะได้ Concept ใหม่ขึ้นมา เป็น Concept ร่วมของสัตว์บกและสัตว์น้ำ นั่นก็คือ Concept ของสัตว์<br>&nbsp;&nbsp;&nbsp; เราสามารถพิจารณาคุณสมบัติพิเศษ หรือละเลยคุณสมบัติพิเศษที่มีอยู่ใน Class ต่างๆ เพื่อทำให้เกิด concept ใหม่ ซึ่งมี concept เปลี่ยนไปจากเดิม เรียกว่า Generalization Abstraction<br>&nbsp;&nbsp;&nbsp; การให้ Concept ใหม่กับ Class หนึ่ง โดยละเลยหรือตัดคุณสมบัติพิเศษบางอย่างออกไป ทำให้ Class ดังกล่าวมีคุณสมบัติเป็นสามัญ (General ) เรียกว่า Generalize การให้ Concept ใหม่กับ Class หนึ่งที่มีอยู่แล้ว โดยพิจารณาเพิ่มเติมคุณสมบัติใหม่ๆ ให้ Class มีลักษณะพิเศษเพิ่มขึ้นเรียกว่า Specialize
													<br><center><img src="../pic/f16.jpg"></center><br>&nbsp;&nbsp;&nbsp; การทำ Specialize เกิดจากการเพิ่มคุณลักษณะพิเศษบางอย่างให้กับ Class เดิมเพื่อให้เกิด Class ใหม่ที่พิเศษกว่า Class เดิม (SuperClass) ส่วน Class ที่เกิดจากการทำ Specialize เรียกว่า SubClass ในทาง OO นิยมเรียกกระบวนการ Specialize ว่า Inheritance<br>&nbsp;&nbsp;&nbsp; <strong>2.6.1 การอธิบาย Generalization ด้วย UML</strong><br>&nbsp;&nbsp;&nbsp; ใช้สัญลักษณ์เส้นตรงมีหัวลูกศรสามเหลี่ยมใส ลากเชื่อมระหว่าง SuperClass และ SubClass โดยให้หัวลูกศรชี้ไปทาง SuperClass
													<br><center><img src="../pic/f17.jpg"></center><br>&nbsp;&nbsp;&nbsp; <strong>2.6.2 Inheritance และ Visibility</strong><br>&nbsp;&nbsp;&nbsp; การทำ inheritance นั้นมีผลโดยตรงต่อ Visibility ของ Attribute/Methods ที่ถูกถ่ายทอดจาก SuperClass ไปยัง SubClass ก่อให้เกิดกฎการถ่ายทอด ดังนี้<br>&nbsp;&nbsp;&nbsp; 1. Public Attribute/Function จะถ่ายทอดมาเป็น Public ของ SubClass เสมอ<br>&nbsp;&nbsp;&nbsp; 2. Private Attribute/Function จะถ่ายทอดมาเป็น private ของ SubClass  แต่ไม่สามารถเข้าถึงได้โดย Function ที่มีอยู่ใน SubClass<br>&nbsp;&nbsp;&nbsp; 3. Protected Attribute/Function จะถ่ายทอดมาเป็น Protected ของ SubClass การเข้าถึง Attribute หรือ Function ทำได้โดยผ่าน Function ใดๆ ของ SubClass  โดยไม่คำนึงถึงว่า Function นั้น ได้มาจากการ inherit หรือไม่<br>&nbsp;&nbsp;&nbsp; <strong>2.6.3 Multiple Inheritance</strong><br>&nbsp;&nbsp;&nbsp; การทำ Inherit จาก SuperClass ที่มากกว่า 1 ตัว เพื่อให้ได้ SuperClass ที่มีคุณสมบัติพิเศษเพียงตัวเดียวหรือมากกว่า เรียกว่า  Multiple Inheritance<br>&nbsp;&nbsp;&nbsp; <strong>2.6.4 Polymorphism</strong><br>&nbsp;&nbsp;&nbsp; ในการทำ Inheritance บางกรณี เช่น Class รถตีนตะขาบ เกิดจากการ Inherit จาก Class รถยนต์ ซึ่ง Class รถตีนตะขาบได้รับการสืบทอดจาก Class รถยนต์ ได้แก่ วิ่งเดินหน้า วิ่งถอยหลัง และเลี้ยว วิ่งไปข้างหน้าและถอยหลัง รถตีนตะขาบและรถยนต์ ทำงานเหมือนกัน แต่การเลี้ยว ทำงานต่างกัน เพราะรถยนต์ให้พวงมาลัยในการเลี้ยว แต่รถตีนตะขาบใช้การหยุดล้อข้างที่เลี้ยว
													<br><strong>2.7 Modularity</strong><br>&nbsp;&nbsp;&nbsp; การให้หลักการต่างๆ ที่เกี่ยวข้องกับ Abstraction แต่ละประเภทรวมทั้ง Encapsulation ทำให้พิจารณาและจำลองสิ่งต่างๆ รอบตัวเราอยู่ในรูปของหน่วยย่อยที่สามารถจัดการง่าย มีคุณสมบัติ มีความสามารถดำเนินกิจกรรม และมีขอบเขตหน่วยย่อยดังกล่าว คือ Object<br>&nbsp;&nbsp;&nbsp; หลักการที่พิจารณาปัญหาที่มีอยู่ทั้งหมดให้อยู่ในรูปของหน่วยย่อย ที่มีอิสระในตัวเอง และการหาความสัมพันธ์ระหว่างหน่วยย่อย เรียกว่า Modularity<br>&nbsp;&nbsp;&nbsp; Modularity ทำให้ปัญหาที่มีขนาดใหญ่ ได้ถูกแยกแยะออกเป็นปัญหาเล็ก ที่มีความสัมพันธ์กัน การทำความเข้าใจและจัดการกับปัญหาเล็กๆ เหล่านั้น ย่อมทำได้ง่ายกว่าการทำความเข้าใจและจัดการปัญหาใหญ่ทั้งหมด
</div>
													<hr width="800" size=3> <br>
<table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  <li><a href="les2-4.php">Previous</a></li>
  <li><a href="les2-1.php">1</a></li>
  <li><a href="les2-2.php">2</a></li>
  <li><a href="les2-3.php">3</a></li>
  <li><a href="les2-4.php">4</a></li>
  <li><a href="les2-5.php">5</a></li>
  
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
