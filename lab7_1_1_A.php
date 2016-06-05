<?php 	session_start();	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Lab 7.1.1 - A</title>
		<link href="styles.css" rel="stylesheet" type="text/css">
		<script>
			function setFocus() {
				document.forms[0].txtName.focus();
			}
		</script>
	</head>

	<body onload="javascript: setFocus();">
		<form id="MyForm" method="get" action="lab7_1_1_B.php">
			<p>
				Name: <input type="text" id="txtName" name="Name" maxlength="10" style="margin: 5px" onchange="javascript: checkName();"> <br>
				Age: <input type="text" id="txtAge" name="Age" maxlength="3" style="margin: 5px" onchange="javascript: checkAge();"> <br>
				Phone: <input type="text" id="txtPhone" name="Phone" maxlength="12" style="margin: 5px" onchange="javascript: checkPhone();"> <br>
			</p>
			<input type="button" value="Send" onclick="javascript: if( check() ) document.getElementById('MyForm').submit();">
			<input type="button" value="Reset" onclick="javascript: document.getElementById('MyForm').reset(); document.forms[0].txtName.focus();">
			<p>I do not use your data in any ways! I use this data just for knowing if it's the first time that you visit my page or not!</p>
		</form>
	</body>
	
	<script>
		function check() {
			if( checkName() )
				if( checkAge() )
					if ( checkPhone() )
						return true;

			return false;
		}
		
		function checkName() {
			var regExp = /^[A-Z][a-z]*$/;
			var txtName = document.getElementById("txtName");
			isRight = regExp.test(txtName.value);
			console.log(isRight);	console.log(txtName.value);
			if( (txtName.value.length > 10) || (!isRight) ) {
				window.alert("You write an invalid name!");
				txtName.focus();
				return false;
			}
			return true;
		}

		function checkAge() {
			var txtAge = document.getElementById("txtAge");
			var age = parseInt(txtAge.value);
			if( (isNaN(age)) || (age<0) || (age>199) ){
				window.alert("You write an invalid number!");
				txtAge.focus();
				return false;
			}
			return true;
		}
		
		function checkPhone() {
			var txtPhone = document.getElementById("txtPhone");
			var regExp = /^0[0-9][0-9]?\-[0-9]{3}\-?[0-9]{3}[0-9]?$/;
			var isRight = regExp.test(txtPhone.value);
			console.log(isRight);	console.log(txtPhone.value);
			if( !isRight ) {
				window.alert("You write an invalid phone number!");
				txtPhone.focus();
				return false;
			}
			return true;				
		}
	</script>
	<noscript>
		<p>Unfortunately your browser <strong>does not support Javascript</strong> and some functionality are not available!</p>
	</noscript>
	<footer>
		<TABLE ID="Outer" > <TR>
				<TH> <img src="http://security.polito.it/img/polito.gif" alt="PoliTo's Logo"> </TH>
				<TH> <div>This website was developed by Luca Mannella&reg;, all rights are reserved.</div>
					<TABLE ID="Inner" style="border-spacing: 10px;" > <TR>
							<TH><a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="CSS Valido!" /></a></TH>
							<TH><a href="https://it.linkedin.com/pub/luca-mannella/a1/859/9a5"> The author </a></TH>
							<th><em><a href="mailto:luca.mannella@studenti.polito.it?Subject=Bug%20or%20Problem%20found!">Contact me</a></em></th>
							<TH><i><a href="http://lukeman.altervista.org">Go back to the Home</a></i></TH>
							<TH><a href="http://validator.w3.org/check?uri=referer"> <img src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01 Strict" height="31" width="88"></a></TH>
					</TR> </TABLE>
				</TH>
		</TR> </TABLE>
	</footer>
</html>