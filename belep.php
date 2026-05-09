<?php
if (isset($_POST['felhasznalo']) && isset($_POST['jelszo'])) {
    try {
        // Kapcsolódás
        $dbh = new PDO(
            'mysql:host=localhost;dbname=adatb4',
            'adatb4',
            'Cigi123',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        // Felhasználó keresése
        $sqlSelect = "
            SELECT id, csaladi_nev, uto_nev
            FROM felhasznalok
            WHERE bejelentkezes = :bejelentkezes
              AND jelszo = sha1(:jelszo)
        ";

        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(
            ':bejelentkezes' => $_POST['felhasznalo'],
            ':jelszo'        => $_POST['jelszo']
        ));

        $row = $sth->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // SIKERES BELÉPÉS
            $_SESSION['csn']   = $row['csaladi_nev'];
            $_SESSION['un']    = $row['uto_nev'];
            $_SESSION['login'] = $_POST['felhasznalo'];
            $_SESSION['login_id'] = $row['id'];

            //visszairányítás a főoldalra
            header("Location: ./");
            exit;
        } else {
            // Hibás belépési adatok
            $uzenet = "Hibás felhasználónév vagy jelszó!";
        }
    }
    catch (PDOException $e) {
        $uzenet = "Adatbázis hiba történt!";
    }
}
else {
    // Ha nem POST-tal érkezik
    header("Location: .");
    exit;
}
?>