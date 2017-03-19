<?php
  session_start();
  include_once('./classes/index.php');
  Template::head('login page');
  Template::header('Connexion');
  $url = $_SERVER['REQUEST_URI'];
?>
    <main class="content-wrapper">
      <form action="" autocomplete="nope" method="post" class="form">
        <h1 class="form__title">Connexion partenaire</h1>
        <div class="input">
          <input type="text" class="input__field" name="login" id="login" required value="">
          <label for="login" class="input__label">Login</label>
          <div class="input__focus"></div>
        </div>
        <div class="input">
          <input type="password" class="input__field" name="motDePasse" id="motDePasse" required value="">
          <label for="motDePasse" class="input__label">Mot de passe</label>
          <div class="input__focus"></div>
        </div>
        <div class="group">
          <a href="<?php echo $url; ?>inscription" class="btn">
            <span class="btn__text">Inscription</span>
          </a>
          <button type="submit" name="connexion" class="btn btn--raised">
            <span class="btn__text">Connexion</span>
          </button>
        </div>
      </form>
    </main>

    <script src="./scripts/index.js"></script>
  </body>
</html>