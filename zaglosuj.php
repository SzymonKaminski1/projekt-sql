<?php
session_start();

require_once "connect.php";

$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Nie nawiazano połaczenia";
} else { ?>
    <!DOCTYPE HTML>
    <html lang="pl">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title> projekt z baz danych</title>
        </>

    <body>

        <?php

        echo "<p>Zalogowano jako: " . $_SESSION['imie'] . " " . $_SESSION['nazwisko'] . ".";
		echo "</br></br>";
		                    $id_wyborow_us = $_POST['wyb_id'];
					if(!$id_wyborow_us)
					{
						?>
                Nie wybrano ID wyborów! Wróć do głosowania.<br /><br />

                <form action="spis_wyborow.php" method="post">
                    <input type="submit" value="Powrót" />
                </form>
                <?php
					}
					else {
						$dane_czy_zakonczone = $polaczenie->query("SELECT id_wyborow FROM wybory WHERE id_wyborow='$id_wyborow_us' AND zakonczenie > NOW()");
                    $czy_zakonczone = $dane_czy_zakonczone->num_rows;
                    if ($czy_zakonczone == 0) { ?>
                        Wybory zostały zakończone! Wróć do strony głównej.<br /><br />

                        <form action="index.php" method="post">
                            <input type="submit" value="Powrót" />
                        </form>
                        <?php
                    }
					else
					{
						
        ?>
		
        <br />
        <br />
        <table width="900" align="center" border="1" bordercolor="#d5d5d5" cellpadding="0" cellspacing="0">
            <tr>
                <form action="zaglosuj_sql.php" method="POST">

                    <?php
                    mysqli_query($polaczenie, "SET CHARSET utf8");
                    mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
                    mysqli_select_db($polaczenie, $database);

                    ?>
                    <br />
                <?php
                $zapytanietxt = "SELECT wyborcy.nr_indeksu, imie, nazwisko FROM kandydaci LEFT JOIN wyborcy ON kandydaci.nr_indeksu=wyborcy.nr_indeksu WHERE id_wyborow='$id_wyborow_us'";

                $rezultat = mysqli_query($polaczenie, $zapytanietxt);
                $ile = mysqli_num_rows($rezultat);

                if ($ile >= 1) {
                    echo <<<END
<td width="100" align="center" bgcolor="e5e5e5">Numer indeksu kandydata</td>
<td width="100" align="center" bgcolor="e5e5e5">Imie kandydata</td>
<td width="100" align="center" bgcolor="e5e5e5">Nazwisko kandydata</td>
<td width="100" align="center" bgcolor="e5e5e5">Oddaj głos</td>
</tr>
<tr>
END;
                }
                for ($i = 1; $i <= $ile; $i++) {

                    $row = mysqli_fetch_array($rezultat);
                    $nr_indeksu = $row['nr_indeksu'];
                    $imie = $row['imie'];
                    $nazwisko = $row['nazwisko'];

                    echo <<<END
<td width="50" align="center">$nr_indeksu</td>
<td width="100" align="center">$imie</td>
<td width="150" align="center">$nazwisko</td>
<td align="center"><input type="radio" name="glos" value="$nr_indeksu" />

</tr><tr>
END;
                    
                }
				?> </tr>
        </table>
		<?php
					 ?>
        <br />
        <input type="submit" value="Oddaj głos" name="glosuj" />
        </form>
<?php  }}}


                ?>
           
    </body>

    </html>