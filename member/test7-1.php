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
answers[0] = "Class ที่ไม่จำเป็นต้องมีส่วนร่วมอยู่ใน Association";
answers[1] = "กระบวนการหาความสัมพันธ์ระหว่าง Class ที่เราสนใจ";
answers[2] = "Association ที่ Class ทั้งสองข้างของ Association มี max-card เป็น 1 ทั้งคู่";
answers[3] = "Association ที่ Class ข้างหนึ่งของ Association มี max-card เป็น 1";
answers[4] = "Association ที่ Class ทั้งสองข้างของ Association มี max-card มีค่ามากกว่า 1 ทั้งคู่";
answers[5] = "Generalize";
answers[6] = "-";
answers[7] = "จะไม่ถูกเปิดเผยแก่ภายนอกและไม่สามารถเข้าถึงโดยตรงจากภายนอก";
answers[8] = "จะไม่ถูกเปิดเผยแก่ภายนอกและไม่สามารถเข้าได้โดยตรงจากภายนอก แต่สามารถเข้าถึงได้จากภายในตัว Class";
answers[9] = "จะถูกเปิดเผยและถูกเข้าถึงได้โดยตรงจากภายนอก ไม่มีการปกปิดใดๆ";

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
<h1>แบบทดสอบ บทที่ 7 Persistent Data Design </h1>
<br>
<form name="quiz">
<p>1. Optional Class คือ<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="Class ที่ไม่จำเป็นต้องมีส่วนร่วมอยู่ใน Association"> 
  Class ที่ไม่จำเป็นต้องมีส่วนร่วมอยู่ใน Association<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="Class ที่ต้องมีส่วนร่วมอยู่ใน Association เสมอ จะขาดไม่ได้ "> 
  Class ที่ต้องมีส่วนร่วมอยู่ใน Association เสมอ จะขาดไม่ได้ <br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="Class ทั้งสองข้างของ Association"> 
  Class ทั้งสองข้างของ Association<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q1" value="Class ข้างหนึ่งของ Association"> 
  Class ข้างหนึ่งของ Association</p>
<p><br>
</p>
<p>
  
  2. Aggregation Abstraction คือ<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="Class ที่ต้องมีส่วนร่วมอยู่ใน Association เสมอ จะขาดไม่ได้ "> 
  Class ที่ต้องมีส่วนร่วมอยู่ใน Association เสมอ จะขาดไม่ได้ <br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="กระบวนการหาความสัมพันธ์ระหว่าง Class ที่เราสนใจ"> 
  กระบวนการหาความสัมพันธ์ระหว่าง Class ที่เราสนใจ<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="Class ข้างหนึ่งของ Association"> 
  Class ข้างหนึ่งของ Association<br>&nbsp;	
  &nbsp;	
  <input type="radio" name="q2" value="Class ทั้งสองข้างของ Association"> 
  Class ทั้งสองข้างของ Association
<p><br>
<p>

3. One-to-One Association คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="Association ที่ Class ทั้งสองข้างของ Association มี max-card เป็น 1 ทั้งคู่"> 
Association ที่ Class ทั้งสองข้างของ Association มี max-card เป็น 1 ทั้งคู่<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="Association ที่ Class ข้างหนึ่งของ Association มี max-card เป็น 1"> 
Association ที่ Class ข้างหนึ่งของ Association มี max-card เป็น 1<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="Class ที่มี Min-card เท่ากับ 0"> 
Class ที่มี Min-card เท่ากับ 0<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q3" value="min-card ไม่เท่ากับ 0"> 
min-card ไม่เท่ากับ 0
<p><br>
<p>

4. One-to-Many Association คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="Association ที่ Class ข้างหนึ่งของ Association มี max-card เป็น 1"> 
Association ที่ Class ข้างหนึ่งของ Association มี max-card เป็น 1<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="Class ข้างหนึ่งของ Association"> 
Class ข้างหนึ่งของ Association<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="Class ทั้งสองข้างของ Association"> 
Class ทั้งสองข้างของ Association<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q4" value="Class ของ Object"> 
Class ของ Object
<p><br>
<p>

5. Many-to-Many Association คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="Association ที่ Class ทั้งสองข้างของ Association มี max-card มีค่ามากกว่า 1 ทั้งคู่"> 
Association ที่ Class ทั้งสองข้างของ Association มี max-card มีค่ามากกว่า 1 ทั้งคู่<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="Class ข้างหนึ่งของ Association"> 
Class ข้างหนึ่งของ Association<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="Class ของ Object"> 
Class ของ Object<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q5" value="Class ทั้งสองข้างของ Association"> 
Class ทั้งสองข้างของ Association
<p><br>
<p>

6. General เรียกว่า<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="Object"> 
Object<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="Class"> 
Class<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="Generaliza"> 
Generaliza<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q6" value="Generalize"> 
Generalize
<p><br>
<p>

7. Visibility private แทนเครื่องหมาย<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="+"> 
+<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="-"> 
-<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="*"> 
*<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q7" value="#"> 
#
<p><br>
<p>

8. Private คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="จะไม่ถูกเปิดเผยแก่ภายนอกและไม่สามารถเข้าถึงโดยตรงจากภายนอก"> 
จะไม่ถูกเปิดเผยแก่ภายนอกและไม่สามารถเข้าถึงโดยตรงจากภายนอก<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="ใช้งานได้โดยตรง"> 
ใช้งานได้โดยตรง<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="Generaliza"> 
Generaliza<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q8" value="Visibility public"> 
Visibility public
<p><br>
<p>

9. Protected คือ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="จะไม่ถูกเปิดเผยแก่ภายนอกและไม่สามารถเข้าได้โดยตรงจากภายนอก แต่สามารถเข้าถึงได้จากภายในตัว Class">
จะไม่ถูกเปิดเผยแก่ภายนอกและไม่สามารถเข้าได้โดยตรงจากภายนอก แต่สามารถเข้าถึงได้จากภายในตัว Class<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="Association ที่ Class ข้างหนึ่งของ Association มี max-card เป็น 1"> 
Association ที่ Class ข้างหนึ่งของ Association มี max-card เป็น 1<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="Class ทั้งสองข้างของ Association"> 
Class ทั้งสองข้างของ Association<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q9" value="Class ของ Object"> 
Class ของ Object
<p><br>
<p>

10. Public<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="Class ทั้งสองข้างของ Association"> 
Class ทั้งสองข้างของ Association<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="Class ของ Object"> 
Class ของ Object<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value=" จะถูกเปิดเผยและถูกเข้าถึงได้โดยตรงจากภายนอก ไม่มีการปกปิดใดๆ"> 
 จะถูกเปิดเผยและถูกเข้าถึงได้โดยตรงจากภายนอก ไม่มีการปกปิดใดๆ<br>&nbsp;	
  &nbsp;	
<input type="radio" name="q10" value="Association ที่ Class ข้างหนึ่งของ Association มี max-card เป็น 1"> 
Association ที่ Class ข้างหนึ่งของ Association มี max-card เป็น 1<br>
<p>
<br>
<input type="button" value="ดูผลคะแนน" onClick="getScore(this.form)">
<input type="reset" value="ยกเลิก" ><p><br>
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
