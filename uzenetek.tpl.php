<?php
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

try {
    $dbh = new PDO(
        'mysql:host=localhost;dbname=adatb4',
        'adatb4',
        'Cigi123',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

    $sql = "
        SELECT sender_name, body, created_at, user_id
        FROM messages
        ORDER BY created_at DESC
    ";

    $sth = $dbh->prepare($sql);
    $sth->execute();
    $uzenetek = $sth->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Adatbázis hiba!");
}
?>

<div class="container my-5">
  <h2>Üzenetek</h2>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Üzenetküldő</th>
        <th>Üzenet</th>
        <th>Küldés ideje</th>
      </tr>
    </thead>
    <tbody>

    <?php foreach ($uzenetek as $uzenet) { ?>
      <tr>
        <td>
          <?php
          // ✅ FELADAT SZERINTI LOGIKA
          if ($uzenet['user_id'] === null) {
              echo "Vendég";
          } else {
              echo htmlspecialchars($uzenet['sender_name']);
          }
          ?>
        </td>
        <td><?= nl2br(htmlspecialchars($uzenet['body'])) ?></td>
        <td><?= $uzenet['created_at'] ?></td>
      </tr>
    <?php } ?>

    </tbody>
  </table>
</div>