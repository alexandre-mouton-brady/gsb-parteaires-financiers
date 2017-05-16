<main class="form__body form--fixed formDonation">
  <form action="<?php echo $_SESSION['home']; ?>" method="post">
    <div class="form__input">
      <input class="form__text" type="text" name="montantDon" id="montantDon" required>
      <label class="form__label" for="montantDon">Montant du don</label>
    </div>

    <div class="form__input form__input--submit">
      <input type="submit" name="validerDon" value="Valider">
    </div>
  </form>
</main>
<button class="new-donation">+</button>

<script>
  const $ = (aClass) => document.querySelector(aClass);

  const overlay = $('.overlay'),
        donationBtn = $('.new-donation'),
        donationForm = $('.formDonation'),
        section = $('.section');

  donationBtn.addEventListener('click', function(e) {
    overlay.classList.toggle('overlay--show');
    donationForm.classList.toggle('formDonation--show');
    section.classList.toggle('blur');
    donationBtn.classList.toggle('new-donation--rotate');
  });

  overlay.addEventListener('click', function(e) {
    overlay.classList.remove('overlay--show');
    donationForm.classList.remove('formDonation--show');
    section.classList.remove('blur');
    donationBtn.classList.remove('new-donation--rotate');
  });
</script>
