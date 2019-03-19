	<?php
	require( '../../../config/config.php' );
	$controlle = "SELECT `payment_id`, `payment_id2`, `Bedrag` FROM `QRgen` WHERE `payment_id` = 'tr_VqW6eEAVR6' OR `payment_id2` = 'tr_VqW6eEAVR6'";
	$resultaatcontrolle = mysqli_query( $conn, $controlle );
	$rowcontrolle = mysqli_fetch_array($resultaatcontrolle);
	$nummercontrolle = $rowcontrolle['payment_id'];
	$nummercontrolle2 = $rowcontrolle['payment_id2'];
	$Bedrag = $rowcontrolle['Bedrag'];

	echo $nummercontrolle;
	echo $nummercontrolle2;
	echo $Bedrag;
	?>