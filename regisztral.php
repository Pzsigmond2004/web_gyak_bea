<?php
if (
    isset($_POST['felhasznalo']) &&
    isset($_POST['jelszo']) &&
    isset($_POST['vezeteknev']) &&
    isset($_POST['utonev'])
) {
    try {
        // Kapcsolódás
        $dbh = new PDO(
            'mysql:host=localhost;dbname=adatb4',
            'adatb4',
            'Cigi123',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        // Létezik már a felhasználói név
        $sqlSelect = "SELECT id FROM felhasznalok WHERE bejelentkezes = :bejelentkezes";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(
            ':bejelentkezes' => $_POST['felhasznalo']
        ));

        if ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            //Már lévő felhasználó
            $uzenet = "A felhasználói név már foglalt!";
            $ujra   = true;
        } else {
            //Regisztráció
            $sqlInsert = "
                INSERT INTO felhasznalok
                (id, csaladi_nev, uto_nev, bejelentkezes, jelszo)
                VALUES
                (0, :csaladinev, :utonev, :bejelentkezes, :jelszo)
            ";

            $stmt = $dbh->prepare($sqlInsert);
            $stmt->execute(array(
                ':csaladinev'   => $_POST['vezeteknev'],
                ':utonev'       => $_POST['utonev'],
                ':bejelentkezes'=> $_POST['felhasznalo'],
                ':jelszo'       => sha1($_POST['jelszo'])
            ));

            if ($stmt->rowCount()) {
                $uzenet = "A regisztráció sikeres. Kérjük, jelentkezzen be!";
                $ujra   = false;
            } else {
                $uzenet = "A regisztráció nem sikerült.";
                $ujra   = true;
            }
        }
    }
    catch (PDOException $e) {
        $uzenet = "Adatbázis hiba történt!";
        $ujra   = true;
    }
} else {
    // Ha nem megfelelő módon érkezik
    header("Location: .");
    exit;
}
?>
