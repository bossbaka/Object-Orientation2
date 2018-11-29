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

<div class="textbox"><h1>แบบทดสอบ บทที่ 10 สรุป</h1><br>
<script language="JavaScript">
<!--

var numQues = 10;
var numChoi = 4;

var answers = new Array(10);
answers[0] = "ในชีวิตประจำวัน เมื่อมองดูรอบๆ ตัวจะพบเห็นวัตถุ (Object) ต่างๆ มากมาย ไม่ว่าจะเป็นวัตถุที่สามารถมองเห็นได้และจับต้องได้ (Tangible Objects)";
answers[1] = "Abstract Data Type";
answers[2] = "กลุ่มของ Objects ที่มีความเหมือนหรือคล้ายคลึงกันในแง่ใดแง่หนึ่ง";
answers[3] = "สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute, Method และความหมายที่เหมือนๆ กัน";
answers[4] = "กระบวนการ เพิ่มเติมหรือทำให้ Diagram ที่ทำไว้แล้วในขั้นตอน Analysis มีความเหมาะสม และง่ายต่อการนำมาพัฒนาเป็นระบบงาน";
answers[5] = "กิจกรรม";
answers[6] = "การกระทำ";
answers[7] = "ระบบฐานข้อมูลที่อาศัย Relation หรือตาราง (Table)";
answers[8] = "Field Name";
answers[9] = "ตาราง";

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


<form name="quiz">
<p>1. Object Orientation คืออะไร<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="เป็นระบบที่มีการประมวลผลที่มีลักษณะคล้ายคลึงกับ Embedded System"> 
  เป็นระบบที่มีการประมวลผลที่มีลักษณะคล้ายคลึงกับ Embedded System<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="ปฏิสัมพันธ์กับคน หรือกลไกอื่น ภายนอกระบบ"> 
  ปฏิสัมพันธ์กับคน หรือกลไกอื่น ภายนอกระบบ<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="ปฏิสัมพันธ์กับ Subsystem ในระบบ"> 
  ปฏิสัมพันธ์กับ Subsystem ในระบบ<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="ในชีวิตประจำวัน เมื่อมองดูรอบๆ ตัวจะพบเห็นวัตถุ (Object) ต่างๆ มากมาย ไม่ว่าจะเป็นวัตถุที่สามารถมองเห็นได้และจับต้องได้ (Tangible Objects)"> 
  ในชีวิตประจำวัน เมื่อมองดูรอบๆ ตัวจะพบเห็นวัตถุ (Object) ต่างๆ มากมาย ไม่ว่าจะเป็นวัตถุที่สามารถมองเห็นได้และจับต้องได้ (Tangible Objects)</p>
<p><br>
</p>
<p>
  
  2. Abstractions เรียกอีกอย่างหนึ่งว่า<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="Data Type"> 
  Data Type<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="Abstract Data Type"> 
  Abstract Data Type<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="Datetime"> 
  Datetime<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="Attribute"> 
  Attribute
<p><br>
<p>

3. Abstractions หมายถึง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="ความคิดรวบยอดที่เรามีให้กับวัตถุ"> 
ความคิดรวบยอดที่เรามีให้กับวัตถุ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="แนวทางการพัฒนาโปรแกรมแบบเดิม"> 
แนวทางการพัฒนาโปรแกรมแบบเดิม<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="เป็นคุณสมบัติของ Object ต่างๆ"> 
เป็นคุณสมบัติของ Object ต่างๆ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="กลุ่มของ Objects ที่มีความเหมือนหรือคล้ายคลึงกันในแง่ใดแง่หนึ่ง"> 
กลุ่มของ Objects ที่มีความเหมือนหรือคล้ายคลึงกันในแง่ใดแง่หนึ่ง
<p><br>
<p>

4. Class คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute, Method และความหมายที่เหมือนๆ กัน"> 
สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute, Method และความหมายที่เหมือนๆ กัน<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="อธิบายว่าระบบทำงานอะไร ไม่ใช่ระบบทำงานอย่างไร"> 
อธิบายว่าระบบทำงานอะไร ไม่ใช่ระบบทำงานอย่างไร<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="การวิเคราะห์หาขอบเขตของ Model การวิเคราะห์เพื่อหา Actor และ Use Case "> 
การวิเคราะห์หาขอบเขตของ Model การวิเคราะห์เพื่อหา Actor และ Use Case <br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="เงื่อนไขหรือสถานการณ์ที่เป็นอยู่ในขณะใดขณะหนึ่งที่ Object หนึ่งๆ มีตัวตนอยู่"> 
เงื่อนไขหรือสถานการณ์ที่เป็นอยู่ในขณะใดขณะหนึ่งที่ Object หนึ่งๆ มีตัวตนอยู่
<p><br>
<p>

5. Refinement คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="จุดสิ้นสุดกิจกรรมใน Object"> 
จุดสิ้นสุดกิจกรรมใน Object<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="กระบวนการ เพิ่มเติมหรือทำให้ Diagram ที่ทำไว้แล้วในขั้นตอน Analysis มีความเหมาะสม และง่ายต่อการนำมาพัฒนาเป็นระบบงาน"> 
กระบวนการ เพิ่มเติมหรือทำให้ Diagram ที่ทำไว้แล้วในขั้นตอน Analysis มีความเหมาะสม และง่ายต่อการนำมาพัฒนาเป็นระบบงาน<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="การประมวลผลที่เกิดขึ้นกับ Object ซึ่งเป็นผลมาจาก Transition หนึ่งๆ"> 
การประมวลผลที่เกิดขึ้นกับ Object ซึ่งเป็นผลมาจาก Transition หนึ่งๆ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="อธิบายว่าระบบทำงานอะไร ไม่ใช่ระบบทำงานอย่างไร"> 
อธิบายว่าระบบทำงานอะไร ไม่ใช่ระบบทำงานอย่างไร
<p><br>
<p>

6. Activities แปลว่า<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="กิจกรรม"> 
กิจกรรม<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="ออกกำลังกาย"> 
ออกกำลังกาย<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="เต้น"> 
เต้น<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="กระโดด"> 
กระโดด
<p><br>
<p>

7. Actions แปลว่า<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="การกระทำ"> 
การกระทำ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="ทำอะไร"> 
ทำอะไร<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="อยู่ที่ไหน"> 
อยู่ที่ไหน<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="ไปไหนมา"> 
ไปไหนมา
<p><br>
<p>

8. Relational Database คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute"> 
สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="ระบบฐานข้อมูลที่อาศัย Relation หรือตาราง (Table)"> 
ระบบฐานข้อมูลที่อาศัย Relation หรือตาราง (Table)<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="ปฏิสัมพันธ์กับ Subsystem ในระบบ"> 
ปฏิสัมพันธ์กับ Subsystem ในระบบ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="ปฏิสัมพันธ์กับคน หรือกลไกอื่น ภายนอกระบบ"> 
ปฏิสัมพันธ์กับคน หรือกลไกอื่น ภายนอกระบบ
<p><br>
<p>

9. Data Item จะมีชื่อของตนเอง เรียกชื่อนั้นว่า<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="Field Name"> 
Field Name<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="Name"> 
Name<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="Username"> 
Username<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="Nickname"> 
Nickname
<p><br>
<p>

10. Table แปลว่า<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="ตาราง"> 
ตาราง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="สมุด"> 
สมุด<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="สี่เหลี่ยม"> 
สี่เหลี่ยม<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="เท"> 
เท<br>
<p>
<br>
<input type="button" value="ดูผลคะแนน" onClick="getScore(this.form)">
<input type="reset" value="ยกเลิก"><p><br>
ผลคะแนน = <input type=text size=15 name="percentage"  style="width:150px;height:20px"><br>
เฉลยคำตอบ:<br>
<textarea name="solutions" wrap="virtual" rows="4" cols="80" style="margin: 0px; height: 163px; width: 600px;"></textarea>
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
