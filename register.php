<?php
session_start();
//het aanmaken van de token en die in een sessie stoppen
$token = bin2hex( openssl_random_pseudo_bytes( 32 ) );
$_SESSION['token'] = $token;
// het ophallen van de tijd en die vervolgens in een session stoppen
$time = time();
$_SESSION['timestamp'] = $time;
// het ophallen van de clients ip address
$server = $_SERVER["REMOTE_ADDR"];
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="CSS/login.css">
	<title>Register</title>
	
</head>

<body>
	<div class="box">
		<form action="registerverwerk.php" method="POST">
			<h1 class="content">Register</h1>
			<input type="hidden" name="csrf_token" value="<?php echo $token;?>">
			<div class="form-group">
				<label for="exampleInputEmail1" class="content">Email adres:</label>
				<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Voer email in" name="Email">
			</div>
			<div>
				<label for="Voornaam" class="content">Voornaam:</label>
				<input class="form-control" type="text" placeholder="Voornaam" name="Voornaam">
			</div>
			<div>
				<label for="Achternaam" class="content">Achternaam:</label>
				<input class="form-control" type="text" placeholder="Achternaam" name="Achternaam">
			</div>
			<div>
				<label for="Telefoonnummer" class="content">Telefoonnummer:</label>
				<input class="form-control" type="text" placeholder="Telefoonnummer" name="Telefoonnummer">
			</div>
			<div>
				<label for="Woonplaats" class="content">Woonplaats:</label>
				<input class="form-control" type="text" placeholder="Woonplaats" name="Woonplaats">
			</div>
			<div>
				<label for="Straatnaam" class="content">Straatnaam:</label>
				<input class="form-control" type="text" placeholder="Straatnaam" name="Straatnaam">
			</div>
			<div>
				<label for="Huisnummer" class="content">Huisnummer:</label>
				<input class="form-control" type="text" placeholder="Huisnummer" name="Huisnummer">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1" class="content">Wachtwoord:</label>
				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Wachtwoord" name="Wachtwoord1">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1" class="content">Herhaal u wachtwoord:</label>
				<input type="password" class="form-control" id="exampleInputPassword2" placeholder="Wachtwoord" name="Wachtwoord2">
			</div>
			<small id="emailHelp" class="des">Deel nooit u inlog gegevens met anderen.</small><br>
			<p class="content">Heeft u al een account? <a href="login.php" class="text">Log dan hier in!</a></p>
			<input type="submit" class="btn btn-primary" name="submit" value="Login">
		</form>
	</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>