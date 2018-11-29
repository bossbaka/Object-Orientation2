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
<h1>บทที่ 5 Interaction Modeling หน้าที่ 2</h1>
<p>&nbsp;</p>
													&nbsp;&nbsp;&nbsp; <strong>- Message with Parameter(s)</strong><br>&nbsp;&nbsp;&nbsp; ในการแสดง Message ใน Sequence Diagram เราสามารถใส่ Parameter ให้กับ Message ได้ เนื่องจาก Message ส่วนใหญ่ โดยเฉพาะ Call Message เป็นการใช้ Method ของ Object ที่เป็น Receiver หาก Method ที่ถูกเรียกใช้ จำเป็นต้องมี Parameter แล้ว Message นั้นก็จำเป็นต้องมี Parameter ด้วย<br>&nbsp;&nbsp;&nbsp; <strong>- Guard Condition</strong><br>&nbsp;&nbsp;&nbsp; ในการสร้าง Message การเกิด Message หนึ่งๆ ขึ้นก็ไม่ได้เกิดขึ้นแบบตรงไปตรงมา บางครั้ง อาจอยู่ภายใต้เงื่อนไข เพราะฉะนั้น สามารถกำหนดเงื่อนไขในการเกิด Message หนึ่งๆ ได้ ด้วยการใส่ Guard Condition ดังนี้
													<br><center><img src="../pic/f30.jpg"></center><br><strong>5.3 Communication (Collaboration) Diagram</strong><br>&nbsp;&nbsp;&nbsp; ใน UML 1.0 เดิมชื่อ Collaboration Diagram เป็นแผนภาพที่มุ่งเน้นการแสดงที่เกิดขึ้นในระบบพร้อมๆ กับการแสดงความสัมพันธ์ระหว่าง Object ต่างๆ ที่มีส่วนร่วมอยู่ในกิจกรรมเหล่านั้น ภายใน Communication Diagram จะประกอบด้วย กลุ่มของ Object กลุ่มของ Message ซึ่งถูกกำกับด้วยลำดับของการเกิดกิจกรรมและ Link ซึ่งแสดงความสัมพันธ์ระหว่าง Object (Linkจะไม่ปรากฏใน Sequence)<br>&nbsp;&nbsp;&nbsp; Communication Diagram และ Sequence Diagram สามารถใช้ทดแทนกันได้ สิ่งใดๆ ที่สามารถอธิบายใน Sequence Diagram ได้ ก็สามารถอธิบายใน Communication ได้เช่นเดียวกัน โดยเรียกคุณสมบัติที่สามารถแทนกันได้นี้ ว่า ความเท่าเทียมกัน
													<br><strong>5.4 การใช้ Interaction Diagram ใน OOA</strong><br>&nbsp;&nbsp;&nbsp; ในกระบวนการ OOA จะใช้ Interaction Diagram เป็นตัวกลางในการเชื่อมโยงความสัมพันธ์ระหว่าง Use Case ต่างๆ และ Class ต่างๆ ในระบบ ด้วยนิยามที่ว่า<br>&nbsp;&nbsp;&nbsp; Use Case คือ กลุ่มของกิจกรรมที่เกิดขึ้นในระบบ โดยกิจกรรมเหล่านี้ เกิดจากการมีปฏิสัมพันธ์ระหว่าง Object ของ Class ต่างๆ ในระบบ<br>&nbsp;&nbsp;&nbsp; จะใช้ Interaction Diagram เพื่ออธิบายว่า ใน Use Case หนึ่งๆ ควรจะมี Object ตัวใดที่มีส่วนร่วมอยู่ในการดำเนินกิจกรรมบ้าง และการดำเนินกิจกรรมนั้นดำเนินไปอย่างไร ด้วย Message แบบใด โดยทั่วไปจำเป็นต้องใช้ Interaction Diagram อธิบาย Main Flow of Event ของ Use Case แต่บาง Use Case ที่มี Exceptional Flow of Event ที่มีความสำคัญ ก็สามารถใช้ Interaction Diagram เพื่ออธิบาย Exception Flow เหล่านั้นได้<br>&nbsp;&nbsp;&nbsp; เราใช้หนึ่ง Interaction Diagram เพื่ออธิบายกิจกรรมในหนึ่ง Use Case แต่ในกรณีที่ Use Case ถูก Extend หรือถูก Use โดย Use Case อื่น อาจชะ Sequence Diagram เดียวเพื่ออธิบาย Use Case ทั้งกลุ่มก็ได้ ขึ้นอยู่กับสถานการณ์<br>&nbsp;&nbsp;&nbsp; <strong>5.4.1 การใช้ Interaction Diagram เพื่อช่วยปรับปรุง Use Case Diagram</strong><br>&nbsp;&nbsp;&nbsp; การอธิบายกิจกรรมของ Use Case ด้วย Interaction Diagram นั้น นอกจากจะมีจุดประสงค์เพื่อจำลองภาพรายละเอียดของกิจกรรมที่เกิดขึ้นใน Use Case แล้ว ในบางครั้งการสร้าง Interaction Diagram อาจทำให้พบข้อผิดพลาดหรือข้อบกพร่องของ Use Case ได้ เช่น Use Case Diagram ควรมี Use Case บางตัวเพิ่มขึ้น หรือควรแยก Use Case หนึ่งตัวออกเป็น Use Case ย่อยหลายๆ ตัว ที่มีความสัมพันธ์ ทั้งนี้ การชี้จุดบกพร่องของ Use Case Diagram จะก่อให้เกิดการปรับปรุง Use Case Diagram เพื่อให้ได้ Use Case Diagram ที่ถูกต้องสมบูรณ์ในที่สุด<br>&nbsp;&nbsp;&nbsp; <strong>5.4.2 การใช้ Interaction Diagram เพื่อช่วยปรับปรุง Class Diagram</strong><br>&nbsp;&nbsp;&nbsp; การอธิบายกิจกรรมของ Use Case ด้วย Interaction Diagram นั้น จะแสดงปฏิสัมพันธ์ระหว่าง Object ต่างๆ ด้วย Message ซึ่งทราบดีกันว่า Message ส่วนใหญ่คือ Method ของ Object ที่เป็นผู้รับ Message<br>&nbsp;&nbsp;&nbsp; ในการสร้าง Interaction Diagram พบว่า จำเป็นต้องสร้าง Message ใหม่ๆ เพิ่มขึ้นใน Interaction Diagram โดยที่ Message นั้นไม่ได้เป็น Method ของ Receiver นั่นหมายความว่า Method ของ Class ที่เป็น Receiver ต้องได้รับการแก้ไข โดยเพิ่ม Method ใหม่ดังกล่าวเข้าไป ในทางกลับกัน เมื่อสร้าง Interaction Diagram สำหรับทุกๆ Use Case จนครบหมดแล้ว หากพบว่า ยังมี Method บางตัวของบาง Class ที่ไม่ได้ปรากฏใน Interaction Diagram ตัวใดเลย นั่นหมายความว่า  Method ดังกล่าว อาจจะไม่จำเป็นต้องมีอยู่ใน Class อีกต่อไป<br>&nbsp;&nbsp;&nbsp; สมมติว่า พิจารณา Class TicketKiosk มีรายละเอียด ดังนี้ 
													<br><center><img src="../pic/f31.jpg"></center><br>&nbsp;&nbsp;&nbsp; และพิจารณาจากบทบาทของ object ของ TicketKiosk ใน Communication Diagram
													<br><center><img src="../pic/f32.jpg"></center><br>&nbsp;&nbsp;&nbsp; จะเห็นว่า Communication Diagram ได้แสดงให้เห็นว่า Class TicketKiosk ควรมี Method calculateChange ที่มี parameter สองตัว ซึ่งได้แก่ coinPrice และ ticketPrice นอกจากนั้น Communication Diagramยังได้แสดงให้เห็นด้วยว่า Method calculatePrice ที่มีอยู่เดิมนั้น ควรจะมี Parameter station รวมอยู่ด้วย ซึ่งจากข้อมูลดังกล่าวนี้ทำให้สามารถเพิ่มเติมรายละเอียดของ Class TicketKiosk ได้ดังนี้
													<br><center><img src="../pic/f33.jpg"></center>
																											</div>
													<hr width="800" size=3> <br>
<table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  <li><a href="les5-1.php">Previous</a></li>
  <li><a href="les5-1.php">1</a></li>
  <li><a href="les5-2.php">2</a></li>
  <li><a href="les5-3.php">3</a></li>
  <li><a href="les5-3.php">Next</a></li>
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
