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
	
	$res = mysqli_query($conn, "SELECT ID, Descrizione, Prezzo, Quantita FROM books");
	if (!$res)
		die("Error in query execution!");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="content-type">
		<title>Lab 7.2.6 - B</title>
		<link href="styles.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="functions.js"></script>
	</head>

	<body>
		<form id="summary" action="lab7_2_6_C.php" method="get">  	
			<TABLE id="tabella">
			<TR><TH> ID </TH><TH> Description </TH><TH> Price </TH><TH> Desired Quantity </TH><TH> Total </TH></TR>
				<?php
					$unavailable = "<p>We do not have <strong>enough quantity</strong> of the following books:<UL>";
					$unav = false;
					$total = 0;
					
					$row = mysqli_fetch_array($res);
					while($row != NULL) {
						$id = $row['ID'];
						
						$qnt = $_GET["r$id"];
						if( ($qnt > 0)&&(is_numeric($qnt)) ){
							if($qnt > $row['Quantita']) {
								$unav = true;
								$unavailable = $unavailable."<LI>".$row['Descrizione']."</LI>";
							}
							else {
								$costo = $qnt*$row['Prezzo'];
								echo "<TR><TD> $id </TD><TD> ".$row['Descrizione']." </TD>",
									"<TD> ".$row['Prezzo']." € </TD><TD>".$qnt."</TD><TD> $costo € </TD>";
								$total += $costo;
								
								echo "<input type='hidden' name='r$id' value='$qnt'>";
							}
						}
						
						$row = mysqli_fetch_array($res);
					}
					mysqli_free_result($res);
					mysqli_close($conn);
				?>
			</TABLE>
			<?php
				if($unav) {		# print the unavailable books
					$unavailable = $unavailable."</UL>So we remove that from the order.<BR>If you want to modify your order <a href='lab7_2_6_A.php'>Go back</a>!</p>";
					echo $unavailable;
				}
				echo "<p>The <strong>total</strong> of your order is = ",
					"<input type='text' name='total' value='$total' readonly style='width: 60px; text-align: right;'> € </p>"
			?>
			<div><input type="submit" value="Buy" style="width: 100px">
			<input type="button" value="Delete Order" style="width: 100px" onclick="javascript:location.href = 'lab7_2_6_A.php';"></div>
		</form>
		<br>
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
