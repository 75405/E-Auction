<?php
error_log('test');

function createPDF() {
	require_once( 'schoolfeest/config.php' );

	/************************************************************************/
	/*																		*/
	/*  Op deze pagina wordt een barcode in HTML-code gemaakt.				*/
	/*  Aan het eind wordt deze barcode via een echo getoond op het scherm.	*/
	/*  Als je deze pagina opent in de browser zie je de barcode.			*/
	/*  Als je de broncode van de pagina bekijkt zie je dat de barcode		*/
	/*  	 	is opgebouwd uit allemaal divjes.			 				*/
	/*	Je kan boven en onder de php-code html-code toevoegen om de pagina	*/
	/*			verder op te maken.											*/
	/*																		*/
	/************************************************************************/

	// QR Generator
	$numberRand1 = rand( 1, 999999 );
	$numberRand2 = rand( 1, 999999 );
	$numberRand3 = rand( 1, 999999 );
	$letterRand1 = chr( 65 + rand( 0, 25 ) );
	$letterRand2 = chr( 65 + rand( 0, 25 ) );
	$letterRand3 = chr( 65 + rand( 0, 25 ) );
	$barCode = $numberRand1 . $letterRand1 . $numberRand2 . $numberRand3 . $letterRand2 . $letterRand3;

	// Uitschrijven van QR code naar de database
	$query = "INSERT INTO QRgen (QRcode) VALUES (md5('$barCode'))";
	$resultaat = mysqli_query( $conn, $query );

	// Uitlezen van alles in de database op een webpagina
	//echo "<h2> Alle QR-codes die nu momenteel in de database zijn opgeslagen: </h2>";
	$query1 = "SELECT * FROM QRgen";
	$resultaat1 = mysqli_query( $conn, $query1 );
	if ( $resultaat1 ) {
		//Include de class om een barcode te maken
		require 'schoolfeest/src/BarcodeGenerator.php';
		//Include de class om een PNG van de barcode te maken
		require 'schoolfeest/src/BarcodeGeneratorHTML.php';

		//Maak een "barcode-object" (genaamd: '$generator')
		$generator = new BarcodeGeneratorHTML();

		//Bepaal de instellingen van de barcode
		$code = $barCode; //tekst waarvan barcode wordt gemaakt
		$type = $generator::TYPE_CODE_128; //type barcode (zie onder)
		$breedte = 1; //breedte van 1 streepje
		$hoogte = 80; //hoogte van de barcode
		$kleur = 'black'; //kleur van de barcode

		//Maak de barcode met bovenstaande instellingen
		$barcode1 = $generator->getBarcode( $code, $type, $breedte, $hoogte, $kleur );
		//Laat eerst de code als tekst op het scherm zien
		echo "<p> $code </p>";
		echo $generator->getBarcode( $barCode, $type, $breedte, $hoogte, $kleur );

		// links
		$id = 81918;

		$link = 'schoolfeest/pdf/';
		$link .= $id;
		$link .= '.pdf';

		$imgLink = "http://www.barcodes4.me/barcode/c39/";
		$imgLink .= $code;
		$imgLink .= ".png";

		$alinea = "Deze ticket is een bewijs dat laat zien dat u het kaartje bij glr gekocht hebt. Die u moet laten zien bij de entree. Als u dit niet laat zien dan kunt u ook niet naar binnen.";

		require( 'schoolfeest/fpdf181/fpdf.php' );
		// maak een pdf
		$pdf = new FPDF();

		var_dump( $pdf );


		// maak een pagina
		$pdf->AddPage();
		$pdf->SetFillColor( 147, 112, 219 );

		// zet de font
		$pdf->SetFont( 'Arial', 'B', 16 );

		// links moeten vol uitgeschreven worden.

		//background color
		$pdf->Image( 'https://81918.ict-lab.nl/websites/beroeps2/periode1/schoolfeest/test.png', 0, 0, 0, 0, 'PNG' );
		// random cirkels position
		for ( $i = 0; $i < 50; $i++ ) {
			$randY = rand( 1, 800 );
			$randX = rand( 1, 250 );
			$size = rand( 6, 10 );
			$pdf->Image( 'https://81918.ict-lab.nl/websites/beroeps2/periode1/schoolfeest/cirkel.png', $randX, $randY, $size, $size, 'PNG' );
		}
		$pdf->Image( 'https://81918.ict-lab.nl/websites/beroeps2/periode1/schoolfeest/rand.png', 10, 60, 0, 0, 'PNG' );

		//Stappen kaart
		$pdf->Image( 'https://81918.ict-lab.nl/websites/beroeps2/periode1/schoolfeest/order.png', 10, 70, 10, 10, 'PNG' );

		$pdf->Image( 'https://81918.ict-lab.nl/websites/beroeps2/periode1/schoolfeest/print.png', 10, 80, 10, 10, 'PNG' );

		$pdf->Image( 'https://81918.ict-lab.nl/websites/beroeps2/periode1/schoolfeest/ticket.png', 10, 90, 10, 10, 'PNG' );

		$pdf->Image( 'https://81918.ict-lab.nl/websites/beroeps2/periode1/schoolfeest/scan.png', 10, 100, 10, 10, 'PNG' );

		// TITLE
		$pdf->Image( 'https://81918.ict-lab.nl/websites/beroeps2/periode1/schoolfeest/logosmall.png', 60, 0, 90, 60, 'PNG' );

		$pdf->SetX( 10 );
		$pdf->SetY( 200 );
		// text met een andere font

		$pdf->MultiCell( 190, 5, $alinea, 0, 'L', 0 );
		// barcode
		$pdf->Image( $imgLink, 75, 250, 0, 0, 'PNG' );


		// Save op de server en geef naam
		$pdf->Output( 'F', $link );
	} else {
		echo "error";
	}
}


createPDF();

