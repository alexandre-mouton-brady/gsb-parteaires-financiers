<?php

  class Partenaire {
    private $id;
    private $nom;
    private $login;
    private $password;
    private $listProjets;

    function __construct($pId, $pNom, $pLogin, $pPassword, $pListProjets) {
      $this->id = $pId;
      $this->nom = $pNom;
      $this->login = $pLogin;
      $this->password = $pPassword;
      $this->listProjets = $pListProjets;
    }

    public function getNom() {
      return $this->nom;
    }

    public function getProjets() {
      return $this->listProjets;
    }
  }

?>