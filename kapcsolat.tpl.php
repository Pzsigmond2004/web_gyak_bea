<div class="container my-5">
  <h2>Kapcsolat</h2>

  <form method="post" onsubmit="return validateForm();">
    <div class="mb-3">
      <label>Küldő neve</label>
      <input type="text" name="sender_name" class="form-control">
    </div>

    <div class="mb-3">
      <label>Tárgy</label>
      <input type="text" name="subject" class="form-control">
    </div>

    <div class="mb-3">
      <label>Üzenet</label>
      <textarea name="body" rows="4" class="form-control"></textarea>
    </div>

    <button type="submit" name="send" class="btn btn-primary">
      Küldés
    </button>
  </form>

  <?php if (isset($uzenet)) { ?>
    <div class="alert alert-info mt-3"><?= $uzenet ?></div>
  <?php } ?>
</div>

<script>
function validateForm() {
    let name = document.forms[0]["sender_name"].value.trim();
    let subject = document.forms[0]["subject"].value.trim();
    let body = document.forms[0]["body"].value.trim();

    if (name === "" || subject === "" || body === "") {
        alert("Minden mezőt ki kell tölteni!");
        return false;
    }
    return true;
}
</script>
