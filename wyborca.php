<?php
		session_start();
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title> projekt z baz danych</title>
</ head>

<body>
	
	<?php
	
	echo "<p>[KONTO UZYTKOWNIKA]";
	echo "</br></br>"; 
	
	echo "Zalogowano jako: ".$_SESSION['imie']." ".$_SESSION['nazwisko']."."; 
	
	?>
<form action="dodaj_kandydata.php" method="post">
	<input type="submit" value="Dodaj kandydata"/>
</form>
<form action="spis_wyborow.php" method="post">
	<input type="submit" value="Zagłosuj"/>
</form>
<form action="zobacz_wyniki.php" method="post">
	<input type="submit" value="Zobacz wyniki"/>
</form>
<form action="wyloguj.php" method="post">
	<input type="submit" value="Wyloguj się"/>
</form>

</body>
</html>