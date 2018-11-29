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
answers[0] = "Interaction Diagram";
answers[1] = "2";
answers[2] = "Object ที่มีส่วนร่วมอยู่ใน Interaction Diagram ที่สามารถระบุ Unique Identity ของ Object นั้นได้";
answers[3] = "Object ที่มีส่วนร่วมอยู่ใน Interaction Diagram ที่ยังไม่สามารถระบุ Unique Identity  นั้นได้อย่างแน่นอนตายตัว";
answers[4] = "อธิบาย Name และ Type แทน Object ที่มีส่วนร่วมใน Interaction Diagram";
answers[5] = "สิ่งที่เชื่อมโยง Objects ตัวเข้าด้วยกัน";
answers[6] = "5";
answers[7] = "Message ที่ Sender ใช้เรียก Method ของ Receiver";
answers[8] = "Message ที่ Object ตัวหนึ่ง ส่งไปยัง Object อีกตัวหนึ่ง เพื่อให้ Object ที่ได้รับ Message ทำลายตัวเอง";
answers[9] = "Message ที่ Object ตัวหนึ่งส่งไปโดยมีจุดประสงค์เพื่อให้เกิดการสร้าง Object ของ Class ขึ้น";

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


<h1>แบบทดสอบ บทที่ 5 Interaction Modeling</h1>
<br>
<form name="quiz">
<p>1. Object เป็นองค์ประกอบแรกของ อะไร<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q1" value="Interaction Diagram"> 
  Interaction Diagram<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q1" value="Diagram"> 
  Diagram<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q1" value="Class Diagram"> 
  Class Diagram<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q1" value="ER-Diagram"> 
  ER-Diagram</p>
<p><br>
</p>
<p>
  
  2. Interaction Diagram แบ่งออกเป็นกี่ประเภท<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q2" value="1"> 
  1<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q2" value="2"> 
  2<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q2" value="3"> 
  3<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q2" value="4"> 
  4
<p><br>
<p>

3. Concrete Object หมายถึง<br>&nbsp;	
  &nbsp;
<input type="radio" name="q3" value="Object ที่มีส่วนร่วมอยู่ใน Interaction Diagram ที่ยังไม่สามารถระบุ Unique Identity  นั้นได้"> 
Object ที่มีส่วนร่วมอยู่ใน Interaction Diagram ที่ยังไม่สามารถระบุ Unique Identity  นั้นได้<br>&nbsp;	
  &nbsp;
<input type="radio" name="q3" value="ปฏิสัมพันธ์กับคน หรือกลไกอื่น ภายนอกระบบ"> 
ปฏิสัมพันธ์กับคน หรือกลไกอื่น ภายนอกระบบ<br>&nbsp;	
  &nbsp;
<input type="radio" name="q3" value="เป็นผู้รับ Message และดำเนินการตาม Message"> 
เป็นผู้รับ Message และดำเนินการตาม Message<br>&nbsp;	
  &nbsp;
<input type="radio" name="q3" value="Object ที่มีส่วนร่วมอยู่ใน Interaction Diagram ที่สามารถระบุ Unique Identity ของ Object นั้นได้"> 
Object ที่มีส่วนร่วมอยู่ใน Interaction Diagram ที่สามารถระบุ Unique Identity ของ Object นั้นได้
<p><br>
<p>

4. Prototypical Object หมายถึง<br>&nbsp;	
  &nbsp;
<input type="radio" name="q4" value="Object ที่มีส่วนร่วมอยู่ใน Interaction Diagram ที่ยังไม่สามารถระบุ Unique Identity  นั้นได้อย่างแน่นอนตายตัว"> 
Object ที่มีส่วนร่วมอยู่ใน Interaction Diagram ที่ยังไม่สามารถระบุ Unique Identity  นั้นได้อย่างแน่นอนตายตัว<br>&nbsp;	
  &nbsp;
<input type="radio" name="q4" value="การคงอยู่ของวัตถุ"> 
การคงอยู่ของวัตถุ<br>&nbsp;	
  &nbsp;
<input type="radio" name="q4" value="ประกอบไปด้วย Use Case และ Actor ที่มีปฏิสัมพันธ์ต่อกัน"> 
ประกอบไปด้วย Use Case และ Actor ที่มีปฏิสัมพันธ์ต่อกัน<br>&nbsp;	
  &nbsp;
<input type="radio" name="q4" value="Object ที่มีส่วนร่วมอยู่ใน Interaction Diagram ที่สามารถระบุ Unique Identity ของ Object นั้นได้"> 
Object ที่มีส่วนร่วมอยู่ใน Interaction Diagram ที่สามารถระบุ Unique Identity ของ Object นั้นได้
<p><br>
<p>

5. ในทาง UML จะใช้สัญลักษณ์สี่เหลี่ยม ใช้ทำอะไร<br>&nbsp;	
  &nbsp;
<input type="radio" name="q5" value="ปฏิสัมพันธ์กับคน หรือกลไกอื่น ภายนอกระบบ"> 
ปฏิสัมพันธ์กับคน หรือกลไกอื่น ภายนอกระบบ<br>&nbsp;	
  &nbsp;
<input type="radio" name="q5" value="เป็นผู้รับ Message และดำเนินการตาม Message"> 
เป็นผู้รับ Message และดำเนินการตาม Message<br>&nbsp;	
  &nbsp;
<input type="radio" name="q5" value="อธิบาย Name และ Type แทน Object ที่มีส่วนร่วมใน Interaction Diagram"> 
อธิบาย Name และ Type แทน Object ที่มีส่วนร่วมใน Interaction Diagram<br>&nbsp;	
  &nbsp;
<input type="radio" name="q5" value="หาสูตรสี่เหลี่ยม"> 
หาสูตรสี่เหลี่ยม
<p><br>
<p>

6. Links หมายถึง<br>&nbsp;	
  &nbsp;
<input type="radio" name="q6" value="ความกว้าง"> 
ความกว้าง<br>&nbsp;	
  &nbsp;
<input type="radio" name="q6" value="ความยาว"> 
ความยาว<br>&nbsp;	
  &nbsp;
<input type="radio" name="q6" value="หลากหลายสีสัน"> 
หลากหลายสีสัน<br>&nbsp;	
  &nbsp;
<input type="radio" name="q6" value="สิ่งที่เชื่อมโยง Objects ตัวเข้าด้วยกัน"> 
สิ่งที่เชื่อมโยง Objects ตัวเข้าด้วยกัน
<p><br>
<p>

7. Message แบ่งออกเป็น กี่ประเภท<br>&nbsp;	
  &nbsp;
<input type="radio" name="q7" value="6"> 
6<br>&nbsp;	
  &nbsp;
<input type="radio" name="q7" value="5"> 
5<br>&nbsp;	
  &nbsp;
<input type="radio" name="q7" value="4"> 
4<br>&nbsp;	
  &nbsp;
<input type="radio" name="q7" value="3"> 
3
<p><br>
<p>

8. Call หมายถึง<br>&nbsp;	
  &nbsp;
<input type="radio" name="q8" value="Message ที่ Object ตัวหนึ่ง ส่งไปยัง Object อีกตัวหนึ่ง เพื่อให้ Object ที่ได้รับ Message ทำลายตัวเอง"> 
Message ที่ Object ตัวหนึ่ง ส่งไปยัง Object อีกตัวหนึ่ง เพื่อให้ Object ที่ได้รับ Message ทำลายตัวเอง<br>&nbsp;	
  &nbsp;
<input type="radio" name="q8" value="Message ที่ใช้เพื่อส่งข้อมูลที่ถูกร้องขอโดย Sender"> 
Message ที่ใช้เพื่อส่งข้อมูลที่ถูกร้องขอโดย Sender<br>&nbsp;	
  &nbsp;
<input type="radio" name="q8" value="สัญญาณบางอย่างที่ Object ตัวหนึ่งส่งไปเพื่อบอก"> 
สัญญาณบางอย่างที่ Object ตัวหนึ่งส่งไปเพื่อบอก<br>&nbsp;	
  &nbsp;
<input type="radio" name="q8" value="Message ที่ Sender ใช้เรียก Method ของ Receiver"> 
Message ที่ Sender ใช้เรียก Method ของ Receiver
<p><br>
<p>

9. Destroy<br>&nbsp;	
  &nbsp;
<input type="radio" name="q9" value="Message ที่ Object ตัวหนึ่ง ส่งไปยัง Object อีกตัวหนึ่ง เพื่อให้ Object ที่ได้รับ Message ทำลายตัวเอง"> 
Message ที่ Object ตัวหนึ่ง ส่งไปยัง Object อีกตัวหนึ่ง เพื่อให้ Object ที่ได้รับ Message ทำลายตัวเอง<br>&nbsp;	
  &nbsp;
<input type="radio" name="q9" value="Message ที่ Sender ใช้เรียก Method ของ Receiver"> 
Message ที่ Sender ใช้เรียก Method ของ Receiver<br>&nbsp;	
  &nbsp;
<input type="radio" name="q9" value="สัญญาณบางอย่างที่ Object ตัวหนึ่งส่งไปเพื่อบอกหรือกระตุ้น "> 
สัญญาณบางอย่างที่ Object ตัวหนึ่งส่งไปเพื่อบอกหรือกระตุ้น <br>&nbsp;	
  &nbsp;
<input type="radio" name="q9" value="Message ที่ Object ตัวหนึ่งส่งไปโดยมีจุดประสงค์เพื่อให้เกิดการสร้าง Object ของ Class ขึ้น"> 
Message ที่ Object ตัวหนึ่งส่งไปโดยมีจุดประสงค์เพื่อให้เกิดการสร้าง Object ของ Class ขึ้น
<p><br>
<p>

10. Create หมายถึง<br>&nbsp;	
  &nbsp;
<input type="radio" name="q10" value="ปฏิสัมพันธ์กับคน หรือกลไกอื่น ภายนอกระบบ"> 
ปฏิสัมพันธ์กับคน หรือกลไกอื่น ภายนอกระบบ<br>&nbsp;	
  &nbsp;
<input type="radio" name="q10" value="เป็นผู้รับ Message และดำเนินการตาม Message"> 
เป็นผู้รับ Message และดำเนินการตาม Message<br>&nbsp;	
  &nbsp;
<input type="radio" name="q10" value="Message ที่ Object ตัวหนึ่งส่งไปโดยมีจุดประสงค์เพื่อให้เกิดการสร้าง Object ของ Class ขึ้น"> 
Message ที่ Object ตัวหนึ่งส่งไปโดยมีจุดประสงค์เพื่อให้เกิดการสร้าง Object ของ Class ขึ้น<br>&nbsp;	
  &nbsp;
<input type="radio" name="q10" value="Message ที่ Sender ใช้เรียก Method ของ Receiver"> 
Message ที่ Sender ใช้เรียก Method ของ Receiver<br>
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
