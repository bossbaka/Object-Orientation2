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
<h1>แบบทดสอบ บทที่ 9 System Architecture Design</h1><br>
<script language="JavaScript">
<!--

var numQues = 10;
var numChoi = 4;

var answers = new Array(10);
answers[0] = "1..n";
answers[1] = "ฝั่ง Subclass";
answers[2] = "สัญลักษณ์สี่เหลี่ยมลูกบาศก์";
answers[3] = "คนประกอบด้วยอวัยวะต่างๆ";
answers[4] = "การออกแบบระบบ";
answers[5] = "ไม่มีข้อถูก";
answers[6] = "การเชื่อมโยง";
answers[7] = "ถูกทุกข้อ";
answers[8] = "อ่าน";
answers[9] = "การแจกแบบสอบถาม";

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
<p>1. Problem Domain: อาคารเรียน ประกอบด้วย ห้องเรียนมากกว่า 1 ห้องเสมอ จะได้ Cardinality เท่าใด<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="1..1"> 
  1..1<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="0..1"> 
  0..1<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="1..n"> 
  1..n<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="1..10"> 
  1..10</p>
<p><br>
</p>
<p>
  
  2. การเขียน Cardinality จะเขียนไว้ส่วนใด<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="ฝั่ง Subclass"> 
  ฝั่ง Subclass<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="ฝั่ง Superclass"> 
  ฝั่ง Superclass<br>&nbsp;	
  &nbsp;	
  <input type="radio" nam&nbsp;	
  &nbsp;	e="q2" value="บน Relationship"> 
  บน Relationship<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="ไม่มีข้อถูก"> 
  ไม่มีข้อถูก
<p><br>
<p>

3. สัญลักษณ์ที่ใช้ใน Deployment Diagram<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="สัญลักษณ์สี่เหลี่ยมลูกบาศก์"> 
สัญลักษณ์สี่เหลี่ยมลูกบาศก์<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="วงกลม"> 
วงกลม<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="กระบอก"> 
กระบอก<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="พีระมิด"> 
พีระมิด
<p><br>
<p>

4. ข้อใดคือ Generalization Abstraction<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="คนประกอบด้วยอวัยวะต่างๆ"> 
คนประกอบด้วยอวัยวะต่างๆ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="นายต้นกล้าเป็นนักศึกษาชาย"> 
นายต้นกล้าเป็นนักศึกษาชาย<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="สมศรีเป็นครูสอนภาษาอังกฤษให้น้องลูกน้ำ"> 
สมศรีเป็นครูสอนภาษาอังกฤษให้น้องลูกน้ำ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="ฐานะของบุคคลสามารถแบ่งได้เป็น ฐานะร่ำรวยและยากจน"> 
ฐานะของบุคคลสามารถแบ่งได้เป็น ฐานะร่ำรวยและยากจน
<p><br>
<p>

5. การออกแบบฐานข้อมูลอยู่ในขั้นตอนใด <br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="การวิเคราะห์ระบบ"> 
การวิเคราะห์ระบบ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="การออกแบบระบบ"> 
การออกแบบระบบ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="การติดตั้งระบบ"> 
การติดตั้งระบบ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="การเขียนโปรแกรม"> 
การเขียนโปรแกรม
<p><br>
<p>

6. Problem Domain: บุรษไปรษณีย์ส่งจดหมายถึงคุณหมอ ข้อใดคือ Relationship <br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="เจ้าของจดหมาย"> 
เจ้าของจดหมาย<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="จัดส่งจดหมาย"> 
จัดส่งจดหมาย<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="ผู้รับจดหมาย"> 
ผู้รับจดหมาย<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="ไม่มีข้อถูก"> 
ไม่มีข้อถูก
<p><br>
<p>

7. Connections แปลว่า<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="การเชื่อมโยง"> 
การเชื่อมโยง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="ถัดไป"> 
ถัดไป<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="ย้อนกลับ"> 
ย้อนกลับ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="อยู่ที่เดิม"> 
อยู่ที่เดิม
<p><br>
<p>

8. นายแม็คชวนนางสาวติ๊กเต้นรำ อะไรคือ Object<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="นายแม็ค"> 
นายแม็ค<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="ชวนเต้นรำ"> 
ชวนเต้นรำ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="นางสาวติ๊ก"> 
นางสาวติ๊ก<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="ถูกทุกข้อ"> 
ถูกทุกข้อ
<p><br>
<p>

9. นายหนึ่งอ่านหนังสือการ์ตูนขายหัวเราะ อะไรคือ Function<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="นายหนึ่ง"> 
นายหนึ่ง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="หนังสือการ์ตูนขายหัวเราะ"> 
หนังสือการ์ตูนขายหัวเราะ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="อ่าน"> 
อ่าน<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="นายหนึ่งเป็นเจ้าของหนังสือ"> 
นายหนึ่งเป็นเจ้าของหนังสือ
<p><br>
<p>

10. วิธีการเก็บรวบรวมข้อมูลแบบใดเหมาะสมกับกลุ่มผู้ใช้จำนวนมาก<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="การสัมภาษณ์"> 
การสัมภาษณ์<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="การแจกแบบสอบถาม"> 
การแจกแบบสอบถาม<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="การสังเกตการณ์"> 
การสังเกตการณ์<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="ถูกทุกข้อ"> 
ถูกทุกข้อ<br>
<p>
<br>
<input type="button" value="ดูผลคะแนน" onClick="getScore(this.form)">
<input type="reset" value="ยกเลิก"><p><br>
ผลคะแนน = <input type=text size=15 name="percentage" style="width:150px;height:20px"><br>
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
