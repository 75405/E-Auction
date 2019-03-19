<?php
//error_log( "test1" );
//Voeg de "Composer" toe vanuit de volgende locaties
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/functions.php";
require_once( '../../config/config.php' );

	$url1 = "https://75405.ict-lab.nl/BEROEPS/E-Action/link.html";
	if (isset($_SERVER["HTTP_REFERER"]) == $url1)
	{
	//het initalizeren van de API client van mollie
	$mollie = new\ Mollie\ Api\ MollieApiClient();
	$mollie->setApiKey( "test_VMj4PHeJwThPgVhg3n8cyVE2Dtyua4" ); //test key!!!!!!
	///////////////////// als intro mee gaat bigin////////////////////////////
		$prijs = "30.00";
		$payment = $mollie->payments->create( [
		"amount" => [
			"currency" => "EUR", //de valuta
			"value" => $prijs //de prijs van de transactie
		],
		"description" => "Betaling E-Auction",
		"redirectUrl" => "https://75405.ict-lab.nl/BEROEPS/E-Action/mollie/mollie-api-php/examples/betaling/index.php", //de verwijzing terug naar de home page
		"webhookUrl" => "https://75405.ict-lab.nl/BEROEPS/E-Action/mollie/mollie-api-php/examples/orders/webhook.php", //de verwijzing naar de webhook waarde payments woorden gecontrollerd
		] );
		// DE payment id ophalle
		//$payment = $mollie->payments->get( $payment->id );
		//echo $payment->id;
		//die;
		// get curent time
		$resultaat = mysqli_query( $conn, $query );
		date_default_timezone_set('Europe/Amsterdam');
		$time = date('h:i:s', time());
		echo $time;
		$queryupdate = "INSERT INTO `QRgen` (`ID_Studnum`, `Voornaam`, `Achternaam`, `QRcode`, `Active`, `Introducee`) VALUES ('$username', '$Voornaam', '$Achternaam', '', 'FALSE', 'FALSE')";
		$queryupdate = "UPDATE `QRgen` SET `payment_id` = '$payment->id', `bedrag` = '10', `BestelDatum` = '$date', `BestelTijd` = '$time' WHERE `QRgen`.`ID_Studnum` = '$username'";
		$resultaat = mysqli_query( $conn, $queryupdate );
		//$_POST["ID_Studnum"];
		header( "Location: " . $payment->getCheckoutUrl(), true, 303 );
		
	
	///////////////////// als intro mee gaat eind////////////////////////////

	}
	else
	{
		header('Location:../../index.php');
	}
?>