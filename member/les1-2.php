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
<title>บทที่ 1</title>
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


<div class="textbox"><h1>บทที่ 1 Object Orientation และ UML หน้าที่ 2</h1>
 <p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; <strong>1.2 Objects และ Classes (ที่มาของ Object Orientation)</strong><br>&nbsp;&nbsp;&nbsp; <strong>1.2.1 Concept</strong> หมายถึง ความคิดรวบยอดที่เรามีให้กับวัตถุนั้นๆ ภายใต้กรอบที่กำหนด (Domain) ตัวอย่างเช่น Concept กับรถยนต์ นั่นคือ รถทุกคันมีตัวถัง มีล้อ และเครื่องยนต์เหมือนกันทุกคัน, Concept กับคน นั่นคือคนทุกคน (คนโดยปกติ) มี 2 แขน 2 ขา 1 ศีรษะ และมีภาษาพูด<br>&nbsp;&nbsp;&nbsp; <strong>1.2.2 Class</strong><br>&nbsp;&nbsp;&nbsp; ผลจากการให้ Concept กับ Objects นั้นทำให้เกิดการจัดกลุ่มของ Objects ขึ้น ซึ่งกลุ่มของ Objects ที่ได้จากกระบวนการนี้เรียกว่า Abstract Objects หรือเรียกอีกหนึ่งว่า Class ตัวอย่างเช่น<br>&nbsp;&nbsp;&nbsp; รถยนต์ฮอนด้า รถยนต์โตโยต้า และรถยนต์มาสด้า ต่างก็มี 4 ล้อ มีเครื่องยนต์ และใช้น้ำมันเป็นเชื้อเพลิงเหมือนๆ กัน ซึ่งสามารถจัดให้รถทั้งสามนี้อยู่ในคลาส “รถยนต์” แต่เราไม่สามารถจัดเอารถเข็น และรถมอเตอร์ไซค์เข้าไว้ในคลาสรถยนต์ได้ เพราะรถเข็นไม่ได้ใช้น้ำมันเป็นเชื้อเพลิง ในขณะที่รถมอเตอร์ไซค์ไม่ได้มี 4 ล้อ ซึ่ง Concept ที่กล่าวมาของรถทั้งสองนั้นไม่ตรงกับ Concept ของคลาส รถยนต์<br>&nbsp;&nbsp;&nbsp; <strong>ตัวอย่าง 1.2</strong> ถ้าพูดว่า รถวิ่งไปบนถนน ในโลกของ Object Orientation นั้น ถือว่าไม่ได้เป็นเหตุการณ์ที่เกิดขึ้นจริงๆ เพราะคำว่า “รถ” จะหมายถึง “แนวความคิด ของการรวมเอาตัวถังรถ ล้อ และเครื่องยนต์มารวมกัน” และ “ถนน” ก็จะหมายถึง “แนวความคิด ของสิ่งหนึ่งซึ่งอยู่บนพื้นโลก ที่ทำไว้เพื่อให้ยานพาหนะทางบกวิ่งไปได้” แต่ถ้าพูดว่า รถยนต์ของนาย ก วิ่งไปบนถนนมิตรภาพ นั่นหมายถึงรถของนาย ก ซึ่งมีอยู่จริงในโลก (และสามารถจับต้องได้) และเป็น Object ของ Class “รถยนต์” วิ่งไปบนถนนมิตรภาพ ซึ่งเป็น Object ของ Class “ถนน”<br>&nbsp;&nbsp;&nbsp; เมื่อพูดว่า “สมชาย แต่งงานกับ สมหญิง” จะหมายถึง สมชายเป็น Object ของ Class ผู้ชายแต่งงานกับ สมหญิง ที่เป็น Object ของ Class ผู้หญิง<br>&nbsp;&nbsp;&nbsp; 	จากตัวอย่างที่ผ่านมา จะเห็นว่า Class ต่างๆ ทั้งหมดใน Domain ที่เราสนใจ คือสิ่งที่อยู่ในความคิดของเราซึ่งไม่สามารถทำกิจกรรมใดๆ ให้เกิดขึ้นจริงได้ แต่ถ้าเราต้องการให้เกิดกิจกรรมขึ้นในระบบคอมพิวเตอร์ของเรา เราต้องสร้าง Object ของ Class ต่างๆ ขึ้นในคอมพิวเตอร์ของเราเสียก่อน เพื่อให้ Object นั้นๆ สามารถทำงานและดำเนินบทบาทของมันเองได้ ซึ่งหากเราจะเทียบกับแนวทางการพัฒนาโปรแกรมแบบเดิม (Traditional System Analysis and Design) แล้ว Class จะคล้ายคลึง (แต่ไม่เหมือน) กับชนิดของตัวแปร และ Object จะคล้ายคลึง (แต่ไม่เหมือน) กับตัวแปร<br>&nbsp;&nbsp;&nbsp; <strong>1.2.3 Abstraction & Instantiation</strong><br>&nbsp;&nbsp;&nbsp; เราเรียกกระบวนการในการให้ Concept กับ Object จนเกิดเป็น Class ว่า Abstraction และเรียกกระบวนการของการทำให้เกิด Object จาก Class ที่เราสร้างขึ้นว่า Instantiation ซึ่งบางครั้ง มีหนังสือบางเล่มจะเรียก Object ที่เกิดขึ้นในคอมพิวเตอร์ว่า Instance เพราะเป็น Objects ที่เกิดจากกระบวนการ Instantiation
													<br><strong>1.3 Attributes และ Functions</strong><br>&nbsp;&nbsp;&nbsp; Attribute เป็นคุณสมบัติของ Object ต่างๆ โดยที่คุณสมบัติดังกล่าวนี้เป็นคุณสมบัติ	ที่เราสนใจหรืออยู่ใน Domain ที่เราสนใจ เช่น สีและจำนวนประตูของรถคัน หนึ่ง หรืออาจจะเป็น สีผิวและเพศของคน ๆ หนึ่ง เป็นต้น คุณสมบัตินี้ 	เรียกว่า 	Attributes<br>&nbsp;&nbsp;&nbsp; Function ในทาง Object Orientation นั้น Objects เป็นได้มากกว่าสิ่งที่มี Attributes เพราะ Objects สามารถทำให้เกิดกิจกรรมต่างๆ ได้ ซึ่งเราเรียกว่า Function<br>&nbsp;&nbsp;&nbsp; Function หมายถึง ความสามารถในการทำกิจกรรมของ Object ที่มีไว้เพื่อให้ Object อื่นๆ ใน Domain สามารถเรียกใช้ หรือกระตุ้นให้เกิดได้
													<br><strong>1.4 Object-Oriented Software Engineering (OOSE)</strong><br>&nbsp;&nbsp;&nbsp; ได้เรียนรู้แนวความคิดโดยรวมของ Object Orientation ไปแล้ว ซึ่งสามารถนำเอาความคิดนี้ มาใช้กับการวิเคราะห์และออกแบบระบบคอมพิวเตอร์ได้ ซึ่งเราเรียกว่า Object Oriented Analysis and Design (OOAD)<br>&nbsp;&nbsp;&nbsp; แต่การพัฒนาระบบคอมพิวเตอร์นั้นกินความถึงการวิเคราะห์ ออกแบบ การพัฒนาโปรแกรม และการนำไปใช้ เราจะเรียกการพัฒนาระบบคอมพิวเตอร์ด้วยหลักการ Object Orientation ว่า Object-Oriented Software Engineering (OOSE)<br>&nbsp;&nbsp;&nbsp; OOSE ประกอบด้วย 3 ขั้นตอน คือ<br>&nbsp;&nbsp;&nbsp; 1. Object-Oriented Analysis (OOA) เป็นขั้นตอนการวิเคราะห์ เพื่อให้ทราบว่า Problem Domain คืออะไร และเพื่อทำความเข้าใจในรายละเอียดของปัญหาเหล่านั้น เป็นการหาคำตอบให้กับคำถามที่ว่า “What is the Problem to be Solved?”<br>&nbsp;&nbsp;&nbsp; 2. Object-Oriented Design (OOD) เป็นขั้นตอนการออกแบบหรือจำลอง (Model) วิธีการเพื่อแก้ปัญหาใน Problem Domain ซึ่งเป็นการหาคำตอบให้กับคำถามที่ว่า “How to Solve the Problem?”<br>&nbsp;&nbsp;&nbsp; 3. Object-Oriented Implementation หรือ Object-Oriented Programming (OOP) เป็นขั้นตอนการสร้างหนทางแก้ปัญหาในรายละเอียดให้เกิดขึ้นและใช้งานได้จริง เป็นการตอบคำถามที่ว่า “How to Implement the Solution?"</div>
													<hr width="800" size=3>
 <br>	                                                   
 <table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  <li><a href="les1-1.php">Previous</a></li>
  <li><a href="les1-1.php">1</a></li>
  <li><a href="les1-2.php">2</a></li>
 
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
