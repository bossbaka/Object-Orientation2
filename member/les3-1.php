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
<h1>บทที่ 3 Use Case Modeling หน้าที่ 1</h1>
<p>&nbsp;</p>
&nbsp;&nbsp;&nbsp; <strong>3.1 Use Cases, Actors, Scenario และ Use Case Diagram</strong><br>&nbsp;&nbsp;&nbsp; Subsystem ต่างๆ มักมีปฏิสัมพันธ์กับสิ่งอื่นๆ 2 รูปแบบ<br>&nbsp;&nbsp;&nbsp; 1. ปฏิสัมพันธ์กับคน หรือกลไกอื่น ภายนอกระบบ<br>&nbsp;&nbsp;&nbsp; 2. ปฏิสัมพันธ์กับ Subsystem ในระบบ<br>&nbsp;&nbsp;&nbsp; หรือทั้ง 2 รูปแบบพร้อมๆ กัน ในการแยกแยะว่าสิ่งใดอยู่นอกหรืออยู่ในระบบ ขอให้ใช้บรรทัดฐานนี้<br>&nbsp;&nbsp;&nbsp; 1. สิ่งที่ทำหน้าที่ดำเนินกิจกรรมของระบบ หรือทำให้เกิดผลลัพธ์ต่างๆ ขึ้นในระบบ ให้ถือว่าสิ่งนั้นอยู่ในระบบ<br>&nbsp;&nbsp;&nbsp; 2. สิ่งที่ไม่ได้ทีหน้าที่ในการดำเนินกิจกรรมของระบบ แต่แสดงบทบาทเป็นผู้คาดหวังผลลัพธ์จากระบบ หรือทำหน้าที่ผลักดันให้เกิดกิจกรรมของระบบ หรอืทำหน้าที่ควบคุมดูแลกิจกรรมของระบบ ให้ถือว่าสิ่งนั้นอยู่ภายนอกระบบ<br>&nbsp;&nbsp;&nbsp; <strong>ตัวอย่าง 3.1</strong> โรงงานแห่งหนึ่งประกอบด้วยระบบการผลิต ระบบควบคุมคุณภาพ ซึ่งทำหน้าที่ในการควบคุมระบบการผลิต โดยในระบบการผลิตจะมีคนงานเป็นผู้ปฏิบัติงาน นอกจากนี้ โรงงานยังมีระบบการตลาดทำหน้าที่ขายผลิตภัณฑ์ต่างๆ ของโรงงาน โดยระบบการตลาดและระบบควบคุมคุณภาพจะมีผู้จัดการทำหน้าที่จัดการ<br>&nbsp;&nbsp;&nbsp; ผู้จัดการและคนงานทำหน้าที่ติดต่อกับระบบในฐานะผู้จัดการและผู้ดำเนินการ ถือว่า ทั้งสองอยู่ภายนอกระบบจะแสดงขอบเขตของระบบด้วยเส้นประ สิ่งที่อยู่ภายในเส้นประทั้งหมด คือ ระบบทั้งหมด จะเรียกสิ่งที่อยู่นอกขอบเขตของระบบแต่มีความสัมพันธ์ต่อระบบว่า Actor ซึ่งจะถือว่า ผู้จัดการและคนงานเป็น Actor ของระบบในโรงงานที่อยู่ภายในระบบ ประกอบด้วย 3 ระบบ ได้แก่ ระบบการผลิต ระบบควบคุมคุณภาพ ระบบการตลาด ซึ่งจะเรียกว่า Use Case
													<br><center><img src="../pic/f18.jpg"></center><br>&nbsp;&nbsp;&nbsp; Use Case จะทำหน้าที่อธิบายว่า ระบบทำงานอะไร ซึ่งตามหลักการของ OO แล้ว Use Case ถูกจัดเป็น Class ชนิดหนึ่ง สิ่งที่อยู่ภายนอกจะไม่สามารถมองเห็นรายละเอียดภายในได้ หรือเรียกได้ว่า Use Case จะมีเฉพาะ Outside View หรือ External View เท่านั้น<br>&nbsp;&nbsp;&nbsp; <strong>3.1.1 Use Case Diagram</strong><br>&nbsp;&nbsp;&nbsp; ในภาษา UML ใช้สัญลักษณ์วงรีแทน Use Case และใช้รูปคนแทน  Actor โดยทั้ง Use Case และ Actor ต้องมีชื่อที่ชัดเจน สื่อความได้ สำหรับปฏิสัมพันธ์ระหว่าง Actor และ Use Case จะใช้สัญลักษณ์ เส้นตรงมีหัวลูกศรจาก Actor ไปยัง Use Case และเรียก Diagram ที่ประกอบไปด้วย Use Case และ Actor ที่มีปฏิสัมพันธ์ต่อกันว่า Use Case Diagram
													<br><center><img src="../pic/f19.jpg"></center><br>&nbsp;&nbsp;&nbsp; <strong>3.1.2 Flow of Event และ Scenario</strong><br>&nbsp;&nbsp;&nbsp; ทุกๆ Use Case ต้องมีชื่อ ทำให้ทราบได้ว่า Use Case นั้นๆ จะมีกิจกรรมอะไรภายในบ้าง อย่างไร ด้วยชื่อของ Use Case อย่างเดียวอาจยังไม่ก่อให้เกิดความเข้าใจใน Use Case นั้นอย่างสมบูรณ์<br>&nbsp;&nbsp;&nbsp; เพื่อความเข้าใจใน Use Case แต่ละตัวอย่างถ่องแท้ เราสามารถอธิบายรายละเอียดของกิจกรรมใน Use Case แต่ละตัวในรูปแบบของภาษาเขียน ที่เรียกว่า Flow of Event เราจะเรียกแต่ละ Flow of Event ที่เป็นไปได้ทั้งหมดของ Use Case ว่า Scenario หากเปรียบ Use Case คือ  Class แล้ว Scenario จะเปรียบเสมือนเป็น Object ของ Use Case<br>&nbsp;&nbsp;&nbsp; ในการเขียน Flow of Event สิ่งที่ควรมีเสมอ คือ<br>&nbsp;&nbsp;&nbsp; 1. ลำดับกิจกรรมเมื่อ Use Case ดำเนินกิจกรรมตามปรกติเพียงหนึ่งเดียว (Main Flow of Event หรือ Main Flow)<br>&nbsp;&nbsp;&nbsp; 2. ลำดับกิจกรรมเมื่อ Use Case ดำเนินกิจกรรมผิดปรกติจำนวนเท่าใดก็ได้ (Exceptional Flow of Event หรือ Exception Flow)<br>&nbsp;&nbsp;&nbsp; 3. ใน Main Flow และ Exceptional Flow แต่ละตัว ต้องมีคำอธิบายถึงสาเหตุของการเริ่มต้นของกิจกรรม<br>&nbsp;&nbsp;&nbsp; 4. ใน Main Flow และ Exceptional Flow แต่ละตัว ต้องมีคำอธิบายถึงสาเหตุการสิ้นสุดหรือจบกิจกรรมของ Use Case
</div>
													<hr width="800" size=3> <br>
<table width="1000" border="0" align="center">
  <tr>
    <td align="center"><ul id="menunum">
  
  <li><a href="les3-1.php">1</a></li>
  <li><a href="les3-2.php">2</a></li>
  <li><a href="les3-3.php">3</a></li>
  <li><a href="les3-2.php">Next</a></li>
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
