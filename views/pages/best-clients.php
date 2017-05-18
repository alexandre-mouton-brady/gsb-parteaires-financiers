<header class="header">
  <a href="<?php echo $_SESSION['home'] ?>">Accueil</a>
  <span><?php echo $currentUser->getNom(); ?></span>
  <a href="<?php echo $_SESSION['home'] ?>?logout=true">Déconnexion</a>
</header>

<section class="section">
  <div class="card">

    <h2 class="section__title table__title">Classement des collaborateurs privilégiés</h2>

    <table class="table">
      <thead class="table__header">
        <tr class="table__row">
          <td class="string-col">Rang</td>
          <td class="string-col">Nom de l'origanisation</td>
          <td class="string-col">Montant total versé</td>
        </tr>
      </thead>
      <tbody class="table__body">
        <?php foreach ($bestClients as $i => $bestClient) : ?>
          <tr class="table__row">
            <td class="string-col">#<?php echo $i + 1; ?></td>
            <td class="string-col"><?php echo $bestClient['nom']; ?></td>
            <td class="numeric-col"><?php echo $bestClient['montant']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  </div>


</section>
