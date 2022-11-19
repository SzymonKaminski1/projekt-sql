<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title> projekt z baz danych</title>
</ head>

<body>
	


<?php 

	require_once "connect.php";
	
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Nie nawiazano połaczenia";
	}
	else
	{
	
		$nr_indeksu=$_POST['nr_indeksu'];
		$imie=$_POST['imie'];
		$nazwisko=$_POST['nazwisko'];
		$haslo=$_POST['haslo'];
		
		$dane_z_bazy = $polaczenie->query("SELECT nr_indeksu FROM wyborcy WHERE nr_indeksu='$nr_indeksu'");
		$czy_nr_juz_istnieje = $dane_z_bazy->num_rows;
		if($czy_nr_juz_istnieje>0)
		{?>
					
		Taki numer indeksu już istnieje! Wróć do rejestracji.<br /><br />
	
		<form action="rejestracja.php" method="post">
		<input type="submit" value="Powrót" />
		</form>
<?php					
		}
		else {
			if(!$nr_indeksu)
			{
				?>
			Nie wprowadzono numeru indeksu! Wróć do rejestracji.<br /><br />
	
		<form action="rejestracja.php" method="post">
		<input type="submit" value="Powrót" />
		</form>
<?php	
			}
			else{
			if(!$imie)
			{
				?>
			Nie wprowadzono imienia! Wróć do rejestracji.<br /><br />
	
		<form action="rejestracja.php" method="post">
		<input type="submit" value="Powrót" />
		</form>
<?php	
			}
			else {
				
				if(!$nazwisko)
			{
				?>
			Nie wprowadzono nazwiska! Wróć do rejestracji.<br /><br />
	
		<form action="rejestracja.php" method="post">
		<input type="submit" value="Powrót" />
		</form>
<?php	
			}
			else {
	if(!$haslo)
			{
				?>
			Nie wprowadzono hasła! Wróć do rejestracji.<br /><br />
	
		<form action="rejestracja.php" method="post">
		<input type="submit" value="Powrót" />
		</form>
<?php	
			}


		else 
		{
		
			if($polaczenie->query("INSERT INTO wyborcy (nr_indeksu, imie, nazwisko, haslo, czy_glosowal) VALUES ('$nr_indeksu','$imie','$nazwisko','$haslo', 'FALSE')"))
			{?>
			Udało Ci się zarejestrować. Możesz się teraz zalogować.<br /><br />
	
			<form action="index.php" method="post">
			<input type="submit" value="Zaloguj się" />
			</form>
<?php
			}
			
		else
		{
		?>
			Wprowadzone dane są niepoprawne! Wróć do rejestracji.<br /><br />
	
		<form action="rejestracja.php" method="post">
		<input type="submit" value="Powrót" />
		</form>
<?php	
		}
		
		$polaczenie->close();
	}
		}
		}
			}
		}
	}
?>
</body>
</html>