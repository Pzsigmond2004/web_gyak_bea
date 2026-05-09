<?php
$dir = 'images/';

if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

// ===== FELTÖLTÉS KEZELÉSE =====
if (isset($_SESSION['login']) && isset($_POST['feltoltes'])) {
    if (isset($_FILES['kep']) && $_FILES['kep']['error'] === UPLOAD_ERR_OK) {

        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($_FILES['kep']['name'], PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $ujnev = time() . '_' . basename($_FILES['kep']['name']);
            move_uploaded_file($_FILES['kep']['tmp_name'], $dir . $ujnev);
            header("Location: index.php?kepek");
            exit;
        }
    }
}
?>

<div class="container my-5">

  <h2 class="text-center mb-4">Képgaléria</h2>

  <div class="row">
    <?php
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            ?>
            <div class="col-sm-6 col-md-4 mb-4">
              <div class="card shadow-sm">
                <img src="<?= $dir . $file ?>"
                     class="card-img-top img-fluid"
                     alt="Galéria kép">
              </div>
            </div>
            <?php
        }
    }
    ?>
  </div>

  <?php if (isset($_SESSION['login'])) { ?>
    <hr>

    <h4>Új kép feltöltése</h4>

    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <input type="file"
               name="kep"
               class="form-control"
               accept="image/*"
               required>
      </div>

      <button type="submit"
              name="feltoltes"
              class="btn btn-primary">
        Feltöltés
      </button>
    </form>

  <?php } else { ?>

    <div class="alert alert-warning mt-4">
      Kép feltöltéséhez be kell jelentkezni.
    </div>

  <?php } ?>

</div>