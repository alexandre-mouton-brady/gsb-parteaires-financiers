<?php
  session_start();

  // On recupère la méthode avec laquelle est appellée la page "Connexion"
  $req = $_SERVER['REQUEST_METHOD'];

  if ($req === 'GET' && (!$_SESSION['log'] || !isset($_SESSION['log']))) {
    require('../views/templates/header.php');
    require('../views/pages/inscription.php');
    require('../views/templates/footer.php');

  } else if ($req === 'GET' && isset($_SESSION['log']) && $_SESSION['log']) {
    $_SESSION['warning'] = 'Vous êtes déjà connecté';
    header('Location:' . $_SESSION['home']);

  } else if ($req === 'POST') {
    require ('../classes/class.BDD.inc.php');

    $bdd = new BDD();
    $ids = $bdd->generateNewClient($_POST['compName'], $_POST['donation']);

    $_SESSION['success'] = $ids;

    header('Location: ' . $_SESSION['home'] . 'connexion');
  }
?>