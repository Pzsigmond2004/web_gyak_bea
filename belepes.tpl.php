<div class="container my-5">
  <div class="row">

    <!-- ===== BEJELENTKEZÉS ===== -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-body p-4">

          <h4 class="card-title text-center mb-4">Bejelentkezés</h4>

          <form action="belep" method="post">
            <div class="mb-3">
              <label class="form-label">Felhasználónév</label>
              <input
                type="text"
                name="felhasznalo"
                class="form-control"
                placeholder="felhasználó"
                required>
            </div>

            <div class="mb-3">
              <label class="form-label">Jelszó</label>
              <input
                type="password"
                name="jelszo"
                class="form-control"
                placeholder="jelszó"
                required>
            </div>

            <button
              type="submit"
              name="belepes"
              class="btn btn-primary w-100">
              Belépés
            </button>
          </form>

        </div>
      </div>
    </div>

    <!-- ===== REGISZTRÁCIÓ ===== -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-body p-4">

          <h4 class="card-title text-center mb-4">
            Regisztrálja magát, ha még nem felhasználó!
          </h4>

          <form action="regisztral" method="post">
            <div class="mb-3">
              <label class="form-label">Vezetéknév</label>
              <input
                type="text"
                name="vezeteknev"
                class="form-control"
                placeholder="vezetéknév"
                required>
            </div>

            <div class="mb-3">
              <label class="form-label">Utónév</label>
              <input
                type="text"
                name="utonev"
                class="form-control"
                placeholder="utónév"
                required>
            </div>

            <div class="mb-3">
              <label class="form-label">Felhasználónév</label>
              <input
                type="text"
                name="felhasznalo"
                class="form-control"
                placeholder="felhasználói név"
                required>
            </div>

            <div class="mb-3">
              <label class="form-label">Jelszó</label>
              <input
                type="password"
                name="jelszo"
                class="form-control"
                placeholder="jelszó"
                required>
            </div>

            <button
              type="submit"
              name="regisztracio"
              class="btn btn-success w-100">
              Regisztráció
            </button>
          </form>

        </div>
      </div>
    </div>

  </div>
</div>
