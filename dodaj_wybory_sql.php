<?php

require_once "connect.php";

$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Nie nawiazano połaczenia";
} else {

    $id_wyborow = $_POST['id_wyborow'];
    $nazwa_wyborow = $_POST['nazwa_wyborow'];
    $id_komisja = $_POST['id_komisja'];
    $liczba_posad = $_POST['liczba_posad'];
    $rozpoczecie = $_POST['rozpoczecie'];
    $zakonczenie = $_POST['zakonczenie'];
    $termin_zglasz = $_POST['termin_zglasz'];

    $wstaw_wyb = "INSERT INTO wybory (id_wyborow, nazwa_wyborow, id_komisja, liczba_posad, rozpoczecie, zakonczenie, termin_zglasz, wyniki) VALUES ('$id_wyborow', '$nazwa_wyborow', '$id_komisja', '$liczba_posad', '$rozpoczecie', '$zakonczenie', '$termin_zglasz', 0)";

		
		$dane_z_bazy = $polaczenie->query("SELECT id_wyborow FROM wybory WHERE id_wyborow='$id_wyborow'");
		$czy_id_juz_istnieje = $dane_z_bazy->num_rows;
		if($czy_id_juz_istnieje>0)
		{?>
					
		Takie ID wyborów już istnieje! Wróć do stony głownej.<br /><br />
	
		<form action="index.php" method="post">
		<input type="submit" value="Powrót" />
		</form>
<?php					
		}
		else {

    if ($polaczenie->query("INSERT INTO wybory (id_wyborow, nazwa_wyborow, id_komisja, liczba_posad, rozpoczecie, zakonczenie, termin_zglasz, wyniki) VALUES ('$id_wyborow', '$nazwa_wyborow', '$id_komisja', '$liczba_posad', '$rozpoczecie', '$zakonczenie', '$termin_zglasz', 0)")) {
?>
        Udało Ci się dodać wybory! Wróć do strony głownej.<br /><br />

        <form action="index.php" method="post">
            <input type="submit" value="Powrót" />
        </form>
    <?php
    } else {
    ?>
        Nie udało Ci się dodać wyborów! Wróć do strony głownej.<br /><br />

        <form action="index.php" method="post">
            <input type="submit" value="Powrót" />
        </form>
	
<?php
    }
		}


    $polaczenie->close();
}
?>