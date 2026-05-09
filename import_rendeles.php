<?php
/*
    Rendelések importálása a rendeles.txt fájlból.
    A fájl első sora fejléc, azt nem dolgozzuk fel.
*/

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Adatbázis kapcsolat
    $pdo = new PDO(
        "mysql:host=localhost;dbname=adatb4;charset=utf8",
        "adatb4",
        "Cigi123",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );

    echo "Import indul...<br>";

    // Tranzakció indítása (optimalizálás)
    $pdo->beginTransaction();

    // Fájl beolvasása
    $sorok = file("rendeles.txt");

    // Fejléc sor eltávolítása
    unset($sorok[0]);

    // SQL előkészítése EGYSZER
    $sql = "INSERT INTO rendeles (pizzanev, darab, felvetel, kiszallitas)
            VALUES (:pizzanev, :darab, :felvetel, :kiszallitas)";
    $stmt = $pdo->prepare($sql);

    // Sorok feldolgozása
    foreach ($sorok as $sor) {
        $adat = explode("\t", trim($sor));

        if (count($adat) < 4) {
            continue;
        }

        $stmt->execute([
            ':pizzanev'    => $adat[0],
            ':darab'       => (int)$adat[1],
            ':felvetel'    => $adat[2],
            ':kiszallitas' => $adat[3]
        ]);
    }

    // Tranzakció lezárása
    $pdo->commit();

    echo "✅ Rendelések sikeresen importálva";
}
catch (PDOException $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "❌ Hiba történt: " . $e->getMessage();
}
?>