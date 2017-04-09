<?php
  require('../classes/class.BDD.inc.php');

  if(isset($_POST['inscription'])) {
    $name = $_POST['name'];
    $bdd = new BDD;

    $data = $bdd->generateNewClient($name);
    echo $data;
  }
?>