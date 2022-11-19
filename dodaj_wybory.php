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

<table width="400" align="right" border="1" bordercolor="#d5d5d5" cellpadding="0" cellspacing="0">
<caption>Wybory</caption>
            <tr>
            <?php
            require_once 'connect.php';
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            mysqli_query($polaczenie, "SET CHARSET utf8");
            mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($polaczenie, $database);

            $zapytanietxt = file_get_contents("spis_wyborow.txt");

            $rezultat = mysqli_query($polaczenie, $zapytanietxt);
            $ile = mysqli_num_rows($rezultat);

            if ($ile >= 1) {
                echo <<<END
<td width="50" align="center" bgcolor="e5e5e5">ID wyborów</td>
<td width="100" align="center" bgcolor="e5e5e5">Nazwa wyborow</td>
</tr><tr>
END;
            }
            for ($i = 1; $i <= $ile; $i++) {

                $row = mysqli_fetch_assoc($rezultat);
                $id_wyborow = $row['id_wyborow'];
                $nazwa_wyborow = $row['nazwa_wyborow'];

                echo <<<END
<td width="50" align="center">$id_wyborow</td>
<td width="100" align="center">$nazwa_wyborow</td>
</tr><tr>
END;
            }
        


            ?>


            </tr>
        </table>

	
	<form action="dodaj_wybory_sql.php" method="post">
	
	ID wyborów: <br/> Pamiętaj, że musi być to unikalna liczba naturalna! Zobacz na listę wyborów. <br/> <input type="number" name="id_wyborow" /> <br/>
	
	Nazwa wyborów: <br/> <input type="text" name="nazwa_wyborow" /> <br/>
	
	ID komisji: <br/> <input type="number" name="id_komisja" /> <br/>
	
	Liczba posad: <br/> <input type="number" name="liczba_posad" /> <br/>
	
	Rozpoczęcie wyborów: <br/> <input type="date" name="rozpoczecie" /> <br/>
	
	Zakończenie wyborów: <br/> <input type="date" name="zakonczenie" /> <br/>
	Termin zgłaszania kandydatów: <br/> <input type="date" name="termin_zglasz" /> <br/>
	<input type="submit" value="Dodaj" />
	
	</form>

</body>
</html>