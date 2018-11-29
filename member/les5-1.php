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
<title>บทที่ 5</title>
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
<h1>บทที่ 5 Interaction Modeling หน้าที่ 1</h1>
<p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; <strong>5.1 องค์ประกอบของ Interaction Diagram</strong><br>&nbsp;&nbsp;&nbsp; <strong>5.1.1 Object</strong><br>&nbsp;&nbsp;&nbsp; Object เป็นองค์ประกอบแรกของ Interaction Diagram ซึ่ง Object จะทำหน้าที่ในการส่ง Message ไปยัง Object ตัวอื่นๆ และทำหน้าที่ในการดำเนินการตาม Message ที่ถูกร้องขอจาก Object ตัวอื่น ผู้ส่ง Message จะเรียกว่า Sender Object ที่เป็นผู้รับ Message และดำเนินการตาม Message เรียกว่า Receiver <br>&nbsp;&nbsp;&nbsp; ข้อพึงระวังในการเขียน Interaction Diagram คือ ห้ามมี Class ปรากฏอยู่ใน Interaction Diagram โดยเด็ดขาด สิ่งที่อยู่ได้มีเพียง Object เท่านั้น ทั้งนี้เพราะ Class ไม่สามารถดำเนินกิจกรรมใดๆ มีเพียง Object ของ Class เท่านั้นที่สามารถดำเนินกิจกรรมได้ Object ที่มีส่วนร่วมอยู่ใน Interaction Diagram แบ่งออกเป็น 2 ประเภทคือ<br>&nbsp;&nbsp;&nbsp; <strong>1. Concrete Object</strong> หมายถึง Object ที่มีส่วนร่วมอยู่ใน Interaction Diagram ที่สามารถระบุ Unique Identity ของ Object นั้นได้ เช่น Computer A ที่ตั้งอยู่ในห้อง 123 ของอาคาร 1 ของโรงเรียนเทศบาล 2<br>&nbsp;&nbsp;&nbsp; <strong>2. Prototypical Object</strong> หมายถึง Object ที่มีส่วนร่วมอยู่ใน Interaction Diagram ที่ยังไม่สามารถระบุ Unique Identity  นั้นได้อย่างแน่นอนตายตัว เช่น Object ของ Class Computer<br>&nbsp;&nbsp;&nbsp; ในทาง UML จะใช้สัญลักษณ์สี่เหลี่ยม ในการอธิบาย Name และ Type แทน Object ที่มีส่วนร่วมใน Interaction Diagram โดยให้เขียนอธิบายในรูปแบบ ดังนี้<br>&nbsp;&nbsp;&nbsp; <strong>ชื่อ Object : ชื่อ Class		ในกรณีที่เป็น Concrete Object</strong><br>&nbsp;&nbsp;&nbsp; <strong>ชื่อ Class			ในกรณีที่เป็น Prototypical Object</strong>
													<br><center><img src="../pic/f26.jpg"></center><br>&nbsp;&nbsp;&nbsp; <strong>5.1.2 Links</strong><br>&nbsp;&nbsp;&nbsp; หมายถึง สิ่งที่เชื่อมโยง Objects ตัวเข้าด้วยกัน เรามักจะกล่าวถึง Links ในแง่ที่เกี่ยวข้องกับ Association ระหว่าง Class คือ เมื่อ Class 2 Class มีความสัมพันธ์กันแบบ Association แล้ว Object ของ Class ทั้ง 2 ก็น่าจะมี Link เชื่อมระหว่างกันเสมอ โดย Link จะทำหน้าที่เป็นสื่อกลางหรือทางเดินของ Message ที่ส่งและรับกันระหว่าง Object สองตัว<br>&nbsp;&nbsp;&nbsp; ในทาง UML จะใช้สัญลักษณ์เส้นตรงที่ลากจาก Object หนึ่งไปยังอีก Object หนึ่งเพื่อแทน Link
													<br><center><img src="../pic/f27.jpg"></center><br>&nbsp;&nbsp;&nbsp; <strong>5.1.3 Message</strong><br>&nbsp;&nbsp;&nbsp; ใน Interaction Diagram จะเรียกการสื่อสารระหว่าง Object สองตัวว่า Message การสื่อสาร หมายถึง การที่ Sender เรียกใช้ Method ใด Method หนึ่งของ Receiver<br>&nbsp;&nbsp;&nbsp;  Message แบ่งออกเป็น 5 ประเภท ได้แก่<br>&nbsp;&nbsp;&nbsp; <strong>1. Call</strong> หมายถึง Message ที่ Sender ใช้เรียก Method ของ Receiver<br>&nbsp;&nbsp;&nbsp; <strong>2. Return</strong> หมายถึง Message ที่ใช้เพื่อส่งข้อมูลที่ถูกร้องขอโดย Sender จาก Receiver กลับไปยัง Sender<br>&nbsp;&nbsp;&nbsp; <strong>3. Send</strong> หมายถึง สัญญาณบางอย่างที่ Object ตัวหนึ่งส่งไปเพื่อบอกหรือกระตุ้น Object อีกตัวหนึ่ง โดยไม่ใช่ การเรียกใช้ Method ของ Object ที่ถูกกระตุ้น<br>&nbsp;&nbsp;&nbsp; <strong>4. Create</strong> หมายถึง Message ที่ Object ตัวหนึ่งส่งไปโดยมีจุดประสงค์เพื่อให้เกิดการสร้าง Object ของ Class ขึ้น<br>&nbsp;&nbsp;&nbsp; <strong>5. Destroy</strong> หมายถึง Message ที่ Object ตัวหนึ่ง ส่งไปยัง Object อีกตัวหนึ่ง เพื่อให้ Object ที่ได้รับ Message ทำลายตัวเอง
													<br><center><img src="../pic/f28.jpg"></center><br>&nbsp;&nbsp;&nbsp; <strong>5.1.4 Sequencing</strong><br>&nbsp;&nbsp;&nbsp; กิจกรรมหนึ่งๆ ของระบบมักจะเกิดจาก Object หลายๆ ตัวส่ง Message ผ่านทาง Link ระหว่าง Object  ซึ่งเมื่อมีหลายๆ Message รวมอยู่ ผู้ที่อ่านอาจจะเกิดความสับสน หากไม่มีการกำหนดว่า Message หนึ่งๆ จะเกิดขึ้นก่อนหรือหลัง Message ใด ดังนั้นกลไกหนึ่งที่ Interaction Diagram จะต้องมีก็คือ การกำหนดลำดับการเกิดขึ้นของ Message เรียกว่า Sequencing
													<br><center><img src="../pic/f29.jpg"></center><br><strong>5.2 Sequence Diagram</strong><br>&nbsp;&nbsp;&nbsp; Sequence Diagram เป็น Diagram ที่ประกอบไปด้วย Class หรือ Object มีเส้นที่ใช้เพื่อแสดงลำดับเวลา และเส้นที่ใช้แสดงกิจกรรมที่เกิดขึ้นจาก Object หรือ Class ใน Diagram<br>&nbsp;&nbsp;&nbsp; ภายใน Sequence Diagram จะใช้สี่เหลี่ยมแทน Class หรือ Object ซึ่งภายในกรอบสี่เหลี่ยม จะชื่อของ Object หรือ Class ประกอบด้วย ในรูปแบบ {Object}:Class สัญลักษณ์ {Object} หมายถึง จะมีหรือไม่มี Object ระบุก็ได้
														</div>
													<hr width="800" size=3> <br>
<table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">

  <li><a href="les5-1.php">1</a></li>
  <li><a href="les5-2.php">2</a></li>
  <li><a href="les5-3.php">3</a></li>
  <li><a href="les5-2.php">Next</a></li>
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
