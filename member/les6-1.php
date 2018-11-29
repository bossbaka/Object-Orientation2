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
<title>บทที่ 6</title>
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
<h1>บทที่ 6 OOA Refinement หน้าที่ 1</h1>
<p>&nbsp;</p>
&nbsp;&nbsp;&nbsp;  <strong>6.1 Refinement หัวใจสำคัญของ OOD</strong><br>&nbsp;&nbsp;&nbsp; Refinement คือกระบวนการ เพิ่มเติมหรือทำให้ Diagram ที่ทำไว้แล้วในขั้นตอน Analysis มีความเหมาะสม และง่ายต่อการนำมาพัฒนาเป็นระบบงานในเครื่องคอมพิวเตอร์ได้ในที่สุด การทำ Refinement นั้นทำได้กับทุกๆ Diagrams ที่สร้างขึ้นจากขั้นตอน Analysis ไม่ว่าจะเป็น Use Case Diagram, Class Diagram, Sequence Diagram และ State Diagram<br>&nbsp;&nbsp;&nbsp; สิ่งสำคัญที่ต้องจำไว้เป็นหลักการในการทำ Refinement คือ การทำ Refinement ที่ Use Case Diagram จะมีผลต่อการทำ Refinement ของ Class Diagram ในขณะที่การทำ Refinement ของ Class Diagram จะมีผลต่อการทำ Refinement ของ Sequence Diagram และ State Diagram และการทำ Refinement ระหว่าง Sequence และ State Diagram ก็จะมีผลกระทบต่อกันและกันเสมอ
													<br><strong>6.2 Use Case Diagram Refinement ซึ่งมีหลักการดังนี้</strong><br>&nbsp;&nbsp;&nbsp; 1. พิจารณาว่าแต่ละ Use Case นั้นสามารถแยกแยะออกมาเป็น Use Case ย่อยๆ ได้หรือไม่ ถ้าสามารถทำได้ให้แยกแยะ Use Case นั้นๆ ออกมา<br>&nbsp;&nbsp;&nbsp; 2. สร้างความสัมพันธ์ระหว่าง Use Case เดิมและ Use Case ที่แยกย่อยออกมา จากที่ทำไว้ในความสัมพันธ์ระหว่าง Use Case คือ < Uses > หรือ < Extends > ให้ครบถ้วน และต้องคอยตรวจสอบไม่ให้มี Use Case ใด Use Case หนึ่งที่ไม่มีความสัมพันธ์กับ Use Case อื่น หรือไม่มีความสัมพันธ์กับ Actor ใดเลย (Use Case ที่อยู่โดดๆ) ในขณะเดียวกัน หากสามารถแยกแยะ Actor หนึ่งตัวให้เป็นประเภทต่างๆ ที่ละเอียดขึ้น หรือการจัดประเภทของ Actor ให้มีลักษณะเป็นจำพวกเดียวกันโดยอาศัยหลักการ Generalization ได้ ก็ให้ทำในขั้นตอนนี้<br>&nbsp;&nbsp;&nbsp;	3. สร้าง Use Case List เพื่อแสดงรายการ Use Case ที่มีทั้งหมด ทั้งก่อนและหลังจากการทำ Refinement<br>&nbsp;&nbsp;&nbsp;4. ใน Use Case List ก่อนการทำ Refinement ให้ List ว่ามี Class ใดบ้างอยู่ภายใน Use Case แต่ละตัวโดย Class หนึ่งๆ อาจจะอยู่ใน Use Case มากกว่า 1 Use Case ก็ได้ แต่หลักการสำคัญก็คือทุกๆ Class ต้องอยู่ภายใน Use Case ใด Use Case หนึ่งเป็นอย่างน้อย จะต้องไม่มี Class ใดที่ไม่อยู่ใน Use Case ใดเลย แต่อย่างไรก็ตามอาจจะยกเว้น Class ของ Actor เท่านั้นที่ไม่ต้องอยู่ที่ใน Use Case ใดเลยก็ได้ในกรณีที่ Problem Domain ไม่ได้เน้นให้ Actor มีตัวตนในคอมพิวเตอร์
													<br><strong>6.3 Class Diagram Refinement มีหลักการดังนี้</strong><br>&nbsp;&nbsp;&nbsp; 1. ในแต่ละ Class ให้พิจารณาว่ามี Attributes ตัวใดบ้างที่ต้องมีการรับค่าจากภายนอก และ/หรือ มีการส่งค่าของ Attribute นั้นออกสู่ภายนอก ถ้ามีให้เพิ่ม Function พร้อมทั้ง Parameters ที่จำเป็นทั้งหมดเพื่อการรับเข้า และ/หรือ ส่งออกค่าของ Attribute เหล่านั้น เข้าไปที่ Class ด้วย โดยกำหนดให้ Function ต่างๆ ที่เพิ่มเข้ามามี Visibility เป็น Public (มองเห็นได้จากภายนอก) ทั้งหมด เพราะ Function เหล่านี้ต้องถูกเรียกใช้โดย Object อื่นเสมอ<br>&nbsp;&nbsp;&nbsp; 2. จากหลักการข้อ 1 ข้อพึงระวังในการเพิ่ม Function เพื่อการนำเข้า/ส่งออก ค่าของ Attributes นั้นคือ เรื่องของ Subclass และ SuperClass การเพิ่มเติมใดๆ ลงไปยัง SuperClass จะหมายถึงการเพิ่มเติมลงใน Subclass แต่การเพิ่มเติมใน Subclass จะไม่มีผลกระทบให้ Superclass เปลี่ยนแปลง<br>&nbsp;&nbsp;&nbsp; 3. ทุกๆ Attributes และ Functions ในแต่ละ Class ต้องมี Visibility (Private, Protected หรือ Public) ที่แน่นอน จะต้องไม่มี Attributes และ Functions ใดที่ไม่มี Privacy ในกรณีที่ยังไม่แน่ใจว่า Privacy ของ Attributes หรือ Functions นั้นเป็นอะไร ให้ยึดหลักการต่อไปนี้ หากเป็น Attributes ให้ตั้ง Privacy เป็น Private ไว้ก่อน แต่หากเป็น Function ให้ตั้ง Visibility เป็น Public ไว้ก่อน ถ้ามี Attributes ใดที่มี Visibility เป็น Private ซึ่งจำเป็นต้องมีการส่งค่าของ Attributes เข้า/ออก ให้ทำตามข้อ 1<br>&nbsp;&nbsp;&nbsp; 4. ทุกๆ Aggregation และ Association จะต้องมี Cardinality กำกับเสมอ และต้องกำกับทิศทางของ Association ให้ชัดเจน อาจจะระบุ Role ของ Class ที่มี Association ต่อกันด้วยก็ได้ ตัวอย่างเช่น ใน Association ครู-นักเรียน Role ของครูคือผู้สอน ในขณะที่นักเรียนมี Role เป็นผู้เรียน เป็นต้น<br>&nbsp;&nbsp;&nbsp; 5. พิจารณา Problem domain โดยละเอียดว่า หากใช้คอมพิวเตอร์เข้ามาร่วมทำงาน จำเป็นต้องมี Class ใดเพิ่มเข้ามาบ้าง ตัวอย่างที่ดีของ Class เหล่านี้คือ Class ของ User Interface (GUI)<br>&nbsp;&nbsp;&nbsp; 6. หลังจากเสร็จสิ้นการทำ Refinement แล้ว ให้พิจารณาว่า Class ที่เพิ่มขึ้นนั้นอยู่ใน Use Case ใดให้ระบุ Class ต่างๆ ทั้งที่มีอยู่เดิมและที่เพิ่มเข้ามาว่าอยู่ใน Use Case ใดบ้างลงใน Use Case List หลังจากการทำ Refinement เพื่อเป็นการตรวจสอบว่า ก่อนและหลังทำ Refinement แล้ว Class ต่างๆ อยู่ใน Use Case ที่ถูกต้องหรือไม่ และทุกๆ Class จะต้องมีอยู่ใน Use Case ใด Use Case หนึ่งเสมอ 
													<br><strong>6.4 Sequence Diagram Refinement มีหลักการดังนี้</strong><br>&nbsp;&nbsp;&nbsp; 1. จาก Class Diagram ที่ได้ทำ Refinement แล้ว ให้พิจารณาว่ามี Function ใดใน Class ใดบ้างที่ยังไม่ปรากฏใน Sequence Diagram ให้พิจารณาหาตำแหน่งของ Function นั้นๆ ใน Sequence Diagram หากหาไม่ได้ ให้ทำเครื่องหมายใดๆ ไว้เพื่อทำการลบทิ้งภายหลัง<br>&nbsp;&nbsp;&nbsp; 2. นำ Class ที่เป็นส่วนของ User Interface (ที่เพิ่มเข้ามาใน Class Diagram) มาเพิ่มเติมลงในทุกๆ Sequence Diagram ที่มี Actor มาเกี่ยวข้อง แล้วสร้างลูกศรแสดงกิจกรรมเพื่อสร้าง Sequence Diagram ที่สมบูรณ์โดยพยายามนำ Function ที่มรอยู่แล้วใน User Interface หรือ Class อื่นๆ มาสร้างเป็นลูกศร แต่หากหาไม่ได้ ให้เพิ่ม Function ใหม่ๆ เข้าไป ในขณะเดียวกันต้องเข้าไปเพิ่มใน Class Diagram ด้วย<br>&nbsp;&nbsp;&nbsp; 3. ในกิจกรรมที่เกิดขึ้นจาก Class ใด Class หนึ่งนั้น พยายามระบุว่า Class นั้นๆ จะมีอายุอยู่ในช่วงเวลาใดบ้าง ซึ่งสัญลักษณ์การแสดงช่วงชีวิตนั้นทำได้โดยการเพิ่มเติมภาพสี่เหลี่ยมผืนผ้าที่มีความกว้างพอประมาณแต่ความยาวเท่ากับระยะห่างระหว่างเส้นกิจกรรมเส้นแรกที่เข้าหรือออกจาก Class ถึงเส้นสุดท้ายที่มีเส้นกิจกรรมเข้าหรือออกจาก Class ซึ่งสัญลักษณ์นี้จะวางอยู่บนเส้นแสดงการเดินไปของเวลา (เส้นประ) ใน Sequence Diagram สัญลักษณ์สี่เหลี่ยมที่ใช้แสดงช่วงชีวิตนี้จะมีส่วนช่วยให้ผู้ที่จะพัฒนาระบบ (ซึ่งอาจไม่ใช่ผู้ออกแบบ) ทราบได้ว่าควรที่จะสร้าง Object จาก Class หรือทำลาย Objects ณ ช่วงเวลาใดบ้างเพื่อให้ Objects ที่สร้างมาดำเนินกิจกรรมต่างๆ ของระบบต่อไปได้<br>&nbsp;&nbsp;&nbsp; <strong>ตัวอย่าง 6.1 การทำ Refinement</strong>
													<br><center><img src="../pic/f47.jpg"></center>&nbsp;&nbsp;&nbsp;<center>รูป Use Case Diagram ของระบบพัฒนาข้อมูลขององค์กรภาครัฐ</center>													
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
