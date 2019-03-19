<?php
session_start();
session_regenerate_id();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>toevoegverwerk</title>
</head>

<body>
	<?php
	//controller of je iets binnen krijgt uit een submit
	if (isset($_POST['submit']))
	{
		//controlle of de user de juiste token heeft
		if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['csrf_token'])
		{
			//controller of de user van de correcte url komt
			$url = "itemtoevoegen.php";
			if (isset($_SERVER["HTTP_REFERER"]) == $url)
			{
				//lees alle formuliervelden
				$Naam = $_POST['Naam'];
				$Descriptie = $_POST['Descriptie'];
				$Prijs = $_POST['Prijs'];
				$exampleRadios = $_POST['exampleRadios'];
				$username = $_POST['username'];
					// controleer of alle formulieren waren ingevuld
					if (strlen($Naam) > 1 && strlen($Descriptie) > 1 && is_numeric($Prijs) && strlen($Prijs) > 1)
					{
						//lees het config-bestand
						require_once('config/config.php');
						// bepaal waar de folder komt
						
						$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
						$txt = "$username\n";
						fwrite($myfile, $txt);
						$txt = "Jane Doe\n";
						fwrite($myfile, $txt);
						fclose($myfile);
						
						$query = "INSERT INTO `E-Auction_Producten`(`Product_Nummer`, `Product_Naam`, `Product_Prijs`, `Product_Descriptie`, `Product_Categorie`, `Product_Image`, `Product_View`) 
						VALUES ('','$Naam','$Prijs','$Descriptie','$exampleRadios','gfdg','gfdg')";
						$resultaat = mysqli_query( $conn, $query );
						
						$structure = "Users/$username/$Naam";

						if ( !mkdir( $structure, 0777, true ) ) {
								die( 'Failed to create folders...' );
						}
						


					}
					else
					{
						echo "<p>Niet alle velden zijn juist ingvoerd!</p>";
					}
			}
		}
		else
		{
			echo "<p>U heeft het formulier niet ingevuld.</p>";
		}
	}
	else
	{
		echo "<p>We hebben geen data binnen.</p>";
	}
	?>
</body>
</html>