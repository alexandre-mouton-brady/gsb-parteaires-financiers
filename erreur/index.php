<?php
  session_start();

  $ip = $_SERVER['REMOTE_ADDR'];
  require('../views/templates/header.php');
  require('../views/pages/erreur.php');
  require('../views/templates/footer.php');
?>