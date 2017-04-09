<?php
  session_start();
  require('../classes/index.php');
  Template::head('login page');
  Template::Header('Inscription');
  Template::inscriptionForm();
?>

  <script src="./inscription.js"></script>