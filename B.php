<?php
	session_start();
		
	if(count($_REQUEST)===0) {
		echo "<!DOCTYPE html><html><head><title>Error!</title></head>",
			"<body><p>Please before visit this page go ", 
			"<a href='A.php'>here</a> and enter your data!</p></body></html>";
		die();
	}
		
	$name	= $_REQUEST['Name'];
	$age 	= $_REQUEST['Age'];
	$phone	= $_REQUEST['Phone'];
	if(($name==="")||($age==="")||($phone==="")) 
	{
		echo "<!DOCTYPE html><html><head><title>Error!</title></head>",
			"<body><p>Do you have inserted an empty string?! <BR> Go ",
			"<a href='A.php'>here</a> and enter your data again, please!</p></body></html>";
		die();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="content-type">
		<title>Lab 7.1.1 - B</title>
		<link href="styles.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="functions.js"></script>
	</head>

	<body>
		
		<p> This page have to contain only the data that you have inserted in the previous page. </p>
		<?php
			$printData = true;
			/* ----- Name's checking ----- */
			if(strlen($name)>10) {
				echo "<p>A name cannot be longer then 10 characters!<p>";
				$printData = false;
			}
			if(!ctype_alpha($name)) {
				echo "<p>A name must contains only letters!<p>";
				$printData = false;
			}
			if((!ctype_upper($name[0])) || (!ctype_lower( mb_substr($name, 1) )) ) {
				echo "<p>A name must starts with an uppercase letter and after that it must has only lowercase letters!",
					"<br>(This will be automatically corrected!)</p>"; 
				strtolower($name);
				ucwords($name);
			}
			/* ----- Age's checking ----- */
			if (!ctype_digit($age)) {
				echo "<p>Age must contains only numbers!<p>";
				$printData = false;
			}
			if ($age < 0 || $age > 200) {
				echo "<p>Age must be positive and lower than 200!<p>";
				$printData = false;
			}
			/* ----- Phone's checking ---- */
			$regExp = "/^0[0-9][0-9]?\-[0-9]{3}\-?[0-9]{3}[0-9]?$/";
			$ret =  preg_match($regExp , $phone);
			echo "DEBUG - ret=".$ret;
			if ( $ret != 1 ) {
				echo "<p>Invalid Phone Number!<p>";
				$printData = false;
			}
			else echo "<p>DEBUG - The number is right!</p>";
		?>
		<?php
			$count = 1;
			if( isset($_SESSION['count']) )
				$count = $_SESSION['count'] +1;
			
			if($count == 1)
				echo "<p>It's the first time that you visit my page, uh?</p>";
			else {
				echo "<p>Welcome back, dear <strong>$name</strong>, to my humble site.<br>",
					"This is your visit number $count!</p>";
			}
			$_SESSION['count'] = $count;	
		?>
		<?php
			if($printData) {
				echo "<TABLE id='tabella' ><TR><TH> Name </TH><TH> Age </TH><TH> Phone </TH></TR>"; 
				echo "<TR> <TD>$name</TD> <TD>$age</TD> <TD>$phone</TD> </TR>";
				echo "</TABLE>";
			}
		?>
		<p>	<a href="A.php">Go back</a> </p>
		
		<footer>
			<TABLE ID="Outer" ><TR>
				<TH> <img src="http://security.polito.it/img/polito.gif" alt="PoliTo's Logo"> </TH>
				<TH><div>This website was developed by LM Production&reg;, all rights are reserved.</div>
					<TABLE ID="Inner" style="border-spacing: 10px;" > <TR>
						<TH><a href="http://jigsaw.w3.org/css-validator/check/referer"><img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="CSS Valido!" /></a></TH>
						<TH><a href="https://it.linkedin.com/pub/luca-mannella/a1/859/9a5"> The author </a></TH>
						<TH><a href="mailto:luca.mannella@outlook.it?Subject=Information%20about%20website">Contact me</a></TH>
						<TH><a href="http://validator.w3.org/check?uri=referer"> <img src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01 Strict" height="31" width="88"></a></TH>
					</TR></TABLE>
				</TH>
			</TR></TABLE>
		</footer>
	</body>
</html>
