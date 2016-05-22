<?php
	session_start();
		
	if(count($_GET)===0) {
		echo "<!DOCTYPE html><html><head><title>Error!</title></head>",
			"<body><p>Please before visit this page go ", 
			"<a href='lab7_2_4_A.php'>here</a> and enter your data!</p></body></html>";
		die();
	}
		
	$id	= $_GET['id'];
	$quantity = $_GET['quantity'];
	if( ($id==="")||($quantity==="") ) 
	{
		echo "<!DOCTYPE html><html><head><title>Error!</title></head>",
			"<body><p>Do you have inserted an empty string?! <BR> Go ",
			"<a href='lab7_2_4_A.php'>here</a> and enter your data again, please!</p></body></html>";
		die();
	}
	
	$conn = mysqli_connect("localhost", "root", "", "example");
	if($conn == false)
		die("Connection Error (".mysqli_connect_errno().")".mysqli_connect_error());
	if (!mysqli_set_charset($conn, "utf8"))
		die("Errore nel caricamento del set di caratteri utf8:" . mysqli_error($conn));
?>

<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="content-type">
		<title>Lab 7.2.4 - B</title>
		<link href="styles.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="functions.js"></script>
	</head>

	<body>
		<?php
			$printData = true;
			/* ----- ID's checking ----- */
			$res = mysqli_query($conn, "SELECT count(*) as total FROM books");
			if (!$res) {
				mysqli_close($conn);
				die("Error in query execution!");
			}
			
			$result = mysqli_fetch_array($res);
			$totalRows = $result['total'];
			if(($id < 1) || ($id > $totalRows)) {
				echo "<p>Do you have inserted an invalid ID! It must be between 1 and $totalRows</p>";
				$printData=false;
			}
			else {	/* ----- Quantity's checking ----- */
				$res = mysqli_query($conn, "SELECT Descrizione, Prezzo, Quantita FROM books WHERE ID=$id");
				if (!$res) {
					mysqli_close($conn);
					die("Error in query execution!");
				}
				$result = mysqli_fetch_array($res);
				$availableQnt = $result['Quantita'];
				if($quantity < 1) {
					echo "<p>Do you have inserted a negative Quantity!</p>";
					$printData = false;
				}
				elseif($quantity > $availableQnt) {				
					if($availableQnt==0) {
						echo "<p>Unfortunately The chosen book is not available right now! :(</p>";
						$printData = false;
					}
					else {
						echo "<p>Unfortunately we have only $availableQnt copies of the chosen book!<p>";
						$printData = false;
					}
				}
				else {
					$ris2 = mysqli_query($conn, "UPDATE books SET Quantita = Quantita - ". $quantity." WHERE ID = '".$id."'");
					if (!$ris2)
						die("Error updating the database of books!");
				}
				$price = $result['Prezzo'];
				$description = $result['Descrizione'];
			}
#			echo "DEBUG - total rows: $totalRows \t available quantity: $availableQnt";

			if($printData) {
				#print the real information
				echo "<p>You want to buy $quantity unit(s) of the book ''$description'', each book costs $price €. <br>",
					"<p>You will spend ".$price*$quantity." €</p>";
			}
			
			mysqli_free_result($res);
			mysqli_close($conn);
			
		?>
		<p>	<a href="lab7_2_4_A.php">Go back</a> </p>

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
