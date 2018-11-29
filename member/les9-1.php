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
<title>บทที่ 9</title>
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
<h1>บทที่ 9 System Architecture Design หน้าที่ 1</h1>
<p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; <strong>9.1 Statechart Diagram Refinement และ Deployment Diagram</strong><br>&nbsp;&nbsp;&nbsp; การวิเคราะห์และออกแบบระบบด้วยหลักการ Object Oriented Analysis and Design นั้น จะถือว่าทุกๆ ส่วนประกอบของระบบนั้นเป็น Object ตัวหนึ่งเสมอ ซึ่ง Object นั้น ไม่ได้หมายถึงเฉพาะส่วนที่อยู่ใน Application หรือ Software เท่านั้น แต่ยังหมายรวมถึง เครื่องคอมพิวเตอร์ หรือ Hardware ซึ่งถือเป็นข้อได้เปรียบของการออกแบบระบบด้วย Object Oriented Analysis and Design เพราะเราสามารถที่จะออกแบบ Software และ Hardware โดยไม่ต้องเปลี่ยนหลักการที่ใช้เพื่อการออกแบบ (เพราะทั้ง Hardware และ Software ต่างก็ถือเป็น Object เหมือนกัน) การออกแบบในส่วนของ Hardware ของระบบนั้น เรียกว่า System Architecture Design<br>&nbsp;&nbsp;&nbsp; เครื่องมือที่ใช้ในการทำ System Architecture Design นั้นเรียกว่า Deployment Diagram ซึ่ง Deployment Diagram เป็น Diagram ที่มีลักษณะเหมือนกับ Class Diagram โดย ส่วนประกอบทาง Hardware (Hardware Module) ตัวหนึ่งๆ ใน Deployment Diagram ก็จะเปรียบเทียบได้กับ Class หนึ่ง ใน Class Diagram นั่นเอง<br>&nbsp;&nbsp;&nbsp; <strong>9.1.1 สัญลักษณ์ที่ใช้ใน Deployment Diagram จะประกอบด้วย 3 สัญลักษณ์</strong><br>&nbsp;&nbsp;&nbsp; 1. สัญลักษณ์สี่เหลี่ยมลูกบาศก์ หรือสี่เหลี่ยม 3 มิติ (Cubic, Raised Rectangle) ใช้แทนส่วนของHardware ที่สามารถที่จะมี Software บรรจุอยู่ภายใน หรือส่วนของ Hardware ที่เป็น Network หลักของระบบอาทิเช่น เครื่อง File Server, เครื่อง Database Server, เครื่อง Web Server, เครื่อง Client และ Backbone Network เป็นต้น สิ่งที่เขียนบรรยายอยู่ภายในสัญลักษณ์นี้จะเป็นชื่อและหน้าที่ของ Hardware Module นั้นๆ
													<br><center><img src="../pic/f45.jpg"></center>&nbsp;&nbsp;&nbsp; <center>รูป Hardware Module ใน Deployment Diagram</center><br>&nbsp;&nbsp;&nbsp; หลักการในการเขียน Hardware Module นั้น ให้แบ่งเป็น 2 ส่วนคือ ส่วนบนให้ระบุประเภทของ Hardware นั้นโดยระบุในเครื่องหมาย << >> และเขียนชื่อของ Hardware นั้นไว้ในบรรทัดถัดไป<br>&nbsp;&nbsp;&nbsp; ในส่วนล่าง (จะมีหรือไม่ก็ได้) ให้ระบุว่า Hardware นั้นมี Software Component ใดอยู่บ้าง ซึ่ง Software Component ที่จะระบุใน Hardware Module ได้นั้น ได้จากขั้นตอนการทำ Application Architecture Design นั่นเอง เมื่อพิจารณาตัวอย่างจากรูป จะพบว่า Hardware Module ตัวนี้มีประเภทเป็น Processor (หน่วยประมวลผล) ซึ่งมีชื่อเรียกว่า Application Server โดย Software Component ที่อยู่ภายในประกอบไปด้วย http.exe และ rting.exe ซึ่งทั้งสองถือเป็น Executable Software<br>&nbsp;&nbsp;&nbsp; 2. เส้นที่ใช้เชื่อมลูกบาศก์หรือสี่เหลี่ยม 3 มิติเข้าด้วยกัน เป็นสัญลักษณ์ที่ใช้แทนการเชื่อมต่อต่างๆ (Connections) โดยสิ่งที่ระบุหรืออธิบายเส้นเหล่านี้ จะหมายถึง Protocol หรือข้อตกลงเบื้องต้น (อาจจะไม่ระบุก็ได้ ถ้ายังตัดสินใจไม่ได้ว่าจะใช้ Protocol ใด) ที่ใช้เพื่อการสื่อสารกันระหว่าง Hardware Module ทั้งสองข้าง -<< >>-<br>&nbsp;&nbsp;&nbsp; 3. สัญลักษณ์อื่นๆ บางครั้งการสร้าง Deployment Diagram อาจมีสัญลักษณ์อื่นๆ เพิ่มเติมเข้ามา เช่น เมื่อระบบต้องใช้ระบบ Internet ด้วย อาจต้องมีสัญลักษณ์เฉพาะเพื่อใช้แทนเครือข่าย Internet (ปกติเป็นรูปเมฆ) เป็นต้น ซึ่งสัญลักษณ์ที่เพิ่มเข้ามาใหม่นี้ มักจะมีเพิ่มขึ้นตลอดเวลาตามการพัฒนาของเทคโนโลยี
													<br><center><img src="../pic/f46.jpg"></center><br>&nbsp;&nbsp;&nbsp; เมื่อเปรียบเทียบ Deployment Diagram กับ Class Diagram นั้น จะมีความคล้ายคลึงกัน เพราะเมื่อพิจารณา Connections ใน Deployment Diagrams จะมีลักษณะและหน้าที่เหมือนกันกับ Association Relationship และสัญลักษณ์อื่นๆ ที่ถูกเชื่อมต่อโดย Connection ก็คือ Class นั่นเอง<br>&nbsp;&nbsp;&nbsp; <strong>9.1.2 หลักการทำ System Architecture Design โดย Deployment Diagram</strong><br>&nbsp;&nbsp;&nbsp; การทำ System Architecture Design หรือการออกแบบระบบ Hardware ด้วย Deployment Diagram นั้น ต้องมีความสัมพันธ์กับ Application Architecture Design ซึ่งออกแบบด้วย Component Diagram คือ แต่ละ Software Component ต้องอยู่ภายใน Hardware Module ใด Module หนึ่งเสมอจะต้องไม่มี Software Component ใดขาดหายไป<br>&nbsp;&nbsp;&nbsp; ดังนั้นเมื่อสร้าง Deployment Diagram สิ่งที่ต้องทำไปพร้อมๆ กันก็คือ พิจารณาว่าจะนำ Software Component ไปไว้ใน Hardware Module ตัวใด และต้องพิจารณาด้วยว่า เทคโนโลยีหรือรูปแบบของ Hardware หรือระบบ Network ที่จะใช้นั้น เหมาะสมกับระบบงานที่เราจะสร้างหรือไม่<br>&nbsp;&nbsp;&nbsp; 	ข้อพึงตระหนักที่สำคัญที่สุดในการทำ System Architecture Design ก็คือ การออกแบบระบบ Hardware เป็นการออกแบบที่ไม่ควรเกิดข้อผิดพลาด หรือถ้าเกิดก็ควรน้อยที่สุด เพราะถึงแม้ว่าจะยึดถือหลักการวิเคราะห์และออกแบบระบบแบบ Spiral Process Model แต่การแก้ไขระบบ Hardware ย่อมหมายถึงการซื้อหรือเปลี่ยนอุปกรณ์ Hardware ซึ่งในบางกรณีต้องใช้การลงทุนที่มีมูลค่าสูง
													<br><strong>9.2 Client/Server System</strong><br>&nbsp;&nbsp;&nbsp; Client/Server System เป็นระบบที่มีการประมวลผลที่มีลักษณะคล้ายคลึงกับ Embedded System ในบางส่วนในขณะเดียวกันก็มีข้อแตกต่างหลายส่วนเช่นกัน ข้อคล้ายคลึงคือ ในการประมวลผลนั้นจะมีการประมวลผลเพียงที่เดียว คือที่ Application Server แต่ Client/Server System จะมี Processor บางตัวแยกต่างหากที่ทำหน้าที่ในการช่วยเหลือด้านอื่นๆ เช่น Database Server ซึ่งทำหน้าที่จัดการเกี่ยวกับการจัดเก็บข้อมูล และอาจจะมี Caching Server ที่ช่วยในการจัดลำดับงานต่างๆ ที่เข้ามาเพื่อรอการประมวลผล ข้อแตกต่างที่สำคัญอีกประการหนึ่งคือ Client/Server เป็นระบบที่ยินยอมให้มีผู้ใช้งานพร้อมๆ กันได้หลายคน
													<br><strong>9.3 Distributed System</strong><br>&nbsp;&nbsp;&nbsp; Distributed System เป็นระบบที่มีความคล้ายคลึงกับ Client/Server System ในบางประการ แต่ก็มีข้อแตกต่างกันบางอย่างเช่นกัน ข้อคล้ายคลึงคือ เป็นระบบที่ยินยอมให้มีผู้ใช้งานได้พร้อมกันหลายๆ คนและมี Processor ที่ช่วยเหลืองานในด้านอื่นๆ ที่ไม่ใช่การประมวลผลเหมือนกัน แต่ข้อแตกต่างคือ Distributed System จะมี CPU หรือ Processor ที่ใช้ประมวลผลจริงๆ มากกว่า 1 ตัว เพื่อช่วยเหลือกันและกันในการประมวลผลงานที่มีขนาดใหญ่มากๆ
													</div>
													<hr width="800" size=3> <br>
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
