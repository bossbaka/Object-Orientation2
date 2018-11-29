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
<title>บทที่ 4</title>
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
<h1>บทที่ 4 Class Diagram หน้าที่ 1</h1>
<p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; <strong>4.1 องค์ประกอบของ Class Diagram</strong><br>&nbsp;&nbsp;&nbsp; <strong>4.1.1 Class</strong><br>&nbsp;&nbsp;&nbsp; Class ถือเป็นองค์ประกอบที่สำคัญที่สุดใน Class Diagram โดย Class คือ สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute, Method และความหมายที่เหมือนๆ กัน (เกิดจากกระบวนการ Classification Abstraction)<br>&nbsp;&nbsp;&nbsp; Attribute หมายถึง คุณสมบัติของ Class ซึ่ง Object ทุกตัวของ Class ต้องมีคุณสมบัติตามที่กำหนดไว้ใน Class โดย Class หนึ่งๆ จะมี Attribute จำนวนเท่าใดก็ได้ Attribute ทุกตัวต้องมีชื่อ และชื่อของ Attribute ของ Class เดียวกันจะต้องไม่ซ้ำกัน<br>&nbsp;&nbsp;&nbsp; - Visibility<br>&nbsp;&nbsp;&nbsp; - Type แบ่งออกเป็น 2 ประเภท คือ Primitive type และ Class Primitive type หมายถึงคุณสมบัติของ Attribute ที่กำหนดรูปลักษณ์ของค่า Attribute เช่น เป็นตัวเลข เป็นตัวหนังสือ หรือค่าจริง/เท็จ และการดำเนินการที่สามารถกระทำได้กับ Attribute Class หมายความว่า Attribute ของ Class หนึ่ง อาจมีประเภทเป็น Class อื่นก็ได้<br>&nbsp;&nbsp;&nbsp;  Method หมายถึง บริการที่ Object ของ Class ต้องมี เพื่อให้สิ่งแวดล้อมหรือ Object อื่นๆ เรียกใช้บริการได้<br>&nbsp;&nbsp;&nbsp; ใน Class หนึ่งๆ จะมี Method จำนวนเท่าใดก็ได้ โดยทุกๆ Method จะต้องถูกกำกับด้วย Visibility เสมอและต้องมีชื่อเช่นเดียวกับ Attribute ชื่อของ Method อาจซ้ำกันได้ โดยต้องอยู่ภายในข้อกำหนดของการตั้งชื่อ Method  พิจารณา ดังนี้<br>&nbsp;&nbsp;&nbsp; - Parameter หมายถึง ตัวแปร (Primitive Type) หรือ Object ที่ถูกส่งเข้าไปยัง Method ซึ่งจะถูกใช้เพื่อการดำเนินการบางอย่าง โดยหลังจากดำเนินการเสร็จแล้ว ตัวแปรหรือ Object เหล่านั้นอาจเปลี่ยนแปลงสถานะไปหรือไม่ก็ได้ Method ใดๆ อาจไม่มี Parameter ก็ได้<br>&nbsp;&nbsp;&nbsp; - Return Type หมายถึง Type ของผลลัพธ์จากการดำเนินการของ Method ซึ่งจะถูกส่งออกมาสู่ภายนอก โดยในหนึ่ง Method จะมี Return Type ได้อย่างมากที่สุดเพียงตัวเดียว หรืออาจไม่มีเลยก็ได้<br>&nbsp;&nbsp;&nbsp; Parameter และ Return Type ถือเป็นสิ่งที่กำหนดความแตกต่างระหว่าง Method ของ Class เรียกองค์ประกอบทั้งสองรวมกันว่า Method Signature<br>&nbsp;&nbsp;&nbsp; กฏในการตั้งชื่อ Method มีดังนี้<br>&nbsp;&nbsp;&nbsp; 1. ชื่อของ Methods ใน Class เดียวกัน ไม่ควรซ้ำกัน<br>&nbsp;&nbsp;&nbsp; 2. การซ้ำกันของ Method ใน Class เดียวกัน จะมีได้ก็ต่อเมื่อ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2.1 Method ที่ชื่อซ้ำกัน มีจำนวนของ Parameter ต่างกัน โดยไม่สนใจว่า Type ของ Parameter จะเป็นอะไรและไม่สนใจว่าจะมี Return Type ของ Method เหมือนหรือแตกต่างกัน<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2.2 Method ที่ชื่อซ้ำกัน มีจำนวน Parameter เท่ากัน แต่ Type ของ Parameter ต่างกัน โดยไม่สนใจว่าจะมี Return Type ของ Method เหมือนหรือต่างกัน
													<br><center><img src="../pic/f24.jpg"></center><br>&nbsp;&nbsp;&nbsp; Constructor เป็น Method ใน Class ที่แตกต่างจาก Method ทั่วไป โดย Constructor จะทำงานทันทีหลังจาก Object ถูกสร้างขึ้นจาก Class Constructor ของ Class จะเป็น Method ที่ชื่อเดียวกันกับ Class และต้องไม่มี Return Type โดย Constructor ของ Class หนึ่ง สามารถมีได้มากกว่าหนึ่งตัว แต่ต้องมี Parameter ที่แตกต่างกัน เพื่อให้เป็นไปตามหลักการตั้งชื่อ Method<br>&nbsp;&nbsp;&nbsp; Constructor จะถูกเรียกให้ทำงานเมื่อมีการสร้าง Object จาก Class ดังนั้น Constructor จึงถูกใช้ประโยชน์ในหลายๆ รูปแบบ ดังนี้<br>&nbsp;&nbsp;&nbsp; <strong>- การกำหนดค่าเริ่มต้นให้กับ Attribute ของ Object </strong><br>&nbsp;&nbsp;&nbsp; โดยทั่วไปมักมีการใช้ Constructor เพื่อระบุค่าเริ่มต้นให้กับ Object ของ Class โดยการส่งค่าตั้งต้นของแต่ละ Attribute ของ Object ในรูปแบบของ Parameter ของ Constructor<br>&nbsp;&nbsp;&nbsp; <strong>- การระบุ Class ที่แท้จริงของ Object</strong><br>&nbsp;&nbsp;&nbsp; ในกรณีที่มีการสร้างกลุ่มของ Class ที่ทำ Inheritance ได้ จะสามารถใช้ Constructor ของ SuperClass เพื่อเป็นตัวกำหนดว่าในการสร้าง Object แต่ละครั้ง จะให้ Object นั้นเป็น ของ SuperClass ใด โดยกำหนดผ่านทาง Parmeter ของ Constructor ของ SuperClass<br>&nbsp;&nbsp;&nbsp; Destructor เป็น Method ใน Class ที่แตกต่างจาก Method ทั่วไปเหมือนกับ Constructor Destructor จะทำงานก่อนที่ Object ของ Class จะถูกทำลายไป เป็น Method ที่มีชื่อเดียวกับ Class แต่มีเครื่องหมาย ~ นำหน้า เช่น Class ชื่อ Book แล้ว Destructor มีชื่อว่า ~Book Destructor ต้องไม่มี Return Type และไม่มี Parameter และต้องมีเพียงตัวเดียวเท่านั้น<br>&nbsp;&nbsp;&nbsp; Destructor จะถูกเรียกให้ทำงานก่อนที่ Object ของ Class จะถูกทำลาย ดังนั้น Destructor จึงถูกใช้ประโยชน์ดังนี้<br>&nbsp;&nbsp;&nbsp; <strong>- การทำ Cascade Destructor</strong><br>&nbsp;&nbsp;&nbsp; ในบางกรณี ของความสัมพันธ์แบบ Composite อาจต้องการกำหนดว่า เมื่อ Object ของ Class หนึ่งถูกทำลายลง Class อื่นๆ ที่มีความสัมพันธ์กันต้องถูกทำลายลงด้วย
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
