<header class="header">
  <a href="<?php echo $_SESSION['home'] . 'top-utilisateur' ?>">Top utilisateurs</a>
  <span><?php echo $currentUser->getNom(); ?></span>
  <a href="<?php echo $_SESSION['home'] ?>?logout=true">Déconnexion</a>
</header>

<section class="section">
    <?php foreach ($currentUser->getListeDonations() as $i => $donation) : ?>

    <h2 class="section__title">Donation n° <?php echo $i + 1 . ': ' . $donation['montantDonation']; ?>€</h2>

    <div class="projects">
        <?php foreach ($donation['projectData'] as $projet) : ?>

          <article class="projects__item">
            <img
              src="<?php echo $_SESSION['home'] . 'assets/imgs/' . $projet['couverture']; ?>"
              alt="<?php echo $projet['nomProjet']; ?>"
              class="projects__thumb"
            />

            <header class="projects__title">
              <h1><?php echo $projet['nomProjet']; ?></h1>
              <h2>Fonds investis : <?php echo $projet['MontantAttribue'] . '/' . $projet['montantAPayer']; ?></h2>
              <div class="progress__container">
                <div
                  class="progress"
                  data-full="<?php echo $projet['montantAPayer']; ?>"
                >
                  <div
                    class="progress__completed"
                    data-completed="<?php echo $projet['montantActuel']; ?>"
                  ></div>
                  <div
                    class="progress__participated"
                    data-participated="<?php echo $projet['MontantAttribue']; ?>"
                  ></div>
                </div>
                <div class="progress__help-container">

                  <span class="progress__help">?</span>

                  <ul class="progress__modal">
                    <li><span class="progress__hint progress__hint--green"></span>: Montant déjà payé</li>
                    <li><span class="progress__hint progress__hint--yellow"></span>: Montant investis</li>
                    <li><span class="progress__hint progress__hint--white"></span>: Montant restant</li>
                  </ul>

                </div>
              </div>
            </header>

            <section class="projects__description">
              <p><?php echo $projet['descriptionProjet']; ?></p>
            </section>

            <footer class="projects__footer">
              <a href="#0" class="projects__cta">Voir projet</a>
            </footer>
          </article>

        <?php endforeach; ?>
    </div>

    <?php endforeach; ?>
</section>

<script>
(function () {
  const progressCompleted = document.querySelectorAll('.progress__completed');

  progressCompleted.forEach((el) => {
    const parent = el.parentNode,
          sibling = el.nextElementSibling,

          dataParent = parent.dataset.full,
          data = dataParent -  el.dataset.completed,
          dataSibling = sibling.dataset.participated,

          percentageCompleted = ((data - dataSibling) / dataParent),
          percentageParticipated = (dataSibling / dataParent);

    el.style.transform = `scaleX(${percentageCompleted})`;
    sibling.style.transform = `scaleX(${percentageParticipated})`;
    sibling.style.left = `${percentageCompleted * 100}%`;
  });
})();
</script>
