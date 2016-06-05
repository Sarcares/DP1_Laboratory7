<?php
	if (!isset($_COOKIE["pag"])) {
		setcookie("pag", 1);
		$page = 1;
	}
	else {
		$page = $_COOKIE["pag"] + 1;
		setcookie("pag", $page);
	}
?>

<?php
	$conn = mysqli_connect("localhost", "root", "", "example");
	if($conn == false)
		die("Connection Error (".mysqli_connect_errno().")".mysqli_connect_error());
	if (!mysqli_set_charset($conn, "utf8"))
		die("Errore nel caricamento del set di caratteri utf8:" . mysqli_error($conn));

	if( isset($_COOKIE["pag"]) )
		$offset = $_COOKIE["pag"] * 10;
	else
		$offset = 0;
	
	$res = mysqli_query($conn, "SELECT Descrizione, Prezzo, Quantita FROM books LIMIT " . $offset . ",10");
	if (!$res)
		die("Error in query execution!");
	
	$numRows = mysqli_num_rows($res);
	if(($page>1) && ($numRows==0)) {
		$res = mysqli_query($conn, "SELECT Descrizione, Prezzo, Quantita FROM books LIMIT ".($offset-10).",10");
		$page--;
		setcookie("pag", $page);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Lab 7.2.2</title>
		<link href="styles.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="cookies.js"></script>
	</head>

	<body>
		<?php echo "<div>Page number:</div><p id='pagina'>$page</p>"; ?>
		<TABLE id="tabella">
			<TR><TH> Description </TH><TH> Price </TH><TH> Quantity </TH></TR>
			<?php
				$row = mysqli_fetch_array($res);
				while($row != NULL) {
					echo "<TR><TD>".$row['Descrizione']."</TD><TD>".$row['Prezzo']."</TD><TD>".$row['Quantita']."</TD></TR>";
					$row = mysqli_fetch_array($res);
				}
				mysqli_free_result($res);
				mysqli_close($conn);
			?>
		</TABLE>
		<br>
		<form id="MyForm" action="lab7_2_2.php">
			<?php if($page!==1): ?>
				<button type="button" onclick="goBack();">Previous Page</button>
			<?php endif;
      		if($numRows===10): ?> 
      			<button type="submit">Next Page</button> 
      		<?php endif;?>
    	</form>
		<br>
		<script>
			function goBack() {
				var page = document.getElementById("pagina").innerHTML;
				scriviCookie("pag", page-2);
				document.getElementById('MyForm').submit();
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
		
	</body>
</html>