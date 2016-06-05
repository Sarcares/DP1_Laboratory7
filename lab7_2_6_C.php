<?php
	session_start();
		
	if(count($_GET)===0) {
		echo "<!DOCTYPE html><html><head><title>Error!</title></head>",
			"<body><p>Please before visit this page go ", 
			"<a href='lab7_2_6_A.php'>here</a> and enter your data!</p></body></html>";
		die();
	}
	
	$conn = mysqli_connect("localhost", "root", "", "example");
	if($conn == false)
		die("Connection Error (".mysqli_connect_errno().")".mysqli_connect_error());
	if (!mysqli_set_charset($conn, "utf8"))
		die("Errore nel caricamento del set di caratteri utf8:" . mysqli_error($conn));
	
	$res = mysqli_query($conn, "SELECT * FROM books");
	if (!$res)
		die("Error in query execution!");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="content-type">
		<title>Lab 7.2.6 - C</title>
		<link href="styles.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="functions.js"></script>
	</head>

	<body>
		<?php
			$row = mysqli_fetch_array($res);
			while($row != NULL) {
				$id = $row['ID'];
				if( isset($_GET["r$id"]) ) {
					$qnt = $_GET["r$id"];
					
					if( ($qnt>0)&&(is_numeric($qnt)) ) {
						$res2 = mysqli_query($conn, "UPDATE books SET Quantita = Quantita - $qnt WHERE ID = '$id'");
						if (!$res2)
							die("Error updating the database of books!");
					}
					# else doesn't update the database!
				} 
				$row = mysqli_fetch_array($res);
			}
			
			mysqli_free_result($res);
			mysqli_close($conn);
			$tot = $_GET['total'];
		?>
		<h1>Purchase Confirmed</h1>
		<h4> Your purchase was confirmed, the overall is = <?php echo $tot ?> €</h4>
		<h5> You will receive the books as soon as possible, thanks for choosing us!</h5>
		<p>	If you want to buy more <a href="lab7_2_6_A.php">go back</a> to our catalogue!</p>

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
