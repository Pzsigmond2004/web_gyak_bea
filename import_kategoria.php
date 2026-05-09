<?php
try {
  $pdo = new PDO(
    "mysql:host=localhost;dbname=adatb4",
    "adatb4",
    "Cigi123",
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );

  $lines = file("kategoria.txt");
  unset($lines[0]);   // fejléc eldobása

  foreach ($lines as $line) {
    $adat = explode("\t", trim($line));
    $nev = $adat[0];
    $ar  = $adat[1];

    $sql = "INSERT INTO kategoria (nev, ar) VALUES ('$nev', $ar)";
    $pdo->exec($sql);
  }

  echo "✅ Kategoria adatok feltöltve";
}
catch (PDOException $e) {
  echo "Hiba: " . $e->getMessage();
}
?>