<?php
  session_start();

  $currUrl = $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
  $_SESSION['home'] = parse_url($currUrl, PHP_URL_SCHEME) . '://' . parse_url($currUrl, PHP_URL_HOST) . parse_url($currUrl, PHP_URL_PATH);

  if (isset($_GET['logout'])) {
    $_SESSION['log'] = false;
    header('Location: ' . $_SESSION['home'] . 'connexion');
  }

  if (!isset($_SESSION['log']) || !$_SESSION['log']) {
    header('Location: ' . $_SESSION['home'] . 'connexion');

  } else {
    require ('./classes/class.BDD.inc.php');
    require ('./classes/class.Partenaire.inc.php');
    require ('./views/templates/header.php');

    $db = new BDD();

    $id = $_SESSION['currentUser']['idPartenaire'];
    $nom = $_SESSION['currentUser']['nom'];
    $login= $_SESSION['currentUser']['login'];
    $password = $_SESSION['currentUser']['motDePasse'];
    $projects = $db->getProjectsForUser($id);

    $currentUser = new Partenaire($id, $nom, $login, $password, $projects);

    require ('./views/pages/home.php');

    if (isset($_SESSION['warning'])) {
      echo '<div class="msg msg--warning"> ' . $_SESSION['warning'] . '</div>';
      unset($_SESSION['warning']);
    }
    require ('./views/templates/footer.php');
  }
?>