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
<title>	แบบทดสอบ</title>
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
<div class="test"></div>
<br>

<br>
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

<div class="textbox"><script language="JavaScript">
<!--

var numQues = 10;
var numChoi = 4;

var answers = new Array(10);
answers[0] = "กระบวนการ เพิ่มเติมหรือทำให้ Diagram ที่ทำไว้แล้วในขั้นตอน Analysis มีความเหมาะสม";
answers[1] = "ผลจากการให้ Concept กับ Objects นั้นทำให้เกิดการจัดกลุ่มของ Objects ขึ้น";
answers[2] = "เป็นขั้นตอนการออกแบบหรือจำลอง (Model)";
answers[3] = "เป็นขั้นตอนการวิเคราะห์ เพื่อให้ทราบว่า Problem Domain คืออะไร";
answers[4] = "สมชายเป็น Object ของ Class ผู้ชายแต่งงานกับ สมหญิง ที่เป็น Object ของ Class ผู้หญิง";
answers[5] = "แนวทางการพัฒนาโปรแกรมแบบเดิม";
answers[6] = "รถ";
answers[7] = "เสียง";
answers[8] = "ความเคลื่อนไหว";
answers[9] = "Object Oriented Analysis";

function getScore(form) {
  var score = 0;
  var currElt;
  var currSelection;

  for (i=0; i<numQues; i++) {
    currElt = i*numChoi;
    for (j=0; j<numChoi; j++) {
      currSelection = form.elements[currElt + j];
      if (currSelection.checked) {
        if (currSelection.value == answers[i]) {
          score++;
          break;
        }
      }
    }
  }

  score = Math.round(score/numQues*10);
  form.percentage.value = score + "";

  var correctAnswers = "";
  for (i=1; i<=numQues; i++) {
    correctAnswers += i + ". " + answers[i-1] + "\r\n";
  }
  form.solutions.value = correctAnswers;

}

// -->
</script><h1>แบบทดสอบ บทที่ 6 OOA Refinement</h1>
<br>

<form name="quiz">
<p>1. Refinement คือ<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="พิจารณาว่าแต่ละ Use Case นั้นสามารถแยกแยะออกมาเป็น Use Case ย่อยๆ "> 
  พิจารณาว่าแต่ละ Use Case นั้นสามารถแยกแยะออกมาเป็น Use Case ย่อยๆ <br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="สร้างความสัมพันธ์ระหว่าง Use Case เดิม"> 
  สร้างความสัมพันธ์ระหว่าง Use Case เดิม<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="สร้าง Use Case List"> 
  สร้าง Use Case List<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="กระบวนการ เพิ่มเติมหรือทำให้ Diagram ที่ทำไว้แล้วในขั้นตอน Analysis มีความเหมาะสม"> 
  กระบวนการ เพิ่มเติมหรือทำให้ Diagram ที่ทำไว้แล้วในขั้นตอน Analysis มีความเหมาะสม</p>
<p><br>
</p>
<p>
  
  2. Class คือ<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="ผลจากการให้ Concept กับ Objects นั้นทำให้เกิดการจัดกลุ่มของ Objects ขึ้น"> 
  ผลจากการให้ Concept กับ Objects นั้นทำให้เกิดการจัดกลุ่มของ Objects ขึ้น<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="เราเรียกกระบวนการในการให้ Concept กับ Object"> 
  เราเรียกกระบวนการในการให้ Concept กับ Object<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="เป็นคุณสมบัติของ Object ต่างๆ"> 
  เป็นคุณสมบัติของ Object ต่างๆ<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="Object-Oriented Design"> 
  Object-Oriented Design
<p><br>
<p>

3. Object-Oriented Design คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="เป็นคุณสมบัติของ Object ต่างๆ"> 
เป็นคุณสมบัติของ Object ต่างๆ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="เป็นขั้นตอนการออกแบบหรือจำลอง (Model)"> 
เป็นขั้นตอนการออกแบบหรือจำลอง (Model)<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="ได้เรียนรู้แนวความคิดโดยรวมของ Object Orientation"> 
ได้เรียนรู้แนวความคิดโดยรวมของ Object Orientation<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="กระบวนการในการให้ Concept กับ Object"> 
กระบวนการในการให้ Concept กับ Object
<p><br>
<p>

4. Object-Oriented Analysis คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="ความสามารถในการทำกิจกรรมของ Object"> 
ความสามารถในการทำกิจกรรมของ Object<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="กระบวนการในการให้ Concept กับ Object"> 
กระบวนการในการให้ Concept กับ Object<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="ได้เรียนรู้แนวความคิดโดยรวมของ Object Orientation"> 
ได้เรียนรู้แนวความคิดโดยรวมของ Object Orientation<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="เป็นขั้นตอนการวิเคราะห์ เพื่อให้ทราบว่า Problem Domain คืออะไร"> 
เป็นขั้นตอนการวิเคราะห์ เพื่อให้ทราบว่า Problem Domain คืออะไร
<p><br>
<p>

5. “สมชาย แต่งงานกับ สมหญิง” จะหมายถึง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="สมชายเป็น Object ของ Class ผู้ชายแต่งงานกับ สมหญิง ที่เป็น Object ของ Class ผู้หญิง"> 
สมชายเป็น Object ของ Class ผู้ชายแต่งงานกับ สมหญิง ที่เป็น Object ของ Class ผู้หญิง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="สมชายเป็น Class ของ Class ผู้ชายแต่งงานกับ สมหญิง ที่เป็น Object ของ Class ผู้หญิง"> 
สมชายเป็น Class ของ Class ผู้ชายแต่งงานกับ สมหญิง ที่เป็น Object ของ Class ผู้หญิง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="สมชายเป็น Class ของ Class ผู้ชายแต่งงานกับ สมหญิง ที่เป็น Class ของ Class ผู้หญิง"> 
สมชายเป็น Class ของ Class ผู้ชายแต่งงานกับ สมหญิง ที่เป็น Class ของ Class ผู้หญิง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="สมชายเป็น Object ของ Object ผู้ชายแต่งงานกับ สมหญิง ที่เป็น Object ของ Object ผู้หญิง"> 
สมชายเป็น Object ของ Object ผู้ชายแต่งงานกับ สมหญิง ที่เป็น Object ของ Object ผู้หญิง
<p><br>
<p>

6. Traditional System Analysis and Design แปลว่า<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="แนวทางการพัฒนาโปรแกรมแบบเดิม"> 
แนวทางการพัฒนาโปรแกรมแบบเดิม<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="วิ่งไปบนถนนมิตรภาพ"> 
วิ่งไปบนถนนมิตรภาพ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="ความคิดรวบยอดที่เรามีให้กับวัตถุ"> 
ความคิดรวบยอดที่เรามีให้กับวัตถุ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="กระบวนการ"> 
กระบวนการ
<p><br>
<p>

7. สิ่งที่สามารถจับต้องได้ คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="รถ"> 
รถ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="ลม"> 
ลม<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="เสียง"> 
เสียง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="แสง"> 
แสง
<p><br>
<p>

8. สิ่งที่ไม่สามารถจับต้องได้ คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="มด"> 
มด<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="โทรศัพท์"> 
โทรศัพท์<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="เสียง"> 
เสียง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="คอมพิวเตอร์"> 
คอมพิวเตอร์
<p><br>
<p>

9. Movement แปลว่า<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="โทรศัพท์"> 
โทรศัพท์<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="ความเคลื่อนไหว"> 
ความเคลื่อนไหว<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="เดิน"> 
เดิน<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="กิจกรรม"> 
กิจกรรม
<p><br>
<p>

10. OOA ย่อมาจาก<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="Object-Oriented Design"> 
Object-Oriented Design<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="Object-Oriented Software Engineering "> 
Object-Oriented Software Engineering <br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="Object Oriented Analysis"> 
Object Oriented Analysis<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="Domain of interest"> 
Domain of interest<br>
<p><br>

<input type="button" value="ดูผลคะแนน" onClick="getScore(this.form)">
<input type="reset" value="ยกเลิก"><p><br>
ผลคะแนน = <input type=text size=15 name="percentage" style="width:150px;height:20px"><br>
เฉลยคำตอบ:<br>
<textarea name="solutions" wrap="virtual" rows="4" cols="80"  style="margin: 0px; height: 163px; width: 600px;"></textarea>
</form></div>
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
