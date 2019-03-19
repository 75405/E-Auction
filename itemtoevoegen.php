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
	$username = $_SESSION['Email'];
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<title>Item toevoegen</title>
</head>

<body>
	<h1>Product toevoegen</h1>

	<form method="post" action="toevoegverwerk.php">
		<input type="hidden" name="csrf_token" value="<?php echo $token;?>">
		<input type="hidden" name="username" value="<?php echo $username;?>">
		<div class="form-group">
			<label for="TextInput">Product naam:</label>
			<input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input" name="Naam">
		</div>
		<p>Categorie</p>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Auto's" checked>
			<label class="form-check-label" for="exampleRadios1">
    Auto's
  </label>
		




		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="gereedschap">
			<label class="form-check-label" for="exampleRadios2">
    gereedschap
  </label>
		




		</div>
		<div class="form-check disabled">
			<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="Fietsen">
			<label class="form-check-label" for="exampleRadios3">
    Fietsen
  </label>
		




		</div>
		<div class="form-group">
			<label for="TextInput">Descriptie:</label>
			<input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input" name="Descriptie">
		</div>
		<div class="form-group">
			<label for="TextInput">Start prijs:</label>
			<input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input" name="Prijs">
		</div>
		<div class="input-group">
			<div class="custom-file">
				 <input type="file" name="files[]" multiple >
			</div>
		</div>
		<button type="submit" class="btn btn-primary" name="submit">Submit</button>
	</form>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>