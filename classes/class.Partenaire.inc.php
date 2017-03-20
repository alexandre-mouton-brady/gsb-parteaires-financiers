<?php

  class Partenaire {
    private $id;
    private $nom;
    private $login;
    private $password;

    function __construct($pId, $pNom, $pLogin, $pPassword) {
      $this->$nom = $pNom;
      $this->$login = $pLogn;
      $this->$password = $pPassword;
    }
  }

?>