<?php
require_once 'logicals/db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$action = $_GET['action'] ?? 'list';
$nev    = $_GET['nev'] ?? null;

/* ================= CREATE ================= */
if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $dbh->prepare(
        "INSERT INTO pizza (nev, kategorianev, vegetarianus)
         VALUES (?, ?, ?)"
    );
    $stmt->execute([
        $_POST['nev'],
        $_POST['kategorianev'],
        isset($_POST['vegetarianus']) ? 1 : 0
    ]);

    header("Location: index.php?crud");
    exit;
}

/* ================= UPDATE ================= */
if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST' && $nev) {

    $stmt = $dbh->prepare(
        "UPDATE pizza
         SET kategorianev = ?, vegetarianus = ?
         WHERE nev = ?"
    );
    $stmt->execute([
        $_POST['kategorianev'],
        isset($_POST['vegetarianus']) ? 1 : 0,
        $nev
    ]);

    header("Location: index.php?crud");
    exit;
}

/* ================= DELETE ================= */
if ($action === 'delete' && $nev) {

    $stmt = $dbh->prepare("DELETE FROM pizza WHERE nev = ?");
    $stmt->execute([$nev]);

    header("Location: index.php?crud");
    exit;
}
?>

<div class="container mt-4">

<?php if ($action === 'list'): ?>

    <h2>Pizza lista</h2>

    <a href="index.php?crud&action=create" class="btn btn-success mb-3">
        Add new
    </a>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Név</th>
            <th>Kategória</th>
            <th>Vegetáriánus</th>
            <th>Műveletek</th>
        </tr>

        <?php foreach ($dbh->query("SELECT * FROM pizza") as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['nev']) ?></td>
            <td><?= htmlspecialchars($row['kategorianev']) ?></td>
            <td><?= $row['vegetarianus'] ? 'Igen' : 'Nem' ?></td>
            <td>

                <a href="index.php?crud=1&action=edit&nev=<?= urlencode($row['nev']) ?>"
                   class="btn btn-primary btn-sm">
                    Edit
                </a>

                <a href="index.php?crud=1&action=delete&nev=<?= urlencode($row['nev']) ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Biztos törlöd?');">
                    Delete
                </a>

            </td>
        </tr>
        <?php endforeach; ?>

    </table>

<?php elseif ($action === 'create'): ?>

    <h2>Új pizza</h2>

    <form method="post" action="index.php?crud=1&action=store">

        <input name="nev" class="form-control mb-2" placeholder="Pizza neve" required>

        <input name="kategorianev" class="form-control mb-2" placeholder="Kategória">

        <label>
            <input type="checkbox" name="vegetarianus" value="1">
            Vegetáriánus
        </label><br><br>

        <button class="btn btn-success">Mentés</button>
        <a href="index.php?crud" class="btn btn-secondary">Mégse</a>

    </form>

<?php elseif ($action === 'edit' && $nev): ?>

    <?php
    $stmt = $dbh->prepare("SELECT * FROM pizza WHERE nev = ?");
    $stmt->execute([$nev]);
    $pizza = $stmt->fetch();
    ?>

    <?php if (!$pizza): ?>
        <div class="alert alert-danger">Pizza nem található</div>
    <?php else: ?>

    <h2>Pizza szerkesztése</h2>

    <form method="post"
          action="index.php?crud=1&action=update&nev=<?= urlencode($pizza['nev']) ?>">

        <input value="<?= htmlspecialchars($pizza['nev']) ?>"
               class="form-control mb-2" disabled>

        <input name="kategorianev"
               value="<?= htmlspecialchars($pizza['kategorianev']) ?>"
               class="form-control mb-2">

        <label>
            <input type="checkbox"
                   name="vegetarianus"
                   value="1"
                   <?= $pizza['vegetarianus'] ? 'checked' : '' ?>>
            Vegetáriánus
        </label><br><br>

        <button class="btn btn-success">Mentés</button>
        <a href="index.php?crud" class="btn btn-secondary">Mégse</a>

    </form>

    <?php endif; ?>

<?php endif; ?>

</div>
