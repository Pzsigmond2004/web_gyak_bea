<?php
session_start();
if (file_exists('./logicals/'.$keres['fajl'].'.php')) {
    include("./logicals/{$keres['fajl']}.php");
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <title>
        <?= $ablakcim['cim'] .
        (isset($ablakcim['mottó']) ? (' | ' . $ablakcim['mottó']) : '') ?>
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Saját stílus -->
    <link rel="stylesheet" href="./styles/stilus.css">
</head>

<body>
<header class="container my-3">
    <h1><?= $fejlec['cim'] ?></h1>

    <?php if (isset($_SESSION['login'])) { ?>
        <p>
            Bejelentkezett:
            <strong>
                <?= $_SESSION['csn'] . " " . $_SESSION['un'] .
                " (" . $_SESSION['login'] . ")" ?>
            </strong>
        </p>
    <?php } ?>
</header>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">

    <!-- BAL OLDALI MENÜ -->
    <ul class="navbar-nav me-auto">

      <?php foreach ($oldalak as $url => $oldal) { ?>

        <?php
        // Kilépés NE legyen bal oldalon
        if ($oldal['szoveg'] == "Kilépés") continue;

        // Belépés NE legyen bal oldalon
        if ($oldal['szoveg'] == "Bejelentkezés") continue;

        // Nincs bejelentkezve
        if (!isset($_SESSION['login']) && $oldal['menun'][0] == 1) {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?<?= $url ?>">
              <?= $oldal['szoveg'] ?>
            </a>
          </li>
        <?php }

        // Be van jelentkezve
        if (isset($_SESSION['login']) && $oldal['menun'][1] == 1) {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?<?= $url ?>">
              <?= $oldal['szoveg'] ?>
            </a>
          </li>
        <?php } ?>

      <?php } ?>

    </ul>

    <!-- JOBB OLDALI MENÜ -->
    <ul class="navbar-nav ms-auto">

      <?php foreach ($oldalak as $url => $oldal) { ?>

        <?php
        // BELÉPÉS (csak ha nincs login)
        if ($oldal['szoveg'] == "Bejelentkezés" && !isset($_SESSION['login'])) {
        ?>
          <li class="nav-item">
            <a class="nav-link text-white fw-bold" href="index.php?<?= $url ?>">
              Belépés
            </a>
          </li>
        <?php }

        // KILÉPÉS (csak ha van login)
        if ($oldal['szoveg'] == "Kilépés" && isset($_SESSION['login'])) {
        ?>
          <li class="nav-item">
            <a class="nav-link text-white fw-bold" href="index.php?<?= $url ?>">
              Kilépés
            </a>
          </li>
        <?php } ?>

      <?php } ?>

    </ul>

  </div>
</nav>

<main class="container my-4">
    <?php include("./templates/pages/{$keres['fajl']}.tpl.php"); ?>
</main>

<footer class="bg-dark text-light text-center p-3">
    &copy; <?= $lablec['copyright'] ?>
    <?= $lablec['ceg'] ?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>