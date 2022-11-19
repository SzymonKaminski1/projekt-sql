<?php
session_start();

require_once "connect.php";

$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Nie nawiazano połaczenia";
} else {
?>
    <!DOCTYPE HTML>
    <html lang="pl">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title> projekt z baz danych</title>
        </ head>
		


    <body>

        <?php

        echo "<p>Zalogowano jako: " . $_SESSION['imie'] . " " . $_SESSION['nazwisko'] . ".";
        ?>
        <br /><br /> <br /><br />
Wybierz wybory, których wyniki chcesz opublikować:
        <table width="900" align="center" border="1" bordercolor="#d5d5d5" cellpadding="0" cellspacing="0">
		<caption>Wybory</caption>
            <tr>
			<form action="publikuj_sql.php" method="post">
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
<td width="20" align="center" bgcolor="e5e5e5">Wybierz wybory</td>
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
<td align="center"><input type="radio" name="glos" value="$id_wyborow" />
</tr><tr>
END;
            }
        }


            ?>


            </tr>
        </table>

        <br /> <br />
        
            <br /> <input type="submit" value="Wybierz" name="wybierz" />
        </form>

    </body>

    </html>