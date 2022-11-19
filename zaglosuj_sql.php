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

	require_once "connect.php";
	
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	
	//$nr = $_POST['glos'];
	

	
	if($polaczenie->connect_errno!=0)
	{
		echo "Nie nawiazano połaczenia";
	}
	//$nr = $_POST['glos'];
	
		
	else 
	{
			$nr = $_POST['glos'];
			$login = $_SESSION['login'];
		if(!$nr)
		{
			echo "Nie wybrano kandydata!"?>
			<br /><br />
			Wróć do głosowania.
			<form action="spis_wyborow.php" method="post">
			<input type="submit" value="Powrót" />
			</form>
			<?php
		}
		else
		{
			
			
			$zapytanie_mozliwosc = "SELECT czy_glosowal FROM wyborcy WHERE nr_indeksu='$login'";
			$dane_zapytanie_mozliwosc = mysqli_query($polaczenie, $zapytanie_mozliwosc);
			$mozliwosc = mysqli_fetch_array($dane_zapytanie_mozliwosc);
			if($mozliwosc['czy_glosowal']==1)
			{
				?>
				<br /><br />
			Oddałeś już swój głos! Wróć do strony głównej.
			<form action="index.php" method="post">
			<input type="submit" value="Powrót" />
			</form>
			<?php	
			}
			
			else
			{
				 
				$zapytanie_liczba_glosow = "SELECT liczba_glosow FROM kandydaci WHERE nr_indeksu='$nr'";
				$dane_zapytanie_liczba_glosow = mysqli_query($polaczenie, $zapytanie_liczba_glosow);
				$dane_zapytanie_liczba_glosow2 = mysqli_fetch_array($dane_zapytanie_liczba_glosow);
				$liczba_glosow2 = $dane_zapytanie_liczba_glosow2['liczba_glosow'];
				$liczba_glosow_up = $liczba_glosow2+1;
				$zapytanie_glos = "UPDATE kandydaci SET liczba_glosow='$liczba_glosow_up' WHERE nr_indeksu='$nr'";
				$zapytanietxt_zablokuj_mozliwosc = "UPDATE wyborcy SET czy_glosowal=1 WHERE nr_indeksu='$login'";
				$dane_zapytanie_mozliwosc = mysqli_query($polaczenie, $zapytanie_glos);
				$dane_zapytanie_mozliwosc = mysqli_query($polaczenie, $zapytanietxt_zablokuj_mozliwosc);
					?>
				<br /><br />
			Głos został zapisany! Wróć do strony głownej.
			<form action="index.php" method="post">
			<input type="submit" value="Powrót" />
			</form>
			<?php	
			}

		}
		
	}
		
		?>
</body>
</html>