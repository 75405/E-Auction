<?php
session_start();
session_regenerate_id();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Loginverwerk</title>
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
			$url = "login.php";
			if (isset($_SERVER["HTTP_REFERER"]) == $url)
			{
				//lees alle formuliervelden
				$username = $_POST['Email'];
				$password = $_POST['Wachtwoord'];
				$_SESSION['Email'] = $username;
					// controleer of alle formulieren waren ingevuld
					if (strlen($username) > 0 && strlen($password) > 0)
					{
						//lees het config-bestand
						require_once('config/config.php');


						//versleutel het wachtwoord
						$password = md5($password);
						//maak de conrole-query
						$query = "SELECT * FROM `E-Auction_Login`
									WHERE Email = '$username'
									AND Wachtwoord = '$password'";
						//voer de query uit 
						$result = mysqli_query($conn, $query);
						// het ophallen van de clients ip address
						$server = $_SERVER["REMOTE_ADDR"];
						$_SESSION["IP"] = $server;
						//controleer of de login correct was
						if (mysqli_num_rows($result) == 1)
						{
							$info = mysqli_fetch_array($result);
							$_SESSION ['ip'] = $_SERVER['REMOTE_ADDR'];
							$_SESSION['username'] = $username;
							header('Location: itemtoevoegen.php');


						}
						else
						{
							//login incorrect, terug naar het login-formulier.
							header("Location:login.php");
						}
					}
					else
					{
						echo "<p>Niet alle velden zijn ingevuld!</p>";
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