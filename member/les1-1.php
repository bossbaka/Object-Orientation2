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



<div class="textbox"><h1>บทที่ 1 Object Orientation และ UML หน้าที่ 1</h1>
 <p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; <strong>1.1 Object Orientation คืออะไร</strong><br>&nbsp;&nbsp;&nbsp; ในชีวิตประจำวัน เมื่อมองดูรอบๆ ตัวจะพบเห็นวัตถุ (Object) ต่างๆ มากมาย ไม่ว่าจะเป็นวัตถุที่สามารถมองเห็นได้และจับต้องได้ (Tangible Objects) เช่น โต๊ะ รถยนต์ คอมพิวเตอร์ หรือแม้แต่ตัวของเราเองเป็นต้น และวัตถุที่มีอยู่จริงแต่ไม่สามารถจับต้องได้ (Intangible Objects) ตัวอย่างเช่น กฎหมาย (กฎข้อบังคับที่รัฐบัญญัติขึ้น) เวลา หรือความรู้ต่างๆ เป็นต้น<br>&nbsp;&nbsp;&nbsp; ในโลกของเรามี Objects ต่างๆ มากมาย สิ่งที่เกิดขึ้นจาก Objects ต่างๆ ก็คือ กิจกรรม (Activities) ความเคลื่อนไหว (Movement) หรือการกระทำ (Actions) เช่น คนรับประทานอาหาร สุนัขเล่นกับแมว เป็นต้น<br>&nbsp;&nbsp;&nbsp; ถ้าพิจารณาโดยละเอียดแล้วจะพบว่ากิจกรรมต่างๆ ที่เกิดขึ้นในชีวิตประจำวันนั้นเกิดจากการมีความสัมพันธ์ (Relationship) และการมีปฏิสัมพันธ์ (Interaction) ระหว่าง Object 2 ตัวขึ้นไป ตัวอย่างเช่น<br>&nbsp;&nbsp;&nbsp; - กิจกรรมคนรับประทานอาหาร เกิดจาก Interaction “รับประทานอาหาร” ระหว่างคนและอาหาร และเกิดจาก Relationship “เป็นเจ้าของ” ระหว่างคนและอาหาร (เพราะคนเป็นเจ้าของข้าว จึงจะสามารถรับประทานได้)<br>&nbsp;&nbsp;&nbsp; - กิจกรรมสุนัขเล่นกับแมว เกิดจาก Interaction “เล่น” ระหว่างสุนัขและแมว และเกิดจาก Relationship “เป็นเพื่อน” ระหว่างสุนัขกับแมว<br><br>&nbsp;&nbsp;&nbsp; เพื่อความเข้าใจในเรื่องของ Relationship และ Interaction จากตัวอย่างต่อไปนี้<br>&nbsp;&nbsp;&nbsp; <strong>ตัวอย่าง 1.1</strong> “นาย ก เปิดตู้เย็นยี่ห้อ A (ซึ่งเป็นตู้เย็นของนาย ก) หยิบน้ำ (ซึ่งอยู่ในตู้เย็น) มาดื่ม” สามารถแยกแยะหา Object, Relationship และ Interactions ได้ดังนี้<br>&nbsp;&nbsp;&nbsp; 1. Objects - นาย ก, ตู้เย็นยี่ห้อ A, และน้ำ<br>&nbsp;&nbsp;&nbsp; 2. Relationships – เกิดจากความสัมพันธ์<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - นาย ก เป็นเจ้าของตู้เย็นยี่ห้อ A<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - น้ำอยู่ในตู้เย็นยี่ห้อ A<br>&nbsp;&nbsp;&nbsp; 3. Interactions ระหว่าง Objects ที่สนใจ ได้แก่<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - นาย ก เปิดตู้เย็นยี่ห้อ A<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  - นาย ก หยิบน้ำ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - นาย ก ดื่มน้ำ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เมื่อพิจารณาจากตัวอย่าง อาจจะเกิดคำถามว่าจะสามารถแยกแยะความแตกต่างระหว่าง Relationship กับ Interaction ได้อย่างไร เพื่อตอบคำถามนี้ สามารถสรุปเป็นหลักการในการแยกแยะ Relationship และ Interaction ได้ดังนี้<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>1. Relationship</strong> คือ 	ความเกี่ยวข้องกัน หรือความสัมพันธ์ระหว่าง Objects 2 ตัว	ขึ้นไป เช่น ความเป็นแม่-ลูก ความเป็นเจ้าของการมีอยู่ เป็นต้น<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>2. Interaction</strong> คือ 	ปฏิสัมพันธ์ หรือการกระทำใดๆ ที่เกิดขึ้นระหว่าง Objects 2 ตัว ขึ้นไป เช่น การสร้าง การเปลี่ยนแปลง การเล่น การกระตุ้น เป็นต้น 		ซึ่ง Interaction นี้เองที่ทำให้เกิด กิจกรรม (Activities) ต่างๆ ในโลกนี้<br><br>&nbsp;&nbsp;&nbsp; <strong>Domain</strong><br>&nbsp;&nbsp;&nbsp; จากตัวอย่างที่ 1.1 ถ้าสังเกตให้ดีจะเห็นว่า จะพูดถึง Objects ที่เราสนใจ หรือ Relationships ที่เราสนใจ เป็นต้น คำว่า “ที่เราสนใจ” เป็นการให้กรอบของสิ่งที่เราต้องการพิจารณา หรือสนใจ เพราะเราไม่สามารถสนใจในทุกๆ วัตถุในโลกในเวลาเดียวกันได้ และในขณะเดียวกันเราก็ไม่สามารถให้ความสนใจกับทุกๆ ความสัมพันธ์ และทุกๆ กิจกรรม หรือการกระทำที่เกิดขึ้นได้เช่นกัน<br>&nbsp;&nbsp;&nbsp; เราสามารถจำลองสภาพความเป็นจริง หรือสถานการณ์ต่างๆ ในโลกของความเป็นจริง (Real World) ได้ด้วย Objects รวมทั้ง Relationships และ Interactions ระหว่าง Objects ซึ่งอยู่ภายใน Domain เดียวกัน<br>&nbsp;&nbsp;&nbsp; ใน Domain หนึ่งๆ นั้นสามารถมี Objects ได้ตั้งแต่ 2 ตัวขึ้นไป จนถึงจำนวนนับไม่ถ้วน ในขณะเดียวกัน Object ตัวเดียวกันก็สามารถอยู่ในหลายๆ Domains ได้เช่นเดียวกัน ซึ่งนั่นขึ้นอยู่กับว่าเราจะกำหนด Domain ที่เราสนใจ (Domain of interest) อย่างไรนั่นเอง<br>&nbsp;&nbsp;&nbsp; แนวคิดของ Object Orientation นั้นมาจากคำว่า Object ซึ่งแปลว่า วัตถุที่จับต้องได้และจับต้องไม่ได้ และ Orientation ซึ่งมาจากคำว่า Orient ซึ่งเป็นคำกริยาที่แปลว่านำทาง หรือนำไป ซึ่งเมื่อนำมารวมกันจะหมายถึง การใช้ Object เป็นตัวหลักเพื่อการพิจารณาความเป็นจริงต่างๆ ที่เกิดขึ้นในโลก<br>&nbsp;&nbsp;&nbsp; 	เราสามารถนำเอา Object Orientation มาใช้เป็นแนวคิดและเป็นบรรทัดฐานในการวิเคราะห์ และออกแบบระบบคอมพิวเตอร์ได้ ซึ่งการประยุกต์ใช้ Object Orientation เพื่อการวิเคราะห์และออกแบบระบบคอมพิวเตอร์ ทำให้เกิดศาสตร์ตัวใหม่ขึ้นเรียกว่า Object Oriented Analysis and Design หรือเรียกย่อๆ ว่า OOAD (การวิเคราะห์และออกแบบเชิงวัตถุ
													</div><hr width="800" size=3>                                             
<br>				
<table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  
  <li><a href="les1-1.php">1</a></li>
  <li><a href="les1-2.php">2</a></li>
  <li><a href="les1-2.php">Next</a></li>
</ul></td>
  </tr>
</table>



<br><br><br>

<div class="footer">
  <table width="1000" border="0" align="center" cellspacing="20">
<tr valign="top">
  <td width="420"><strong><em>Website</em></strong><br>
    <strong><em>By Phisek Pinpia</em></strong></td>
  <td width="300"><p><strong><em> Contact <br> E-mail : <a href="mailto:@gmail.com" class="fontfooter">@gmail.com</a> <br> Tel. 089242XXXX</em></strong></p> <div align="right"><a href="https://th-th.facebook.com" target="new"><img src="../pic/facebook.png"></a> <a href="https://twitter.com/?lang=th" target="new"><img src="../pic/twitter.png"></a> <img src="../pic/rss.png"></div></td>
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
