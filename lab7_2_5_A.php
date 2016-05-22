<?php #define("COSTANTE", "Ciao mondo.");
	$conn = mysqli_connect("localhost", "root", "", "example");
	if($conn == false)
		die("Connection Error (".mysqli_connect_errno().")".mysqli_connect_error());
	if (!mysqli_set_charset($conn, "utf8"))
		die("Errore nel caricamento del set di caratteri utf8:" . mysqli_error($conn));

	$res = mysqli_query($conn, "SELECT ID, Descrizione, Prezzo, Quantita FROM books");
	if (!$res)
		die("Error in query execution!");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Lab 7.2.5 - A</title>
		<link href="styles.css" rel="stylesheet" type="text/css">
		<script>
			function setFocus() {
				document.forms[0].ID.focus();
			}
		</script>
	</head>

	<body onload="javascript: setFocus();">
		<form id="InsertForm" action="lab7_2_5_B.php" method="get">
      		<p>ID: <input type="text" id="ID" name="id"></p>
      		<p>Description: <input type="text" id="Description" name="description"></p>
      		<p>Price: <input type="text" id="Price" name="price"></p>
      		<p>Quantity: <input type="text" id="qnt" name="quantity"></p>
      		<p><button type="submit"> Insert </button></p>
    	</form>
    	<br>
		<TABLE id="tabella">
			<TR><TH> ID </TH><TH> Description </TH><TH> Price </TH><TH> Quantity </TH></TR>
			<?php
				$row = mysqli_fetch_array($res);
				while($row != NULL) {
					echo "<TR><TD>".$row['ID']."</TD><TD>".$row['Descrizione']."</TD><TD>".$row['Prezzo']."</TD><TD>".$row['Quantita']."</TD></TR>";
					$row = mysqli_fetch_array($res);
				}
				mysqli_free_result($res);
				mysqli_close($conn);
			?>
		</TABLE>
		<br>
		<footer>
			<TABLE ID="Outer" ><TR>
				<TH> <img src="http://security.polito.it/img/polito.gif" alt="PoliTo's Logo"> </TH>
				<TH><div>This website was developed by LM Production&reg;, all rights are reserved.</div>
					<TABLE ID="Inner" style="border-spacing: 10px; bor" > <TR>
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