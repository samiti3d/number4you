<?php
session_start();
if($_POST) {
	//ตรวจสอบภาพ captcha
	if($_POST['captcha'] !== $_SESSION['captcha']) {
		echo "alert('ใส่อักขระในภาพไม่ถูกต้อง');";
		exit;
	}
	//
	$login = $_POST['login'];
	$password = $_POST['pswd'];
	$fname =  $_POST['firstname'];
	$lname = $_POST['lastname'];
	$code = $_POST['code'];
	$err = "";
	
	include "dblink.php";
	
	//ตรวจสอบว่าว่า login และ code(รหัสประจำตัวซ้ำกับผู้อื่นหรือไม่)
	$sql = "SELECT login, code FROM testee WHERE login = '$login' OR code = '$code'";
	$result = mysqli_query($link, $sql);
	if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		if($login == $row[0]) {
			$err = "ล็อกอิน: $login ซ้ำซ้อนกับผู้ที่ลงทะเบียนแล้ว กรุณาแก้ไขใหม";
		}
		else if(!empty($row[1]) && ($code == $row[1])) {
			$err = "รหัส: $code ซ้ำซ้อนกับผู้ที่ลงทะเบียนแล้ว กรุณาแก้ไขใหม่";
		}
	}
	
	 if($err == "") {
		$sql = "INSERT INTO testee VALUES(
					'', '$login', '$password', '$fname', '$lname', '$code')";
		
		if(!mysqli_query($link, $sql)) {
			$err = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
	 }
	 
	 if($err != "") {
		echo "alert('$err');";
		mysqli_close($link);
		exit;
	 }
	 $_SESSION['user'] = "testee";
	 $_SESSION['testee'] = "$fname  $lname";
	$_SESSION['testee_id'] = mysqli_insert_id($link);
	echo "
		setInterval(function() { location.href = 'index.php'; }, 3000);
		$('form')[0].reset();
		alert('จัดเก็บข้อมูลแล้ว จะกลับสู่หน้าหลักใน 3 วินาที');";
		
	mysqli_close($link);
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Web Testing</title>
<style>
	@import "global.css";

	form {
		width: 600px;
		border: solid 0px green;
		border-radius: 8px;
		margin: 10px auto 15px;
		padding: 10px 0px;
		background: #cee;
	}
	form input {
		width: 200px;
		background: #ffd;
		border: solid 1px gray;
		padding: 2px;
		color: blue;
	}
	form label {
		display: inline-block;
		width: 200px;
		text-align: right;
		padding: 5px;
	}
	form img {
		margin-top: 5px;
		vertical-align: middle;
	}
	form div {
		text-align:center;
		margin-top: 10px;
	}
	form button {
		background: steelblue;
		color: white;
		border: solid 1px orange;
		padding: 3px;
		width: 80px;
		margin-right: 50px;
	}
	form button:hover {
		color: aqua;
		cursor: pointer;
	}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script>
$(function() {
	$('#ok').click(function(event) { 
		var error = false;
		$(':text, :password').each(function() {
            if($(this).attr('name') != "code") {
				if($(this).val().length == 0) {
					var t = $(this).prev('label').text();
					alert('ท่านยังไม่ได้ใส่ข้อมูลในช่อง\n' + t);
					error  = true;
					return false;
				}
			}
        });
		
		if(!error && ($(':password:first').val() !== $(':password:last').val())) {
			error  = true;
			alert('ท่านใส่รหัสผ่านทั้งสองช่องไม่ตรงกัน');
		}
		
		if(error) {
			return;
		}
		
		$.ajax({
			url: '<?php echo $_SERVER['PHP_SELF']; ?>',
			data: $('form').serializeArray(),
			dataType: "script",
			type: "post",
			beforeSend: function() {
				$('form').block({message: '<h2>กำลังส่งข้อมูล</h2>'});
			},
			complete: function() {
				$('form').unblock();
			}
		});
	});
	
	$('#cancel').click(function() {
		window.location = 'index.php';
	});
});
</script>
</head>
	
<body>
<div id="container">
<?php 
include "header.php";
include "lib/AntiBotCaptcha/abcaptcha.php";
?>
<article>
<section id="top">
	<h3>ลงทะเบียน</h3>
    <span>สำหรับผู้ที่จะทำแบบทดสอบ</span>
</section>
<section id="content">

<form method="post">
    <label>Login:</label><input type="text" name="login" required><br>
    <label>Password:</label><input type="password" name="pswd" required><br>
    <label>Re-Password:</label><input type="password" name="pswd2" required><br>
	<br>
    <label>ชื่อ:</label><input type="text" name="firstname" required><br>
    <label>นามสกุล:</label><input type="text" name="lastname" required><br>
    <label>รหัส(ถ้ามี):</label><input type="text" name="code">
    <br>
    <label></label><?php 	captcha_echo(); ?><br>
    <label>อักขระในภาพ:</label><input type="text" name="captcha" required>
    <br>
    <div>
     	<button type="button" id="ok">ตกลง</button>
        <a href="index.php">ยกเลิก</a>
	</div>
</form>

</section>
</article>
<?php include "footer.php"; ?>
</div>
</body>
</html>