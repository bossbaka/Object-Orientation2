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
<title>บทที่ 8</title>
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
<h1>บทที่ 8 Activity Design หน้าที่ 1</h1>
<p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; <strong>8.1 State และ Transition</strong><br>&nbsp;&nbsp;&nbsp; State chart Diagram เกิดจากการรวมกันอย่างมีระบบแบบแผนของ State และ Transition<br>&nbsp;&nbsp;&nbsp; <strong>State</strong><br>&nbsp;&nbsp;&nbsp; หมายถึง เงื่อนไขหรือสถานการณ์ที่เป็นอยู่ในขณะใดขณะหนึ่งที่ Object หนึ่งๆ มีตัวตนอยู่ ซึ่งในเงื่อนไขหรือสถานการณ์นั้น Object จะทำกิจกรรมบางอย่างหรือรอที่จะเกิดเหตุการณ์บางอย่างขึ้น Object หนึ่งๆ จะอยู่ใน State ใด State หนึ่ง ในช่วงเวลาหนึ่ง และจะเปลี่ยนไปสู่อีก State หนึ่ง<br>&nbsp;&nbsp;&nbsp; ตามปรกติ ทุกๆ State จะต้องมีชื่อ ซึ่งทำหน้าที่ระบุหรือแบ่งแยกให้ State หนึ่ง แตกต่างจาก State อื่นๆ โดยชื่อของ State ควรสื่อถึงความหมายของ State นั้นๆ<br>&nbsp;&nbsp;&nbsp; นอกจาก State ปกติแล้วยังมี State พิเศษอีก 2 ประเภท ที่ไม่จำเป็นต้องมีชื่อ นั่นคือ Initial State และ Final State หมายถึงจุดเริ่มต้นของกิจกรรมใน Object และจุดสิ้นสุดกิจกรรมใน Object <br>&nbsp;&nbsp;&nbsp; ในทาง UML จะใช้รูปสี่เหลี่ยมมุมมนที่มีชื่อกำกับ เป็นสัญลักษณ์แทน State ยกเว้น Initial State และ Final State โดยจะใช้รูปวงกลมทึบแทน Initial State ใช้รูปวงกลมทึบภายในวงกลมใสแทน Final State
													<br><center><img src="../pic/f42.jpg"></center><br>&nbsp;&nbsp;&nbsp; <strong>ตัวอย่าง 8.1</strong> ของ State, Initial State และ Final State และการเปลี่ยนแปลง State
													<br><center><img src="../pic/f43.jpg"></center><br>&nbsp;&nbsp;&nbsp; เป็นตัวอย่างของ State chart Diagram ที่แสดงการทำงานของหลอดไฟ โดยมีกฎว่า หลอดไฟทุกดวงจะเริ่มต้นที่สถานะปิดเสมอ ซึ่งเมื่อเราเปิดไฟ หลอดไฟจะเปลี่ยนสถานะจากสถานะปิด ไปสู่สถานะเปิด และเมื่อเราปิดไฟ หลอดไฟก็จะกลับไปสู่สถานะปิดอีกครั้งหนึ่ง และจะเป็นแบบนี้ไปเรื่อยๆ จนกว่า หลอดไฟจะเสีย จะทำให้หลอดไฟไม่ทำงานอีก จึงเปลี่ยนไปสู่ Final State <br>&nbsp;&nbsp;&nbsp;<strong>Transition</strong><br>&nbsp;&nbsp;&nbsp; เป็นความสัมพันธ์ระหว่าง State สอง State ซึ่งเป็นสิ่งที่บ่งชี้ว่า Object ที่อยู่ใน State หนึ่ง จะเปลี่ยนไปสู่อีก State หนึ่งด้วยเหตุการณ์หรือสาเหตุใด<br>&nbsp;&nbsp;&nbsp; Transition ประกอบขึ้นจากองค์ประกอบพื้นฐานต่างๆ ดังนี้<br>&nbsp;&nbsp;&nbsp; 1. Source State คือ State ของ object ก่อนที่จะได้รับผลจาก Transition<br>&nbsp;&nbsp;&nbsp; 2. Target State คือ State ของ object หลังจากเกิด Transition ขึ้นแล้ว<br>&nbsp;&nbsp;&nbsp; 3. Event Trigger คือ สิ่งที่ทำหน้าที่กระตุ้นให้เกิดการเปลี่ยน State<br>&nbsp;&nbsp;&nbsp; 4. Guard Condition เป็นเงื่อนไขที่ระบุว่า เมื่อใดหรือด้วยเงื่อนไขใดที่ Event Trigger หนึ่งๆ จะเกิดขึ้น<br>&nbsp;&nbsp;&nbsp; 5. Action คือ การประมวลผลที่เกิดขึ้นกับ Object ซึ่งเป็นผลมาจาก Transition หนึ่งๆ
													<br><strong>8.2 Statechart Diagram</strong><br>&nbsp;&nbsp;&nbsp; ในการออกแบบระบบ เมื่อต้องการอธิบายหรือออกแบบกิจกรรมภายใน Object แต่ละตัว จำเป็นต้องใช้องค์ประกอบของ State และ Transition เพื่ออธิบายองค์ประกอบเหล่านั้น ซึ่งการนำเอาองค์ประกอบของ State และ Transition ที่สอดคล้องกันมารวมไว้ในที่เดียวกัน เพื่ออธิบายกิจกรรมภายในของ Object หนึ่งๆ เรียกว่า Activity Design โดย UML Diagram ที่ใช้เพื่อการนำเสนอ Activity Design คือ Statechart Diagram<br><br>&nbsp;&nbsp;&nbsp; <strong>8.2.1 หลักการเลือก Object เพื่อสร้าง Statechart Diagram</strong><br>&nbsp;&nbsp;&nbsp; <strong>1. Object ที่ถูกเลือกอาจจะเป็น Object ของ Business Class หรือ Non Business Class ก็ได้ </strong> ขึ้นอยู่กับความเหมาะสม<br>&nbsp;&nbsp;&nbsp; <strong>2. เป็น Object ที่มี หรือน่าจะมี State จำนวนมาก</strong> เนื่องจาก Statechart Diagram จะช่วยให้ผู้พัฒนาไม่ลืม หรือตกหล่น State ใด State หนึ่งของ Object ดังกล่าว<br>&nbsp;&nbsp;&nbsp; <strong>3. เป็น Object ที่มี หรือน่าจะมีเงื่อนไขในการเปลี่ยน State ที่ซับซ้อน ไม่ตรงไปตรงมา</strong> เช่น เงื่อนไขมาก ต้องทดสอบเงื่อนไขหลายชั้น<br>&nbsp;&nbsp;&nbsp; <strong>4. เป็น Object ที่มีแบบแผนการเปลี่ยนแปลงของ State ที่แน่นอนตามตัว บ่งชี้ได้ชัดเจน</strong> คำว่า แบบแผน หมายถึง เมื่อ Object อยู่ State หนึ่งๆ เราต้องบอกได้ชัดเจนว่าจะเกิด Trigger แบบใดได้บ้าง เมื่อเกิดแล้วจะเปลี่ยนไปสู้ State ใด การบ่งชี้ต้องทำได้อย่างชัดเจน ไม่คลุมเครือ<br>&nbsp;&nbsp;&nbsp; <strong>5. เป็น Object ที่มีความสำคัญอย่างยิ่งต่อระบบ</strong><br><br>&nbsp;&nbsp;&nbsp; <strong>8.2.2 การสร้าง Statechart Diagram เบื้องต้น</strong><br>&nbsp;&nbsp;&nbsp; 1. ทุก Statechart Diagram ต้องมี Initial State เพียง State เดียวเสมอ<br>&nbsp;&nbsp;&nbsp; 2. Statechart Diagram อาจจะมี Final State หรือไม่มีก็ได้<br>&nbsp;&nbsp;&nbsp; 3. Statechart Diagram จะต้องมี Internal State อย่างน้อย 1 ตัวเสมอ<br>&nbsp;&nbsp;&nbsp; 4. อย่างน้อยที่สุด แต่ละ Internal State จะต้องมี Incoming Transition และ Outgoing Transition อย่างละ 1 Transition เสมอ<br>&nbsp;&nbsp;&nbsp; 5. จาก State หนึ่งไปยังอีก State หนึ่ง จะมี Transition ที่ถูกกำกับด้วย Trigger และ/หรือ Guarded Condition เดียวกันมากกว่า 1 Transition ไม่ได้โดยเด็ดขาด<br>&nbsp;&nbsp;&nbsp; 6. ณ State ใดๆ จะมี Outgoing Transition ที่ถูกกำกับด้วย Trigger และ/หรือ Guarded Condition เดียวกันมากกว่า 1 Transition ไม่ได้โดยเด็ดขาด<br>&nbsp;&nbsp;&nbsp; 7. ณ State ใดๆ จะมี Outgoing Transition ที่ถูกกำกับด้วย Trigger และ/หรือ Guarded Condition แบบใดแบบหนึ่งพร้อมๆ กับที่มี Outgoing Transition ที่เป็น Triggerless Transitionไม่ได้เด็ดขาด
													</div>
													<hr width="800" size=3> <br>
<table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  
  <li><a href="les8-1.php">1</a></li>
  <li><a href="les8-2.php">2</a></li>
  <li><a href="les8-2.php">Next</a></li>
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
