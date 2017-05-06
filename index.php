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
    require ('./views/templates/header.php');

    if (isset($_SESSION['warning'])) {
      echo '<div class="msg msg--warning"> ' . $_SESSION['warning'] . '</div>';
      unset($_SESSION['warning']);
    }

    echo '<a href="' . $_SESSION['home'] . '?logout=true">Logout</a>';

    require ('./views/templates/footer.php');
  }
?>