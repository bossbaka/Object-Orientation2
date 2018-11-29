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
<h1>บทที่ 3 Use Case Modeling หน้าที่ 3</h1>
<p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; <strong>3.3 การใช้ Use Case เพื่อการวิเคราะห์ระบบ</strong><br>&nbsp;&nbsp;&nbsp; การวิเคราะห์ระบบสิ่งแรกที่ต้องดำเนินการคือ การอธิบายภาพรวมของระบบโดยการวางขอบเขตของระบบการพิจารณาหาผู้มีส่วนเกี่ยวข้องกับระบบ (actor) การพิจารณาหาระบบย่อยต่างๆ (Use Cases) ที่ควรมีในระบบ การหาความสัมพันธ์ระหว่าง Use Case กับ Actor หรือ Use Case ด้วยกันเอง หรือ Actor ด้วยกันเอง<br>&nbsp;&nbsp;&nbsp; การสร้าง Use Case Diagram มีขั้นตอนต่างๆแบ่งเป็น 2 แนวทาง การสร้าง System Context Model และ System Requirement Model<br>&nbsp;&nbsp;&nbsp; <strong>3.3.1 การสร้าง System Context Model</strong><br>&nbsp;&nbsp;&nbsp; เป็นการวิเคราะห์หาขอบเขตของ Model การวิเคราะห์เพื่อหา Actor และ Use Case ที่ควรมีในระบบ มีขั้นตอนดังนี้<br>&nbsp;&nbsp;&nbsp; 1. หา Actor ทั้งหมดที่ควรมี ซึ่งอยู่ภายนอกขอบเขตของระบบ<br>&nbsp;&nbsp;&nbsp; 2. ค้นหาและจำลองความสัมพันธ์เชิง Generalization/Specialization  ของ actor (ถ้ามี)<br>&nbsp;&nbsp;&nbsp; 3. หา Use Case ที่มีความสัมพันธ์กับ Actor <br>&nbsp;&nbsp;&nbsp; 4. ต้องไม่มี Actor ตัวใดที่ไม่มีความสัมพันธ์กับ Use Case ยกเว้น actor ที่เป็น subclass<br>&nbsp;&nbsp;&nbsp; 5. ต้องไม่มี Use Case ตัวใดที่ไม่มีความสัมพันธ์กับ Actor ตัวใด<br>&nbsp;&nbsp;&nbsp; <strong>3.3.2 System Requirement Model</strong><br>&nbsp;&nbsp;&nbsp; จะเกี่ยวข้องกับการพิจารณาถึงงานหรือหน้าที่ที่ระบบควรต้องทำและความสัมพันธ์ระหว่าง Use Case โดยพิจารณาจากมุมมองของ actor<br>&nbsp;&nbsp;&nbsp; 1. สร้าง System Context Model<br>&nbsp;&nbsp;&nbsp; 2. ค้นหาและจำลองระหว่าง Use Case ที่อยู่ในรูปของ Context Model ที่เรียกว่า Drafted Requirement Model<br>&nbsp;&nbsp;&nbsp; 3. เพิ่มเติม Use Case ใหม่ๆ เข้าไปยัง Drafted ที่มีอยู่<br>&nbsp;&nbsp;&nbsp; 4. หากมีความจำเป็นต้องอธิบายหรือระบุความจำเพาะเจาะจงของ Use Case สามารถใช้ Realization เพื่อสร้าง Collaboration<br>&nbsp;&nbsp;&nbsp; 5.ต้องไม่มี Actor ตัวใดที่ไม่มีความสัมพันธ์กับ Use Case ยกเว้น actor ที่เป็น subclass<br>&nbsp;&nbsp;&nbsp; 6. ต้องไม่มี Use Case ตัวใดที่ไม่มีความสัมพันธ์กับ Actor ตัวใด
													<br><strong>3.4 กรณีศึกษา Book Store Service System</strong><br>&nbsp;&nbsp;&nbsp; บริการหลักของระบบ คือ การให้บริการยืมหนังสือและขายหนังสือให้แก่ลูกค้า โดยลูกค้าแบ่งออกเป็น 2 ประเภท คือ สมาชิกและลูกค้าทั่วไป โดยสมาชิกซื้อและยืมหนังสือได้ แต่ลูกค้าทั่วไปจะยืมไม่ได้ หนังสือแต่ละเล่มจะมีกำหนดเวลายืมที่แน่นอน หากสมาชิกยืมหนังสือเกินเวลา จะต้องจ่ายค่าปรับ หนังสือแต่ละเล่มจะมีกำหนดเวลาในการยืมและอัตราค่าปรับที่แต่ต่างตามประเภทหนังสือ เป็นหน้าที่ของพนักงานให้บริการคำนวณค่าปรับ ระบบต้องสามารถจัดการการซื้อหนังสือ โดยแบ่งหนังสือออกเป็น 2 ประเภท คือ หนังสือในประเทศและหนังสือจากต่างประเทศ<br>&nbsp;&nbsp;&nbsp; <strong>3.4.1 System Context Model</strong> <br>&nbsp;&nbsp;&nbsp; 1. Actor ของระบบ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - ลูกค้า จำแนกเป็น ลูกค้าทั่วไป และสมาชิก<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - พนักงานบริการ<br>&nbsp;&nbsp;&nbsp; 2. Use Case ที่สัมพันธ์โดยตรงกับ Customer<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - การซื้อหนังสือ<br>&nbsp;&nbsp;&nbsp; 3. Use Case ที่สัมพันธ์โดยตรงกับ Member<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - การยืมหนังสือ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - การคืนหนังสือ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - การจ่ายค่าปรับ<br>&nbsp;&nbsp;&nbsp; 4. Use Case ที่สัมพันธ์โดยตรงกับ Officer<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - การคำนวณค่าปรับ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - การสั่งซื้อหนังสือ
													<br><center><img src="../pic/f23.jpg"></center><br>&nbsp;&nbsp;&nbsp; <strong>3.4.2 System Requirement Model</strong><br>&nbsp;&nbsp;&nbsp; 1. เพิ่มความสัมพันธ์ระหว่าง Use Case ใน System Context Model<br>&nbsp;&nbsp;&nbsp; 2. เพิ่มเติม Child Use Case<br>&nbsp;&nbsp;&nbsp; 3. เพิ่มเติม Extending Use Case
													</div>
													<hr width="800" size=3> <br>
<table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  <li><a href="les3-2.php">Previous</a></li>
  <li><a href="les3-1.php">1</a></li>
  <li><a href="les3-2.php">2</a></li>
  <li><a href="les3-3.php">3</a></li>
  
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
