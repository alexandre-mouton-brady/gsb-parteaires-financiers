<header class="header">
  <a href="<?php $_SESSION['home'] ?>?logout=true">Déconnexion</a>
</header>

<section class="section">
  <h2 class="section__title">Projets</h2>
  <div class="projects">
    <?php foreach ($currentUser->getProjets() as $projet) : ?>
      <article class="projects__item">
        <img
          src="<?php echo $_SESSION['home'] . 'assets/imgs/' . $projet['couverture']; ?>"
          alt="<?php echo $projet['nomProjet']; ?>"
          class="projects__thumb">

        <h3 class="projects__title">
          <?php echo $projet['nomProjet'] ?>
        </h3>

        <p class="projects__description">
          <?php echo $projet['descriptionProjet']; ?>
        </p>

        <footer>
          <span>Fonds investis :
            <?php echo $projet['MontantAttribué']; ?>/
            <?php echo $projet['MontantTotal']; ?>
          </span>
        </footer>
      </article>
    <?php endforeach; ?>
  </div>
</section>