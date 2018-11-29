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
<title>บทที่ 10</title>

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


<div class="textbox"><h1>บทที่ 10 สรุป</h1><br>
&nbsp;&nbsp;&nbsp; <strong>Object Orientation คืออะไร</strong><br>&nbsp;&nbsp;&nbsp; ในชีวิตประจำวัน เมื่อมองดูรอบๆ ตัวจะพบเห็นวัตถุ (Object) ต่างๆ มากมาย ไม่ว่าจะเป็นวัตถุที่สามารถมองเห็นได้และจับต้องได้ (Tangible Objects) เช่น โต๊ะ รถยนต์ คอมพิวเตอร์ หรือแม้แต่ตัวของเราเองเป็นต้น และวัตถุที่มีอยู่จริงแต่ไม่สามารถจับต้องได้ (Intangible Objects) ตัวอย่างเช่น กฎหมาย (กฎข้อบังคับที่รัฐบัญญัติขึ้น) เวลา หรือความรู้ต่างๆ เป็นต้น<br>&nbsp;&nbsp;&nbsp; ในโลกของเรามี Objects ต่างๆ มากมาย สิ่งที่เกิดขึ้นจาก Objects ต่างๆ ก็คือ กิจกรรม (Activities) ความเคลื่อนไหว (Movement) หรือการกระทำ (Actions) เช่น คนรับประทานอาหาร สุนัขเล่นกับแมว เป็นต้น<br><br>

&nbsp;&nbsp;&nbsp;<strong>Abstractions</strong><br>&nbsp;&nbsp;&nbsp; เราได้รู้จักกับ Class (เรียกอีกอย่างหนึ่งว่า Abstract Data Type) ซึ่งหมายถึงกลุ่มของ Objects ที่มีความเหมือนหรือคล้ายคลึงกันในแง่ใดแง่หนึ่ง หรือในหลายๆ แง่ โดยสิ่งที่ใช้ในการกำหนดความเหมือนหรือคล้ายคลึงดังกล่าวนั้นก็คือ Concept นั่นเอง เราสามารถบอกได้ว่า Object ใน Class เดียวกัน ล้วนแล้วแต่มี Concept เดียวกัน โดยขึ้นอยู่กับ Domain ที่เรากำหนด<br><br>

&nbsp;&nbsp;&nbsp;<strong>Use Cases, Actors, Scenario และ Use Case Diagram</strong><br>&nbsp;&nbsp;&nbsp; Subsystem ต่างๆ มักมีปฏิสัมพันธ์กับสิ่งอื่นๆ 2 รูปแบบ<br>&nbsp;&nbsp;&nbsp; 1. ปฏิสัมพันธ์กับคน หรือกลไกอื่น ภายนอกระบบ<br>&nbsp;&nbsp;&nbsp; 2. ปฏิสัมพันธ์กับ Subsystem ในระบบ<br>&nbsp;&nbsp;&nbsp; หรือทั้ง 2 รูปแบบพร้อมๆ กัน ในการแยกแยะว่าสิ่งใดอยู่นอกหรืออยู่ในระบบ ขอให้ใช้บรรทัดฐานนี้<br>&nbsp;&nbsp;&nbsp; 1. สิ่งที่ทำหน้าที่ดำเนินกิจกรรมของระบบ หรือทำให้เกิดผลลัพธ์ต่างๆ ขึ้นในระบบ ให้ถือว่าสิ่งนั้นอยู่ในระบบ<br>&nbsp;&nbsp;&nbsp; 2. สิ่งที่ไม่ได้ทีหน้าที่ในการดำเนินกิจกรรมของระบบ แต่แสดงบทบาทเป็นผู้คาดหวังผลลัพธ์จากระบบ หรือทำหน้าที่ผลักดันให้เกิดกิจกรรมของระบบ หรอืทำหน้าที่ควบคุมดูแลกิจกรรมของระบบ ให้ถือว่าสิ่งนั้นอยู่ภายนอกระบบ<br>


<br>
&nbsp;&nbsp;&nbsp; <strong>Class</strong><br>&nbsp;&nbsp;&nbsp; Class ถือเป็นองค์ประกอบที่สำคัญที่สุดใน Class Diagram โดย Class คือ สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute, Method และความหมายที่เหมือนๆ กัน (เกิดจากกระบวนการ Classification Abstraction)<br>

<br>
&nbsp;&nbsp;&nbsp;<strong>องค์ประกอบของ Interaction Diagram</strong><br>&nbsp;&nbsp;&nbsp; Object เป็นองค์ประกอบแรกของ Interaction Diagram ซึ่ง Object จะทำหน้าที่ในการส่ง Message ไปยัง Object ตัวอื่นๆ และทำหน้าที่ในการดำเนินการตาม Message ที่ถูกร้องขอจาก Object ตัวอื่น ผู้ส่ง Message จะเรียกว่า Sender Object ที่เป็นผู้รับ Message และดำเนินการตาม Message เรียกว่า Receiver <br>

<br>
&nbsp;&nbsp;&nbsp <strong>Refinement หัวใจสำคัญของ OOD</strong><br>&nbsp;&nbsp;&nbsp; Refinement คือกระบวนการ เพิ่มเติมหรือทำให้ Diagram ที่ทำไว้แล้วในขั้นตอน Analysis มีความเหมาะสม และง่ายต่อการนำมาพัฒนาเป็นระบบงานในเครื่องคอมพิวเตอร์ได้ในที่สุด การทำ Refinement นั้นทำได้กับทุกๆ Diagrams ที่สร้างขึ้นจากขั้นตอน Analysis ไม่ว่าจะเป็น Use Case Diagram, Class Diagram, Sequence Diagram และ State Diagram<br>


<br>
&nbsp;&nbsp;&nbsp <strong>Relational Database</strong><br>&nbsp;&nbsp;&nbsp; Relational Database คือระบบฐานข้อมูลที่อาศัย Relation หรือตาราง (Table) เพื่อแสดงค่าและความสัมพันธ์ของข้อมูล ข้อมูลที่เก็บอยู่ในแต่ละช่องของ Table เรียกว่า Data Item ในทาง Relational Database แต่ละกลุ่มของ Data Item จะมีชื่อของตนเอง เรียกชื่อนั้นว่า Field Name หรือ Column Name กลุ่มของข้อมูลที่มี Column Name เหมือนกัน เรียกว่า Column และเมื่อนำ Column หลายๆ Column ที่แตกต่างกันมาเรียงต่อกันจะได้ Tuple หรือ Row ของข้อมูล และ Row หลายๆ Row เมื่อรวมกันจะได้ Table และเมื่อนำเอา Table ที่มีความสัมพันธ์กันมารวมกันจะได้ฐานข้อมูล (Database) นั่นเอ


</div>




<hr width="800" size=3>
 <br>	                                                   
 <table width="1000" border="0" align="center">
  <tr>
    <td align="center"></td>
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