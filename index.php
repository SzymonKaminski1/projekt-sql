<?php

session_start();

if (isset($_SESSION['zalogowano_na']) && $_SESSION['zalogowano_na'] == 1) {
    header('Location: komisja.php');
}
if (isset($_SESSION['zalogowano_na']) && $_SESSION['zalogowano_na'] == 2) {
    header('Location: wyborca.php');
}

?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> projekt z baz danych</title>
    </ head>

<body>

    <form action="zaloguj.php" method="post">

        Login: <br /> <input type="text" name="login" /> <br />

        Hasło: <br /> <input type="text" name="haslo" /> <br />
        <input type="submit" value="Zaloguj się" />

    </form>

    <form action="rejestracja.php" method="post">
        <input type="submit" value="Zarejestruj się" />
    </form>

    <?php
    if (isset($_SESSION['blad'])) echo $_SESSION['blad']
    ?>

</body>

</html>