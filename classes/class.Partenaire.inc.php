<?php

class Partenaire
{
    private $id;
    private $nom;
    private $login;
    private $password;
    private $listeDonations;

    function __construct($pId, $pNom, $pLogin, $pPassword, $pListeDonations)
    {
        $this->id = $pId;
        $this->nom = $pNom;
        $this->login = $pLogin;
        $this->password = $pPassword;
        $this->listeDonations = $pListeDonations;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getListeDonations()
    {
        return $this->listeDonations;
    }
}
