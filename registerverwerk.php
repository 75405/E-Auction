<?php
session_start();
session_regenerate_id();
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>registerverwerk</title>
</head>

<body>
	<?php
	//controller of je iets binnen krijgt uit een submit
	if ( isset( $_POST[ 'submit' ] ) ) {
		//controlle of de user de juiste token heeft
		if ( isset( $_SESSION[ 'token' ] ) && $_SESSION[ 'token' ] == $_POST[ 'csrf_token' ] ) {
			//controller of de user van de correcte url komt
			$url = "register.php";
			if ( isset( $_SERVER[ "HTTP_REFERER" ] ) == $url ) {
				//lees alle formuliervelden
				$username = $_POST[ 'Email' ];
				$Voornaam = $_POST[ 'Voornaam' ];
				$Achternaam = $_POST[ 'Achternaam' ];
				$Telefoonnummer = $_POST[ 'Telefoonnummer' ];
				$woonplaats = $_POST[ 'Woonplaats' ];
				$straatnaam = $_POST[ 'Straatnaam' ];
				$huisnummer = $_POST[ 'Huisnummer' ];
				$password = $_POST[ 'Wachtwoord1' ];
				$password2 = $_POST[ 'Wachtwoord2' ];
				// controleer of alle formulieren waren ingevuld
				if ( strlen( $username ) > 0 && strlen( $Voornaam ) > 0 && strlen( $Achternaam ) > 0 && strlen( $Telefoonnummer ) > 0 && strlen( $woonplaats ) > 0 && strlen( $straatnaam ) > 0 && strlen( $huisnummer ) > 0 && strlen( $password ) > 0 && strlen( $password2 ) > 0 ) {
					//lees het config-bestand
					require_once( 'config/config.php' );


					//versleutel het wachtwoord
					$password = md5( $password );
					$password2 = md5( $password2 );
					//maak de conrole-query
					$query = "SELECT * FROM `E-Auction_Login`
									WHERE Email = '$username'";
					//voer de query uit 
					$result = mysqli_query( $conn, $query );
					// het ophallen van de clients ip address
					$server = $_SERVER[ "REMOTE_ADDR" ];
					$_SESSION[ "IP" ] = $server;
					//controleer of de login correct was
					if ( mysqli_num_rows( $result ) == 1 ) {
						//als de user al voorkomt
						header( "Location:register.php" );

					} else {

						$info = mysqli_fetch_array( $result );
						$_SESSION[ 'ip' ] = $_SERVER[ 'REMOTE_ADDR' ];
						$_SESSION[ 'username' ] = $username;
						if ( $password == $password2 ) {
							$query = "INSERT INTO `E-Auction_Login` (`Email`, `Voornaam`, `Achternaam`, `Telefoonnummer`, `Woonplaats`, `Straatnaam`, `Huisnummer`, `Wachtwoord`) VALUES ('$username', '$Voornaam', '$Achternaam', '$Telefoonnummer', '$woonplaats', '$straatnaam', '$huisnummer', '$password')";
							$resultaat = mysqli_query( $conn, $query );
							// bepaal waar de folder komt
							$structure = "Users/$username";

							if ( !mkdir( $structure, 0777, true ) ) {
								die( 'Failed to create folders...' );
							}
							header( "Location:login.php" );
						} else {
							header( 'Location: register.php' );
						}
					}
				} else {
					echo "<p>Niet alle velden zijn ingevuld!</p>";
				}
			}
		} else {
			echo "<p>U heeft het formulier niet ingevuld.</p>";
		}
	} else {
		echo "<p>We hebben geen data binnen.</p>";
	}
	?>
</body>
</html>