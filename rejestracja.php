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

    <form action="rejestracja_sql.php" method="post">
        Podaj dane: <br />

        Numer indeksu: <br /> <input type="number" name="nr_indeksu" /> <br />
        Imie: <br /> <input type="text" name="imie" /> <br />
        Nazwisko: <br /> <input type="text" name="nazwisko" /> <br />
        Hasło: <br /> <input type="text" name="haslo" /> <br />


        <input type="submit" value="Dodaj" />

    </form>

</body>

</html>