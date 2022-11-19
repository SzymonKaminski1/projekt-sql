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

    if ($polaczenie->connect_errno != 0) {
        echo "Nie nawiazano połaczenia";
    } else {

        $nr_indeksu = $_POST['nr_indeksu'];
        $id_wyborow = $_POST['id_wyborow'];
        if (!$nr_indeksu) {
    ?>
            Nie podano numeru indeksu kandydata! Wróć do strony głównej.<br /><br />

            <form action="index.php" method="post">
                <input type="submit" value="Powrót" />
            </form>
            <?php
        } else {
            if (!$id_wyborow) {
            ?>
                Nie wybrano ID wyborów! Wróć do strony głównej.<br /><br />

                <form action="index.php" method="post">
                    <input type="submit" value="Powrót" />
                </form>
                <?php
            } else {
                $dane_czy_istnieją_takie_wybory = $polaczenie->query("SELECT id_wyborow FROM wybory WHERE id_wyborow='$id_wyborow'");
                $czy_wybory_istnieja = $dane_czy_istnieją_takie_wybory->num_rows;
                if ($czy_wybory_istnieja == 0) {
                ?>
                    Wybory o podanym ID nie istnieją! Wróć do strony głównej.<br /><br />

                    <form action="index.php" method="post">
                        <input type="submit" value="Powrót" />
                    </form>
                    <?php
                } else {

                    // bald o przekroczeniu czasu
                    $dane_czy_przekroczono_czas = $polaczenie->query("SELECT id_wyborow FROM wybory WHERE id_wyborow='$id_wyborow' AND termin_zglasz > NOW()");
                    $czy_wybory_istnieja = $dane_czy_przekroczono_czas->num_rows;
                    if ($czy_wybory_istnieja == 0) { ?>
                        Upłynął termin zgłaszania kandydatów! Wróć do strony głównej.<br /><br />

                        <form action="index.php" method="post">
                            <input type="submit" value="Powrót" />
                        </form>
                        <?php
                    } else {
                        $dane_czy_istnieje = $polaczenie->query("SELECT nr_indeksu FROM wyborcy WHERE nr_indeksu='$nr_indeksu'");
                        $czy_istnieje = $dane_czy_istnieje->num_rows;
                        if ($czy_istnieje == 0) {
                        ?>
                            Taki kandydat nie jest wyborcą (nie istnieje w bazie)! Wróć do strony głównej.<br /><br />

                            <form action="index.php" method="post">
                                <input type="submit" value="Powrót" />
                            </form>
                            <?php
                        } else {

                            $dane_z_bazy = $polaczenie->query("SELECT nr_indeksu FROM kandydaci WHERE nr_indeksu='$nr_indeksu'");
                            $czy_nr_juz_istnieje = $dane_z_bazy->num_rows;

                            if ($czy_nr_juz_istnieje > 0) { ?>

                                Taki kandydat jest już zarejestrowany! Wróć do strony głównej.<br /><br />

                                <form action="index.php" method="post">
                                    <input type="submit" value="Powrót" />
                                </form>
                                <?php
                            } else {



                                if ($polaczenie->query("INSERT INTO kandydaci (id_wyborow, nr_indeksu, `liczba_glosow`, `czy_wygral`) VALUES ('$id_wyborow', '$nr_indeksu','0','FALSE')")) {
                                ?>
                                    Udało Ci się dodać kandydata! Wróć do strony głównej.<br /><br />

                                    <form action="index.php" method="post">
                                        <input type="submit" value="Powrót" />
                                    </form>
                                <?php
                                } else {
                                ?>
                                    Nie udało Ci się dodać kandydata! Wróć do strony głównej.<br /><br />

                                    <form action="index.php" method="post">
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
    }

    ?>
</body>

</html>