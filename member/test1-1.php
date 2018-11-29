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


<div class="textbox">
<script language="JavaScript">
<!--

var numQues = 10;
var numChoi = 4;

var answers = new Array(10);
answers[0] = "วัตถุ (Object) ต่างๆ มากมาย ที่สามารถจับต้องได้และไม่สามารถจับต้องได้";
answers[1] = "ความคิดรวบยอดที่เรามีให้กับวัตถุนั้นๆ ภายใต้กรอบที่กำหนด (Domain)";
answers[2] = "ความเกี่ยวข้องกัน หรือความสัมพันธ์ระหว่าง Objects 2 ตัว	ขึ้นไป";
answers[3] = "ปฏิสัมพันธ์ หรือการกระทำใดๆ ที่เกิดขึ้นระหว่าง Objects 2 ตัว ขึ้นไป ";
answers[4] = "ความสามารถในการทำกิจกรรมของ Object ที่มีไว้เพื่อให้ Object อื่นๆ ใน Domain";
answers[5] = "3 ขั้นตอน";
answers[6] = "Object-Oriented Software Engineering";
answers[7] = "เป็นขั้นตอนการสร้างหนทางแก้ปัญหาในรายละเอียดให้เกิดขึ้นและใช้งานได้จริง";
answers[8] = "การวิเคราะห์และออกแบบเชิงวัตถุ";
answers[9] = "Object-Oriented Design";


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
</script>
<h1>แบบทดสอบ บทที่ 1 Object Orientation และ UML </h1>
<br>
<form name="quiz">
  <p>1. Object Orientation คืออะไร<br>
  &nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="ความคิดรวบยอดที่เรามีให้กับวัตถุนั้นๆ"> 
  ความคิดรวบยอดที่เรามีให้กับวัตถุนั้นๆ<br>
  &nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="วัตถุ (Object) ต่างๆ มากมาย ที่สามารถจับต้องได้และไม่สามารถจับต้องได้"> 
  วัตถุ (Object) ต่างๆ มากมาย ที่สามารถจับต้องได้และไม่สามารถจับต้องได้<br>
  &nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="เป็นคุณสมบัติของ Object ต่างๆ โดยที่คุณสมบัติดังกล่าวนี้เป็นคุณสมบัติ	ที่เราสนใจ"> 
  เป็นคุณสมบัติของ Object ต่างๆ โดยที่คุณสมบัติดังกล่าวนี้เป็นคุณสมบัติ	ที่เราสนใจ<br>
  &nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="เป็นขั้นตอนการวิเคราะห์"> 
  เป็นขั้นตอนการวิเคราะห์</p>
<p><br>
</p>
<p>
  
  2. Concept หมายถึง<br>
    &nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="ความคิดรวบยอดที่เรามีให้กับวัตถุนั้นๆ ภายใต้กรอบที่กำหนด (Domain)"> 
  ความคิดรวบยอดที่เรามีให้กับวัตถุนั้นๆ ภายใต้กรอบที่กำหนด (Domain)<br>
    &nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="เป็นคุณสมบัติของ Object ต่างๆ โดยที่คุณสมบัติดังกล่าวนี้เป็นคุณสมบัติ	"> 
  เป็นคุณสมบัติของ Object ต่างๆ โดยที่คุณสมบัติดังกล่าวนี้เป็นคุณสมบัติ	<br>
    &nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="กิจกรรมคนรับประทานอาหาร เกิดจาก Interaction “รับประทานอาหาร” "> 
  กิจกรรมคนรับประทานอาหาร เกิดจาก Interaction “รับประทานอาหาร” <br>
    &nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="	เราสามารถนำเอา Object Orientation มาใช้เป็นแนวคิดและเป็นบรรทัดฐานในการวิเคราะห์">	
  เราสามารถนำเอา Object Orientation มาใช้เป็นแนวคิดและเป็นบรรทัดฐานในการวิเคราะห์
<p><br>
<p>

3. Relationship คือ<br>  &nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="	เราสามารถนำเอา Object Orientation มาใช้เป็นแนวคิดและเป็นบรรทัดฐานในการวิเคราะห์">
	เราสามารถนำเอา Object Orientation มาใช้เป็นแนวคิดและเป็นบรรทัดฐานในการวิเคราะห์<br>  &nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="เป็นขั้นตอนการวิเคราะห์"> 
เป็นขั้นตอนการวิเคราะห์<br>  &nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="ความเกี่ยวข้องกัน หรือความสัมพันธ์ระหว่าง Objects 2 ตัว	ขึ้นไป"> 
ความเกี่ยวข้องกัน หรือความสัมพันธ์ระหว่าง Objects 2 ตัว	ขึ้นไป<br>  &nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="ความคิดรวบยอดที่เรามีให้กับวัตถุนั้นๆ ภายใต้กรอบที่กำหนด (Domain)"> 
ความคิดรวบยอดที่เรามีให้กับวัตถุนั้นๆ ภายใต้กรอบที่กำหนด (Domain)
<p><br>
<p>

4. Interaction คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="ความเกี่ยวข้องกัน หรือความสัมพันธ์ระหว่าง Objects 2 ตัว	ขึ้นไป"> 
ความเกี่ยวข้องกัน หรือความสัมพันธ์ระหว่าง Objects 2 ตัว	ขึ้นไป<br>
&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="ความคิดรวบยอดที่เรามีให้กับวัตถุนั้นๆ ภายใต้กรอบที่กำหนด (Domain)"> 
ความคิดรวบยอดที่เรามีให้กับวัตถุนั้นๆ ภายใต้กรอบที่กำหนด (Domain)<br>
&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="เป็นขั้นตอนการวิเคราะห์"> 
เป็นขั้นตอนการวิเคราะห์<br>
&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="ปฏิสัมพันธ์ หรือการกระทำใดๆ ที่เกิดขึ้นระหว่าง Objects 2 ตัว ขึ้นไป "> 
ปฏิสัมพันธ์ หรือการกระทำใดๆ ที่เกิดขึ้นระหว่าง Objects 2 ตัว ขึ้นไป 
<p><br>
<p>

5. Function หมายถึง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="ปฏิสัมพันธ์ หรือการกระทำใดๆ ที่เกิดขึ้นระหว่าง Objects 2 ตัว ขึ้นไป "> 
ปฏิสัมพันธ์ หรือการกระทำใดๆ ที่เกิดขึ้นระหว่าง Objects 2 ตัว ขึ้นไป <br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="ความคิดรวบยอดที่เรามีให้กับวัตถุนั้นๆ ภายใต้กรอบที่กำหนด (Domain)"> 
ความคิดรวบยอดที่เรามีให้กับวัตถุนั้นๆ ภายใต้กรอบที่กำหนด (Domain)<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="ความเกี่ยวข้องกัน หรือความสัมพันธ์ระหว่าง Objects 2 ตัว	ขึ้นไป"> 
ความเกี่ยวข้องกัน หรือความสัมพันธ์ระหว่าง Objects 2 ตัว	ขึ้นไป<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="ความสามารถในการทำกิจกรรมของ Object ที่มีไว้เพื่อให้ Object อื่นๆ ใน Domain"> 
ความสามารถในการทำกิจกรรมของ Object ที่มีไว้เพื่อให้ Object อื่นๆ ใน Domain
<p><br>
<p>

6. Object-Oriented Software Engineering ประกอบด้วยกี่ขั้นตอน<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="2 ขั้นตอน"> 
2 ขั้นตอน<br>
&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="3 ขั้นตอน"> 
3 ขั้นตอน<br>
&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="4 ขั้นตอน"> 
4 ขั้นตอน<br>
&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="5 ขั้นตอน"> 
5 ขั้นตอน
<p><br>
<p>

7. OOSE ย่อมาจาก<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="Object-Oriented Implementation"> 
Object-Oriented Implementation<br>
&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="Object-Oriented Design"> 
Object-Oriented Design<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="Object-Oriented Analysis"> 
Object-Oriented Analysis<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="Object-Oriented Software Engineering"> 
Object-Oriented Software Engineering
<p><br>
<p>

8. Object-Oriented Programming (OOP) คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="เป็นขั้นตอนการสร้างหนทางแก้ปัญหาในรายละเอียดให้เกิดขึ้นและใช้งานได้จริง"> 
เป็นขั้นตอนการสร้างหนทางแก้ปัญหาในรายละเอียดให้เกิดขึ้นและใช้งานได้จริง<br>
&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="เป็นขั้นตอนการออกแบบหรือจำลอง (Model)"> 
เป็นขั้นตอนการออกแบบหรือจำลอง (Model)<br>
&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="เป็นขั้นตอนการวิเคราะห์"> 
เป็นขั้นตอนการวิเคราะห์<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="ความเกี่ยวข้องกัน หรือความสัมพันธ์ระหว่าง Objects 2 ตัว	ขึ้นไป"> 
ความเกี่ยวข้องกัน หรือความสัมพันธ์ระหว่าง Objects 2 ตัว	ขึ้นไป
<p><br>
<p>

9. Object Oriented Analysis and Design แปลว่า<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="การวิเคราะห์และออกแบบเชิงวัตถุ"> 
การวิเคราะห์และออกแบบเชิงวัตถุ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="ปฏิสัมพันธ์"> 
ปฏิสัมพันธ์<br>
&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="ความเกี่ยวข้องกัน"> 
ความเกี่ยวข้องกัน<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="ความสัมพันธ์"> 
ความสัมพันธ์
<p><br>
<p>

10. OOD ย่อมาจาก<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="Object-Oriented Design"> 
Object-Oriented Design<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="Object-Oriented Software Engineering "> 
Object-Oriented Software Engineering <br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="Object Oriented Analysis and Design"> 
Object Oriented Analysis and Design<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="Domain of interest"> 
Domain of interest<br>
<p>

<br>

<input type="button" value="ดูผลคะแนน" onClick="getScore(this.form)">
<input type="reset" value="ยกเลิก"><p><br>
ผลคะแนน = <input type=text size=15 name="percentage" style="width:150px;height:20px"><br>
เฉลยคำตอบ:<br>
<textarea name="solutions" cols="80" rows="4" wrap="virtual" style="margin: 0px; height: 163px; width: 600px;"></textarea>
</form>

</div>

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
