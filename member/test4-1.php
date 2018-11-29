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
answers[0] = "คุณสมบัติของ Class ซึ่ง Object ทุกตัวของ Class ต้องมีคุณสมบัติตามที่กำหนดไว้";
answers[1] = "สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute, Method";
answers[2] = "2";
answers[3] = "บริการที่ Object ของ Class ต้องมี เพื่อให้สิ่งแวดล้อมหรือ Object อื่นๆ เรียกใช้บริการได้";
answers[4] = "ตัวแปร (Primitive Type) หรือ Object ที่ถูกส่งเข้าไปยัง Method";
answers[5] = "Type ของผลลัพธ์จากการดำเนินการของ Method ซึ่งจะถูกส่งออกมาสู่ภายนอก";
answers[6] = "ชื่อของ Methods ใน Class เดียวกัน ไม่ควรซ้ำกัน";
answers[7] = "เท่าใดก็ได้";
answers[8] = "Game";
answers[9] = "การเป็นส่วนหนึ่ง";

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

<h1>แบบทดสอบ บทที่ 4 Class Diagram</h1>
<br>
<form name="quiz">
<p>1. Attribute หมายถึง<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q1" value="คุณสมบัติของ Class ซึ่ง Object ทุกตัวของ Class ต้องมีคุณสมบัติตามที่กำหนดไว้"> 
  คุณสมบัติของ Class ซึ่ง Object ทุกตัวของ Class ต้องมีคุณสมบัติตามที่กำหนดไว้<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q1" value="สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุ"> 
  สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุ<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q1" value="Object"> 
  Object<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q1" value="Actor"> 
  Actor</p>
<p><br>
</p>
<p>
  
  2. Class คือ<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q2" value="Visibility"> 
  Visibility<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q2" value="สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute, Method"> 
  สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute, Method<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q2" value="การซ้ำกันของ Method ใน Class"> 
  การซ้ำกันของ Method ใน Class<br>&nbsp;	
  &nbsp;
  <input type="radio" name="q2" value="Method ที่ชื่อซ้ำกัน มีจำนวน Parameter เท่ากัน"> 
  Method ที่ชื่อซ้ำกัน มีจำนวน Parameter เท่ากัน
<p><br>
<p>

3. Type แบ่งออกเป็น กี่ประเภท<br>&nbsp;	
  &nbsp;
<input type="radio" name="q3" value="1"> 
1<br>&nbsp;	
  &nbsp;
<input type="radio" name="q3" value="2"> 
2<br>&nbsp;	
  &nbsp;
<input type="radio" name="q3" value="3"> 
3<br>&nbsp;	
  &nbsp;
<input type="radio" name="q3" value="4"> 
4
<p><br>
<p>

4. Method หมายถึง<br>&nbsp;	
  &nbsp;
<input type="radio" name="q4" value="บริการที่ Object ของ Class ต้องมี เพื่อให้สิ่งแวดล้อมหรือ Object อื่นๆ เรียกใช้บริการได้"> 
บริการที่ Object ของ Class ต้องมี เพื่อให้สิ่งแวดล้อมหรือ Object อื่นๆ เรียกใช้บริการได้<br>&nbsp;	
  &nbsp;
<input type="radio" name="q4" value="Association ที่ Class ข้างหนึ่งของ Association มี max-card เป็น 1"> 
Association ที่ Class ข้างหนึ่งของ Association มี max-card เป็น 1<br>&nbsp;	
  &nbsp;
<input type="radio" name="q4" value="Generalize"> 
Generalize<br>&nbsp;	
  &nbsp;
<input type="radio" name="q4" value="สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute, Method"> 
สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute, Method
<p><br>
<p>

5. Parameter หมายถึง<br>&nbsp;	
  &nbsp;
<input type="radio" name="q5" value="หมายถึง Type ของผลลัพธ์จากการดำเนินการของ Method ซึ่งจะถูกส่งออกมาสู่ภายนอก"> 
หมายถึง Type ของผลลัพธ์จากการดำเนินการของ Method ซึ่งจะถูกส่งออกมาสู่ภายนอก<br>&nbsp;	
  &nbsp;
<input type="radio" name="q5" value="สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute, Method"> 
สิ่งที่อธิบายแนวคิดกลุ่มของวัตถุที่มี Attribute, Method<br>&nbsp;	
  &nbsp;
<input type="radio" name="q5" value="Class ที่มี Min-card เท่ากับ 0"> 
Class ที่มี Min-card เท่ากับ 0<br>&nbsp;	
  &nbsp;
<input type="radio" name="q5" value="ตัวแปร (Primitive Type) หรือ Object ที่ถูกส่งเข้าไปยัง Method"> 
ตัวแปร (Primitive Type) หรือ Object ที่ถูกส่งเข้าไปยัง Method
<p><br>
<p>

6. Return Type หมายถึง<br>&nbsp;	
  &nbsp;
<input type="radio" name="q6" value="ชื่อของ Methods ใน Class เดียวกัน ไม่ควรซ้ำกัน"> 
ชื่อของ Methods ใน Class เดียวกัน ไม่ควรซ้ำกัน<br>&nbsp;	
  &nbsp;
<input type="radio" name="q6" value="กระบวนการหาความสัมพันธ์ระหว่าง Class ที่เราสนใจ"> 
กระบวนการหาความสัมพันธ์ระหว่าง Class ที่เราสนใจ<br>&nbsp;	
  &nbsp;
<input type="radio" name="q6" value="Type ของผลลัพธ์จากการดำเนินการของ Method ซึ่งจะถูกส่งออกมาสู่ภายนอก"> 
Type ของผลลัพธ์จากการดำเนินการของ Method ซึ่งจะถูกส่งออกมาสู่ภายนอก<br>&nbsp;	
  &nbsp;
<input type="radio" name="q6" value="Class ที่ต้องมีส่วนร่วมอยู่ใน Association เสมอ จะขาดไม่ได้ "> 
Class ที่ต้องมีส่วนร่วมอยู่ใน Association เสมอ จะขาดไม่ได้ 
<p><br>
<p>

7. กฏในการตั้งชื่อ Method คือ<br>&nbsp;	
  &nbsp;
<input type="radio" name="q7" value="ชื่อของ Methods ใน Class เดียวกัน ไม่ควรซ้ำกัน"> 
ชื่อของ Methods ใน Class เดียวกัน ไม่ควรซ้ำกัน<br>&nbsp;	
  &nbsp;
<input type="radio" name="q7" value="ข้อความสูงสุด 10 คำ"> 
ข้อความสูงสุด 10 คำ<br>&nbsp;	
  &nbsp;
<input type="radio" name="q7" value="มีสัญลักษณ์ได้"> 
มีสัญลักษณ์ได้<br>&nbsp;	
  &nbsp;
<input type="radio" name="q7" value="ใช้ได้เฉพาะภาษาไทย"> 
ใช้ได้เฉพาะภาษาไทย
<p><br>
<p>

8. ใน Class หนึ่งๆ จะมี Method จำนวนเท่าใด<br>&nbsp;	
  &nbsp;
<input type="radio" name="q8" value="เท่าใดก็ได้"> 
เท่าใดก็ได้<br>&nbsp;	
  &nbsp;
<input type="radio" name="q8" value="2 จำนวน"> 
2 จำนวน<br>&nbsp;	
  &nbsp;
<input type="radio" name="q8" value="4 จำนวน"> 
4 จำนวน<br>&nbsp;	
  &nbsp;
<input type="radio" name="q8" value="6 จำนวน"> 
6 จำนวน
<p><br>
<p>

9. ข้อใดไม่ใช่ องค์ประกอบของ Class Diagram <br>&nbsp;	
  &nbsp;
<input type="radio" name="q9" value="Class"> 
Class<br>&nbsp;	
  &nbsp;
<input type="radio" name="q9" value="Attribute"> 
Attribute<br>&nbsp;	
  &nbsp;
<input type="radio" name="q9" value="Operation"> 
Operation<br>&nbsp;	
  &nbsp;
<input type="radio" name="q9" value="Game"> 
Game
<p><br>
<p>

10. Aggregation แปลว่า<br>&nbsp;	
  &nbsp;
<input type="radio" name="q10" value="การเป็นส่วนหนึ่ง"> 
การเป็นส่วนหนึ่ง<br>&nbsp;	
  &nbsp;
<input type="radio" name="q10" value="การเป็นคน"> 
การเป็นคน<br>&nbsp;	
  &nbsp;
<input type="radio" name="q10" value="การทำงาน"> 
การทำงาน<br>&nbsp;	
  &nbsp;
<input type="radio" name="q10" value="การหาวัตถุ"> 
การหาวัตถุ<br>
<p>
<br>
<input type="button" value="ดูผลคะแนน" onClick="getScore(this.form)">
<input type="reset" value="ยกเลิก"><p>
<br>
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
