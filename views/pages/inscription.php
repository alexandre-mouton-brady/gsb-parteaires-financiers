<div class="form anim__form--enter">
  <header class="form__header">
    <h1 class="form__title">Inscription</h1>
    <img class="form__logo" src="../assets/imgs/logo.png" alt="GSB logo">
  </header>
  <main class="form__body">
    <form action="" method="post">
      <div class="form__input">
        <input class="form__text" type="text" name="compName" id="compName" required>
        <label class="form__label" for="compName">Nom de votre organisation</label>
      </div>
      <div class="form__input">
        <input class="form__text" type="text" name="donation" id="donation" required>
        <label class="form__label" for="donation">Montant de la donation</label>
      </div>

      <div class="form__input form__input--submit">
        <input type="submit" name="inscription" value="Inscription">
      </div>
    </form>
  </main>
  <footer class="form__footer">
    <p>Déjà membre ? <a href="<?php echo $_SESSION['home'] . 'connexion'; ?>">Connectez-vous.</a></p>
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