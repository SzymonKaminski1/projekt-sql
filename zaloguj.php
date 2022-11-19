<?php 
	session_start();

	require_once "connect.php";
	
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	//$polaczenie = mysqli_connect('localhost', 'root','','projekt');
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Nie nawiazano połaczenia";
	}
	else
	{
		$_SESSION['login']=$_POST['login'];
		$_SESSION['haslo']=$_POST['haslo'];
		
		$login=$_POST['login'];
		$haslo=$_POST['haslo'];
		$_SESSION['login']=$login;
		$zap_log = "SELECT * FROM wyborcy WHERE nr_indeksu='$login' AND haslo='$haslo'";
		if ($zwrot_zap_log = @$polaczenie->query($zap_log))
		{
			$czy_zal=@$zwrot_zap_log->num_rows;
			if($czy_zal==1)
			{
				$dane_uzytkownika = $zwrot_zap_log->fetch_assoc();
				$_SESSION['imie']  = $dane_uzytkownika['imie'];
				$_SESSION['nazwisko'] = $dane_uzytkownika['nazwisko'];
				if($login==1)
				{
					$_SESSION['zalogowano_na']=1;
					header('Location: komisja.php');
				}
				
				else
				{
					$_SESSION['zalogowano_na']=2;
					header('Location: wyborca.php');
				}
				$zwrot_zap_log->free_result();
				

			}
			else
			{
				$_SESSION['blad']="błędny login lub hasło";
				header('Location: index.php');
				
			}
		}
		$polaczenie->close();
	}
?>