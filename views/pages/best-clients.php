<header class="header">
  <a href="<?php echo $_SESSION['home'] ?>?logout=true">Déconnexion</a>
</header>

<section class="section">

    <table>
      <thead>
        <tr>
          <td>Rang</td>
          <td>Nom de l'origanisation</td>
          <td>Montant total versé</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($bestClients as $i => $bestClient) : ?>
          <tr>
            <td>#<?php echo $i + 1; ?></td>
            <td><?php echo $bestClient['nom']; ?></td>
            <td><?php echo $bestClient['montant']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

</section>
