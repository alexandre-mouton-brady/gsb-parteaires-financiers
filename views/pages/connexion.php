<div class="form anim__form--enter">
  <header class="form__header">
    <h1 class="form__title">Connexion</h1>
    <img class="form__logo" src="<?php echo $_SESSION['home']; ?>assets/imgs/logo.png" alt="GSB logo">
  </header>
  <main class="form__body">
    <form action="" method="post">
      <div class="form__input">
        <input class="form__text" type="text" name="username" id="username" required>
        <label class="form__label" for="username">Nom d'utilisateur</label>
      </div>
      <div class="form__input">
        <input class="form__text" type="password" name="pass" id="pass" required>
        <label class="form__label" for="pass">Mot de passe</label>
      </div>

      <div class="form__input form__input--submit">
        <input type="submit" name="connexion" value="Connexion">
      </div>
    </form>
  </main>
  <footer class="form__footer">
    <p>Première visite ? <a href="<?php echo $_SESSION['home'] . 'inscription'; ?>">Inscrivez-vous.</a></p>
    <p><a href="#0">Mot de passe ou nom d'utilisateur oublié ?</a></p>
  </footer>
</div>

<script>
  var links = document.querySelectorAll('a');
  var form = document.querySelector('.form');

  // Function that animate the page transition
  var handleClick = function(e) {
    var el = e.target;

    if (!el.hasAttribute('target')) {
      e.preventDefault();
      form.classList.remove('anim__form--enter');
      form.classList.add('anim__form--leave');

      setTimeout(function() {
        window.location = el.href;
      }, 700);
    }
  };

  for (var i = 0; i < links.length; ++i)
    links[i].addEventListener('click', handleClick);
</script>