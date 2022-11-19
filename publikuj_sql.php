<?php

session_start();
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

    require_once "connect.php";

    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

    //$nr = $_POST['glos'];



    if ($polaczenie->connect_errno != 0) {
        echo "Nie nawiazano połaczenia \n";
    }
    //$nr = $_POST['glos'];


    else {
        $nr = $_POST['glos'];
        if (!isset($nr)) {
            echo "Nie wybrano wyborow!" ?>
            <br /><br />
            Wróć do publikacji!
            <form action="publikacja.php" method="post">
                <input type="submit" value="Powrót" />
            </form>
            <?php
        } else {
            //mysqli_query($polaczenie, $zapytanie_wyniki);

            $zapytanie_publikuj = "UPDATE wybory SET wyniki=1 WHERE id_wyborow='$nr'";
            $zapytanie_czy_juz = "SELECT wyniki, liczba_posad FROM wybory WHERE id_wyborow='$nr'";

            $dane_zapytanie_czy_juz = mysqli_query($polaczenie, $zapytanie_czy_juz);
            $czy_publikowac = mysqli_fetch_array($dane_zapytanie_czy_juz);
            if ($czy_publikowac['wyniki'] == 1) {
            ?>
                <br /><br />
                Wyniki już zostały opublikowane! Wróć do strony głównej.
                <form action="index.php" method="post">
                    <input type="submit" value="Powrót" />
                </form>
            <?php
            } else {
                $liczba_posad = $czy_publikowac['liczba_posad'];
                $zapytanie_zwyciezcy = "SELECT imie, nazwisko, liczba_glosow FROM kandydaci LEFT JOIN wyborcy ON kandydaci.nr_indeksu=wyborcy.nr_indeksu WHERE id_wyborow='$nr' ORDER BY liczba_glosow DESC LIMIT $liczba_posad";
                $dane_zapytanie_zwyciezcy = mysqli_query($polaczenie, $zapytanie_zwyciezcy);
                $ile = mysqli_num_rows($dane_zapytanie_zwyciezcy);
                mysqli_query($polaczenie, $zapytanie_publikuj);
            ?>
                <table width="900" align="center" border="1" bordercolor="#d5d5d5" cellpadding="0" cellspacing="0">
                    <caption>Zwycięzcy</caption>
                    <tr>
                        <?php

                        if ($ile >= 1) {
                            echo <<<END
					<td width="50" align="center" bgcolor="e5e5e5">Imie </td>
					<td width="100" align="center" bgcolor="e5e5e5">Nazwisko</td>
					<td width="150" align="center" bgcolor="e5e5e5">Liczba głosów</td>
					</tr><tr>
END;
                        }

                        for ($i = 1; $i <= $ile; $i++) {

                            $row = mysqli_fetch_assoc($dane_zapytanie_zwyciezcy);
                            $imie = $row['imie'];
                            $nazwisko = $row['nazwisko'];
                            $liczba_glosow = $row['liczba_glosow'];

                            echo <<<END
					<td width="50" align="center">$imie</td>
					<td width="100" align="center">$nazwisko</td>
					<td width="150" align="center">$liczba_glosow</td>
					</tr><tr>
END;
                        }
                        ?>
                    </tr>
                </table>
                <br /><br />
                Opublikowano wyniki! Wszyscy wyborcy mogą je teraz zobaczyć. Wróć do strony głównej.
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