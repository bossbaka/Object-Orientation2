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

<div class="textbox"><h1>แบบทดสอบ บทที่ 8 Activity Design</h1><br>
<script language="JavaScript">
<!--

var numQues = 10;
var numChoi = 4;

var answers = new Array(10);
answers[0] = "เงื่อนไขหรือสถานการณ์ที่เป็นอยู่ในขณะใดขณะหนึ่งที่ Object หนึ่งๆ มีตัวตนอยู่";
answers[1] = "จุดเริ่มต้นของกิจกรรมใน Object";
answers[2] = "จุดสิ้นสุดกิจกรรมใน Object";
answers[3] = "State ของ object ก่อนที่จะได้รับผลจาก Transition";
answers[4] = "State ของ object หลังจากเกิด Transition ขึ้นแล้ว";
answers[5] = "สิ่งที่ทำหน้าที่กระตุ้นให้เกิดการเปลี่ยน State";
answers[6] = "2";
answers[7] = "การประมวลผลที่เกิดขึ้นกับ Object ซึ่งเป็นผลมาจาก Transition หนึ่งๆ";
answers[8] = "วงกลมทึบ";
answers[9] = "วงกลมทึบภายในวงกลมใส";

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
<p>1. State หมายถึง<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="State จะต้องมีชื่อ ซึ่งทำหน้าที่ระบุ"> 
  State จะต้องมีชื่อ ซึ่งทำหน้าที่ระบุ<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="State chart Diagram ที่แสดงการทำงานของหลอดไฟ"> 
  State chart Diagram ที่แสดงการทำงานของหลอดไฟ<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="เงื่อนไขหรือสถานการณ์ที่เป็นอยู่ในขณะใดขณะหนึ่งที่ Object หนึ่งๆ มีตัวตนอยู่"> 
  เงื่อนไขหรือสถานการณ์ที่เป็นอยู่ในขณะใดขณะหนึ่งที่ Object หนึ่งๆ มีตัวตนอยู่<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="เกิดจากการรวมกันอย่างมีระบบ"> 
  เกิดจากการรวมกันอย่างมีระบบ</p>
<p><br>
</p>
<p>
  
  2. Initial State หมายถึง<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="จุดเริ่มต้นของกิจกรรมใน Object"> 
  จุดเริ่มต้นของกิจกรรมใน Object<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="เกิดจากการรวมกันอย่างมีระบบ"> 
  เกิดจากการรวมกันอย่างมีระบบ<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="State "> 
  State <br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="จุดสิ้นสุดกิจกรรมใน Object"> 
  จุดสิ้นสุดกิจกรรมใน Object
<p><br>
<p>

3. Final State หมายถึง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="จุดสิ้นสุดกิจกรรมใน Object"> 
จุดสิ้นสุดกิจกรรมใน Object<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="การประมวลผลที่เกิดขึ้นกับ Object"> 
การประมวลผลที่เกิดขึ้นกับ Object<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="สิ่งที่ทำหน้าที่กระตุ้นให้เกิดการเปลี่ยน State"> 
สิ่งที่ทำหน้าที่กระตุ้นให้เกิดการเปลี่ยน State<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="State ของ object หลังจากเกิด Transition ขึ้นแล้ว"> 
State ของ object หลังจากเกิด Transition ขึ้นแล้ว
<p><br>
<p>

4. Source State คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="State ของ object ก่อนที่จะได้รับผลจาก Transition"> 
State ของ object ก่อนที่จะได้รับผลจาก Transition<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="State ของ object หลังจากเกิด Transition ขึ้นแล้ว"> 
State ของ object หลังจากเกิด Transition ขึ้นแล้ว<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="สิ่งที่ทำหน้าที่กระตุ้นให้เกิดการเปลี่ยน State"> 
สิ่งที่ทำหน้าที่กระตุ้นให้เกิดการเปลี่ยน State<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="เป็นเงื่อนไขที่ระบุว่า เมื่อใดหรือด้วยเงื่อนไขใดที่ Event Trigger หนึ่งๆ จะเกิดขึ้น"> 
เป็นเงื่อนไขที่ระบุว่า เมื่อใดหรือด้วยเงื่อนไขใดที่ Event Trigger หนึ่งๆ จะเกิดขึ้น
<p><br>
<p>

5. Target State คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="State ของ object ก่อนที่จะได้รับผลจาก Transition"> 
State ของ object ก่อนที่จะได้รับผลจาก Transition<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="State ของ object หลังจากเกิด Transition ขึ้นแล้ว"> 
State ของ object หลังจากเกิด Transition ขึ้นแล้ว<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="สิ่งที่ทำหน้าที่กระตุ้นให้เกิดการเปลี่ยน State"> 
สิ่งที่ทำหน้าที่กระตุ้นให้เกิดการเปลี่ยน State<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="เป็นเงื่อนไขที่ระบุว่า เมื่อใดหรือด้วยเงื่อนไขใดที่ Event Trigger หนึ่งๆ จะเกิดขึ้น"> 
เป็นเงื่อนไขที่ระบุว่า เมื่อใดหรือด้วยเงื่อนไขใดที่ Event Trigger หนึ่งๆ จะเกิดขึ้น
<p><br>
<p>

6. Event Trigger คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="State ของ object ก่อนที่จะได้รับผลจาก Transition"> 
State ของ object ก่อนที่จะได้รับผลจาก Transition<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="State ของ object หลังจากเกิด Transition ขึ้นแล้ว"> 
State ของ object หลังจากเกิด Transition ขึ้นแล้ว<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="สิ่งที่ทำหน้าที่กระตุ้นให้เกิดการเปลี่ยน State"> 
สิ่งที่ทำหน้าที่กระตุ้นให้เกิดการเปลี่ยน State<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="การประมวลผลที่เกิดขึ้นกับ Object ซึ่งเป็นผลมาจาก Transition หนึ่งๆ"> 
การประมวลผลที่เกิดขึ้นกับ Object ซึ่งเป็นผลมาจาก Transition หนึ่งๆ
<p><br>
<p>

7. การทำ Statechart Diagram Refinement มีกี่แนวทาง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="1"> 
1<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="2"> 
2<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="3"> 
3<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="4"> 
4
<p><br>
<p>

8. Action คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="การประมวลผลที่เกิดขึ้นกับ Object ซึ่งเป็นผลมาจาก Transition หนึ่งๆ"> 
การประมวลผลที่เกิดขึ้นกับ Object ซึ่งเป็นผลมาจาก Transition หนึ่งๆ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="State ของ object หลังจากเกิด Transition ขึ้นแล้ว"> 
State ของ object หลังจากเกิด Transition ขึ้นแล้ว<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="จุดเริ่มต้นของกิจกรรมใน Object"> 
จุดเริ่มต้นของกิจกรรมใน Object<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="สิ่งที่ทำหน้าที่กระตุ้นให้เกิดการเปลี่ยน State"> 
สิ่งที่ทำหน้าที่กระตุ้นให้เกิดการเปลี่ยน State
<p><br>
<p>

9. Initial State ใช้รูปอะไร<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="วงกลมใส"> 
วงกลมใส<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="สี่เหลี่ยม"> 
สี่เหลี่ยม<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="วงกลมทึบ"> 
วงกลมทึบ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="สามเหลี่ยม"> 
สามเหลี่ยม
<p><br>
<p>

10. Final State ใช้รูปอะไร<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="วงกลมใส"> 
วงกลมใส<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="วงกลมทึบภายในวงกลมใส"> 
วงกลมทึบภายในวงกลมใส<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="สี่เหลี่ยมคางหมู"> 
สี่เหลี่ยมคางหมู<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="หกเหลี่ยม"> 
หกเหลี่ยม<br>
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
