<?php
try {
  $pdo = new PDO(
    "mysql:host=localhost;dbname=adatb4",
    "adatb4",
    "Cigi123",
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );

  $lines = file("pizza.txt");
  unset($lines[0]);

  foreach ($lines as $line) {
    $adat = explode("\t", trim($line));
    $nev = $adat[0];
    $kategoria = $adat[1];
    $vegetarianus = $adat[2];

    $sql = "INSERT INTO pizza (nev, kategorianev, vegetarianus)
            VALUES ('$nev', '$kategoria', $vegetarianus)";
    $pdo->exec($sql);
  }

  echo "✅ Pizza adatok feltöltve";
}
catch (PDOException $e) {
  echo "Hiba: " . $e->getMessage();
}
?>
