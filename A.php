<?php 	session_start();	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Lab 7.1.1 - A</title>
		<script>
			function reset() {
				document.getElementById("txtName").value = "";
				document.getElementById("txtSurname").value = "";
			}
			function setFocus() {
				document.forms[0].txtName.focus();
			}
			function checkPhone() {
				var txtPhone = document.getElementById("txtPhone");
				var regExp = /0[0-9][0-9]?\-[0-9]{3}\-?[0-9]{3}[0-9]?/;
				var flag = regExp.test(txtPhone.value);
				console.log(flag);
				console.log(txtPhone.value);
				if( !flag ) {
					window.alert("You write an invalid phone number!");
					txtPhone.focus();
				}				
			}
		</script>
	</head>

	<body onload="javascript: setFocus();">
		<form method="get" action="B.php">
			<p>
				Name: <input type="text" id="txtName" name="Name" maxlength="10" style="margin: 5px"> <br>
				Age: <input type="text" id="txtAge" name="Age" maxlength="3" style="margin: 5px"> <br>
				Phone: <input type="text" id="txtPhone" name="Phone" style="margin: 5px" onchange="javascript: checkPhone();"> <br>
			</p>
			<input type="submit" value="Send">
			<input type="button" value="Reset" onclick="javascript: reset();">
			<p>I do not use your data in any ways! I use this data just for knowing if it's the first time that you visit my page or not!</p>
		</form>
	</body>
</html>