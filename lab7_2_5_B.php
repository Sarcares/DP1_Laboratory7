<?php
	session_start();
		
	if(count($_GET)===0) {
		echo "<!DOCTYPE html><html><head><title>Error!</title></head>",
			"<body><p>Please before visit this page go ", 
			"<a href='lab7_2_5_A.php'>here</a> and enter your data!</p></body></html>";
		die();
	}
		
	$id	= (int)$_GET['id'];
	$description = $_GET['description'];
	$price = $_GET['price'];
	$quantity = $_GET['quantity'];
	if( ($id==="")||($description==="")||($price==="")||($quantity==="") ) 
	{
		echo "<!DOCTYPE html><html><head><title>Error!</title></head>",
			"<body><p>Do you have inserted an empty string?! <BR> Go ",
			"<a href='lab7_2_5_A.php'>here</a> and enter your data again, please!</p></body></html>";
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
		<title>Lab 7.2.5 - B</title>
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
			if($id <= $totalRows) {
				echo "<p>You have inserted an already existent ID! You have to choose an ID greater then $totalRows</p>";
				$printData=false;
			}
			
			/* ----- Price's checking ----- */
			if($price < 0) {
				echo "<p>You have inserted a negative price!</p>";
				$printData=false;
			}
			
			/* ----- Quantity's checking ----- */
			if($quantity < 0) {
				echo "<p>Do you have inserted a negative Quantity!</p>";
				$printData = false;
			}
			
			/*
				$ris2 = mysqli_query($conn, "UPDATE books SET Quantita = Quantita - ". $quantity." WHERE ID = '".$id."'");
				if (!$ris2)
					die("Error updating the database of books!");
			*/

			if($printData) {	# print the real information and insert them into the database
				$res = mysqli_query($conn, "INSERT INTO books (ID, Descrizione, Prezzo, Quantita) VALUES (".$id.",'".$description."', ".$price.", ".$quantity.")");
				if (!$res)
					die("Impossible to add the new record to the database (".mysqli_errno($conn)."):<BR>".mysqli_error($conn));
				
				echo "<p>The record<br>",
					"DESCRIPTION = $description - PRICE = $price - QUANTITY = $quantity",
					"<br> was been inserted!</p>";
			}
			
			mysqli_close($conn);
			
		?>
		<p>	<a href="lab7_2_5_A.php">Go back</a> </p>

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
