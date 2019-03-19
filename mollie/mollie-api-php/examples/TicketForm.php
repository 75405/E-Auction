<?php
session_start();
require("../../../config_auth0.php");

// Laad all externe componenten
require("../vendor/autoload.php");

// Initialiseer Auth0
use Auth0\SDK\Auth0;
$auth0 = new Auth0($auth0_config);

// Probeer de ingelogde user uit te lezen
$userInfo = $auth0->getUser();

// Was a user found?
if ($userInfo) {
	$_SESSION['Voornaam'] = $userInfo['given_name'];
	$_SESSION['Achternaam'] =  $userInfo['family_name'];
	$_SESSION['username'] =  $userInfo['nickname'];
	$username = $userInfo['nickname'];
	// check of er rechten zijn voor deze user
	   
} else {
	
	header("Location:../login.php");
}

/***********************************************
 ***********************************************
 *            COUNT EN VERWIJZINGEN
 ***********************************************
 ***********************************************/
$username = $_SESSION['username'];

require('config/config.php');

// check aantal kaartjes
$check = "SELECT * FROM `QRgen` WHERE `Active` = 'TRUE'";
$count = mysqli_query( $conn, $check );
$num_rows = mysqli_num_rows( $count );

// check aantal introducees
$result2 = "SELECT * FROM `QRgen` WHERE `Introducee` = 'TRUE'";
$count2 = mysqli_query( $conn, $result2 );
$num_rows2 = mysqli_num_rows( $count2 );

// voeg ze samen
$aantal = $num_rows + $num_rows2;

// check totaal aantal kaartjes
if ($aantal >= 60) {
  // er kunnen geen kaatjes meer verkocht worden melding
  echo "<p>Kunnen geen kaartjes meer gekocht worden.</p>";
}
else
{
  // check of persoon een tikket heeft gekocht
  $user = "SELECT `Active` FROM `QRgen` WHERE `ID_Studnum` = '$username'";
  $userlog = mysqli_query( $conn, $user );
  $fUserlog = mysqli_fetch_row($userlog);
  if ($fUserlog[0] == "TRUE")
  {
	// check of de user een introducee heeft
	$cIntroducee = "SELECT `Introducee` FROM `QRgen` WHERE `ID_Studnum` = '$username'";
	$introducee = mysqli_query( $conn, $cIntroducee );
	$fIntroducee = mysqli_fetch_row($introducee);

	if ($fIntroducee[0] == "TRUE")
	{
	  // echo "<script>console.log('Verwezen naar ticketPagina. Introducee active');</script>";
	  header('Location:mollie/TicketPagina/TicketPagina.php');
	}
	elseif ($fIntroducee[0] == "FALSE")
	{
	  //echo "<script>console.log('Verwezen naar ticketform. Introducee niet active');</script>";
	  header('Location:mollie/tikketform.php');
	}
	else
	{
	  echo "<p>Er is iets anders mis Introducee.</p>";
	}
  }
  elseif ($fUserlog[0] == "FALSE")
  {
	// echo "<script>console.log('Verwezewn naar ticketform. Ticket nog niet active');</script>";
	header('Location:mollie/tikketform.php');
  }
  else
  {
	echo "<p>Er is iets anders mis Introducee.</p>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<title></title>
</head>
<body>
<header>
	<div>
		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="#">
				<img src="foto/GLRlogo.png" alt="Logo" class="logo">
			GLR
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">Schoolfeest<span class="sr-only">(current)</span></a>
					</li>
			</ul>
			</div>
		</nav>
		<!-- Alcohol controle Warning! -->
		<div class="alert alert-warning alert-dismissible fade show">
		<p><strong>Let OP!</strong> Er is een <strong>alcoholcontrole</strong> bij de deur, dus niet drinken voor dat je naar binnen gaat. Je bent <strong>GEWAARSCHUWD!</strong></p>
		</div>
	</div>
</header><!-- /header -->
<main>
	<div class="container">
		<div class="">
			<form class="formulier" action="mollie-api-php/examples/testmollie.php" method="post">
				<div class="form-group">
					<h3 class="h3center">Tickets hier kopen</h3>
					<!-- Uitleg kaarten -->
					<div class="alert alert-info alert-dismissible fade show">
						<p>Hier kun je een of twee tickets kopen, je kunt alleen een introducee meenemen naar het feest.</p>
						<p>Na het kopen van een kaart krijg je een email binnen met je kaart er in, de kaarten binnen krijgen zou een tijd kunnen duren maar wees gerust want je heb zoizo een plek!</p>
						<p><strong>Let OP! Als je een kaart koopt kun je het niet meer terug brengen!</strong></p>
						<p><strong>Let OP! Neem je studenten pas mee!</strong></p>
					</div>

				</div>
				<!-- Voornaam -->
				<div class="mt-2 form-group">
					<label for="VoorNaam">Voornaam</label>
					<input type="text" class="form-control" id="VoorNaam" placeholder="Voornaam" name="VoorNaam" value="<?php echo $userInfo['given_name'];?>" disabled="disabled" >
				</div>
				<!-- Achternaam -->
				<div class="form-group">
					<label for="AchterNaam">Achternaam</label>
					<input type="text" class="form-control" id="AchterNaam" placeholder="Achternaam" name="AchterNaam" value="<?php echo $userInfo['family_name'];?>" disabled="disabled">
				</div>
				<!-- Student nummer -->
				<div class="form-group">
					<label for="StudentNummer">Student Nummer</label>
					<input type="text" class="form-control" id="StudentNummer" placeholder="Student Nummer" name="StudentNummer" value="<?php echo $userInfo['nickname'];?>" disabled="disabled">
				</div>
				<!-- Kaart TIP -->
				<div class="alert alert-info alert-dismissible fade show">
					<p><strong>TIP! </strong>Bij het verwijderen van je kaart in je email kun je altijd nog op de website je kaart terug vinden!</p>
				</div>
				<hr>
				<div class="form-group">
					<div>
						<label for="introducee">Neem je een introducee mee?</label>
					</div>
					<!-- Rounded switch -->
					<label>Nee  </label>
					<label class="switch">
						<input type="checkbox" name="check" id="checkbox" value="true" onclick="myFunction()"><!-- name/value toevoegen -->
						<span class="slider round"></span>
					</label>
					<label>  Ja</label>
				</div>
				<!-- Drop down for Introducee -->
				<div id="myDIV">
					<!-- Voornaam -->
					<div class="mt-2 form-group" >
						<label for="VoorNaam">Voornaam van je introducee:</label>
						<input type="text" class="form-control" name="VoorNaamIntro" id="VoorNaamIntro" placeholder="Voornaam van je introducee" >
				  	</div>
					<!-- Achternaam -->
					<div class="form-group">
						<label for="AchterNaam">Achternaam</label>
						<input type="text" class="form-control" name="AchterNaamIntro" id="AchterNaamIntro" placeholder="Achternaam van je introducee"><!-- name toevoegen -->
					</div>
				</div>
				<button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
			</form>
		</div>
	</div>
</main>
<!-- Footer -->
<footer class="footer bg-light">
	<!-- Copyright -->
	<div class="py-3">
		<strong>© 2019 Stichting:<a id="footerLink" href="https://www.glr.nl/" target="_blank">GLR Grafisch Lyceum Rotterdam</strong></a> - <strong>KvK:</strong> 41126201 - <strong>Heer bokelweg 255, 3025 AD Rotterdam</strong> - <strong>Tel.</strong> 008-2001500
	</div>
</footer>

<script>
	function myFunction() {
	  var x = document.getElementById("myDIV");

		if (x.style.display === "block") {
		  x.style.display = "none";
		  document.getElementById("checkbox").checked = false;
		} else {
		  x.style.display = "block";
		  document.getElementById("checkbox").checked = true;
		}
	}
   </script>
</body>
</html>