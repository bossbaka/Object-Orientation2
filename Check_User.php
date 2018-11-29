<?
session_start();
if($_SESSION['user'] ==""){ // ถ้า $_SESSION['user'=ค่าว่าง แสดงว่าเขากำลังจะมาลักไก่เรา
?>
<script type="text/javascript">
alert ('สงวนสิทธิ์การใช้งานเฉพาะสมาชิกเท่านั้น หรือ \r\n \r\n ถ้าคุณเป็นสมาชิกอยู่แล้ว กรุณาล๊อกอินเข้าสู่ระบบก่อนนะครับ\r\n \r\nหรือ ถ้าคุณยังไม่สมัครเป็นสมาชิก\r\nกรุณาสมัครสมาชิก เพื่อใช้งานด้วยนะครับ\r\n \r\n ...ขอบคุณครับ'); // เราก็แจ้งเลยว่า หยุด อย่าขยับ เจ้าหน้าที่ล้อมไว้หมดแล้ว 
window.location="register.php"; // แล้วก็ส่งเขากลับไปหน้าแรก หรือหน้าสำหรับสมัครสมาชิกเลย 
</script>
<? } ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>