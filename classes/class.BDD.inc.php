<?php

  class BDD {
    private $connection;
    private $servername;
    private $username;
    private $password;
    private $dbname;

    function __construct() {
      $this->servername = 'localhost';
      $this->username   = 'root';
      $this->password   = '@lexandrE6';
      $this->dbname     = 'partenaire';
    }

    /**
     * Ouvre la connexion à la base de données
     *
     * @return void
     */
    private function on() {
      try {
        $conn = new PDO(
          "mysql:host=$this->servername;
           dbname=$this->dbname",
           $this->username,
           $this->password
        );

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->connection = $conn;
      }

      catch (PDOException $e) {
        throw Error('La connexion à échouée : ' . $e->getMessage());
      }
    }

    /**
     * Ferme la connexion à la base de données
     *
     * @return void
     */
    private function off() {
      $this->connection = null;
    }

    /**
     * Vérifie si l'utilisateur qui essai de se connecter exsite et
     * si les identifiants entrés correspondent à ceux de la base de
     * données
     *
     * @param [String] $login - Login de l'utilisateur
     * @param [String] $password - Mot de passe de l'utilisateur
     * @return [Boolean] $userLogged - Vrai si les logs correspondent,
     *                                 faux sinon
     *///
    public function checkUser($login, $password) {
      $this->on();

      $stmt = $this->connection
                   ->prepare("SELECT *
                              FROM `partenaire`
                              WHERE motDePasse = :password
                              AND login = :login");

      $stmt->bindParam(":login", $login, PDO::PARAM_STR);
      $stmt->bindParam(":password", $password, PDO::PARAM_STR);

      $stmt->execute();

      $userLogged = $stmt->rowCount() > 0 ? True : False;

      $this->off();

      return $userLogged;
    }

    /**
     * Genère un nouveau client lors de l'inscription en lui
     * attribuant un login et un mot de passe. Elle initialize également
     * la première donation.
     *
     * @param [String] $nom - Nom de l'organisation qui s'inscrit
     * @param [Float] $donation - Montant de la première donation
     * @return [Array] $data - Tableau contenant les identifiants générés
     */
    // @TODO: Vérifier que le client n'existe pas déjà
    public function generateNewClient($nom, $donation) {
      $password = $this->generatePassword();
      $login = $this->generateLogin($nom);
      $montant = $donation;
      $projects = $this->retrieveProjects();

      $this->on();

      /*---------------------------*/

      $req = "INSERT INTO partenaire (nom, login, motDePasse) VALUES (:nom, :login, :motDePasse)";

      $stmt = $this->connection->prepare($req);

      $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
      $stmt->bindParam(":login", $login, PDO::PARAM_STR);
      $stmt->bindParam(":motDePasse", $password, PDO::PARAM_STR);

      $stmt->execute();

      /*---------------------------*/

      $lastId = $this->connection->lastInsertId();

      $req = "INSERT INTO donation (montant, idPartenaire) VALUES (:donation, :idPartenaire)";

      $stmt = $this->connection->prepare($req);
      $stmt->bindParam(":donation", $donation, PDO::PARAM_STR);
      $stmt->bindParam(":idPartenaire", $lastId, PDO::PARAM_INT);

      $stmt->execute();

      /*---------------------------*/

      $idDonation = $this->connection->lastInsertId();

      $reqAffectation = "INSERT INTO affectation (idDonation, idProjet, montant) VALUES (:idDonation, :idProjet, :montant)";
      $affectation = $this->connection->prepare($reqAffectation);

      $affectation->bindParam(":idDonation", $idDonation, PDO::PARAM_INT);
      $affectation->bindParam(":idProjet", $idProjet, PDO::PARAM_INT);

      /* --- */

      $reqProjet = "UPDATE projet SET montantActuel = :nouveauMontant WHERE idProjet = :idProjet";
      $projet = $this->connection->prepare($reqProjet);

      $projet->bindParam(":nouveauMontant", $nouveauMontant, PDO::PARAM_INT);
      $projet->bindParam(":idProjet", $idProjet, PDO::PARAM_INT);

      /* --- */

      foreach ($projects as $project) {
        $montantActuel = $project['montantActuel'];
        $idProjet = $project['id'];

        if ($montant <= 0)
          break;
        if ($montantActuel == 0)
          continue;

        if ($montantActuel - $montant >= 0) {

          $affectation->bindParam(":montant", $montant, PDO::PARAM_INT);

          $affectation->execute();

          /* --- */

          $montant = $montant - $project['montantActuel'];
          $nouveauMontant = $montant * -1;

          $projet->execute();

        } else if ($montantActuel - $montant < 0) {
          $montant -= $montantActuel;
          $nouveauMontant = 0;

          $affectation->bindParam(":montant", $montantActuel, PDO::PARAM_INT);

          $affectation->execute();

          /* --- */

          $projet->execute();
        }
      }

      $this->off();

      $data = array(
        "login" => $login,
        "password" => $password
      );

      return $data;
    }

    /**
     * Renvoie tous les projets classés par ordre d'importance
     *
     * @return [Array] @arr - Tableau de projets
     *///
    public function retrieveProjects() {
      $this->on();

        $req = "SELECT * FROM projet ORDER BY importance DESC";
        $arr = array();

        foreach ($this->connection->query($req) as $row) {
          $tempArr = array(
            "id" => $row['idProjet'],
            "nom" => $row['nomProjet'],
            "description" => $row['descriptionProjet'],
            "montantAPayer" => $row['montantAPayer'],
            "montantActuel" => $row['montantActuel'],
            "importance" => $row['importance']
          );

          array_push($arr, $tempArr);
        }

      $this->off();

      return $arr;
    }

    /**
     * Genère un login unique basé sur le nom donné en paramètre
     *
     * @param [String] $nom - Nom de l'entreprise entré lors de l'inscription
     * @return [String] $login - Login généré
     *///
    private function generateLogin($nom) {
      $login = str_split($nom);
      $login[0] = strtoupper($login[0]);
      $tempLogin = "";
      $max = count($login) > 6 ? 6 : count($login);

      // S'assure qu'il n'y ai pas plus de 6 charactères
      for($i = 0; $i < $max; ++$i) {
        $tempLogin .= $login[$i];
      }

      $login = $tempLogin;
      $login .= rand(1, 999);

      // S'assure que le login est unique
      $login = $this->userExist($login) ? $this->generateLogin($nom) : $login;

      return $login;
    }

    /**
     * Générer un mot de passe unique
     *
     * @return [String] $password - Mot de passe généré
     *///
    private function generatePassword() {
      // Tableau 1: Alphabet [a-z]
      // Tableau 2: Nombres [0-9]
      // Tableau 3: Charactères spéciaux
      $char = [
        ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'],

        ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'],

        ['#', '@', '&', '$', '£', '%', '!']
      ];

      // Stock le nombre d'éléments dans chaque tableau
      $alphaCount = count($char[0]);
      $numCount = count($char[1]);
      $speCount = count($char[2]);

      $password = "";

      // S'assure qu'il y ai au moins :
      // * une majuscule
      // * un nombre
      // * une charactère spécial
      $password .= strtoupper($char[0][rand(0, $alphaCount - 1)]);
      $password .= $char[1][rand(0, $numCount - 1)];
      $password .= $char[2][rand(0, $speCount - 1)];

      // Boucle pour former le mot de passe
      for ($i = 0; $i < 7; ++$i) {
        $randList = rand(0, 10);

        if ($randList <= 5)
          $randList = 0;
        else if ($randList > 5 && $randList <= 8)
          $randList = 1;
        else
          $randList = 2;

        $randNumb = rand(0, count($char[$randList]) - 1);

        $password .= $char[$randList][$randNumb];
      }

      return $password;
    }

    /**
     * Vérifie que l'utilisateur entré n'exsite pas déjà
     * ce qui permet d'avoir des logins uniques
     *
     * @param [String] $unLogin - Login à testé
     * @return [Boolean] $exist - Boolean qui indique s'il existe ou non
     *///
    private function userExist($unLogin) {
        // Boolean qui va être renvoyé
        $exist = true;

        $this->on();

        // Récupération de tous les partenaires correspondants au login
        $req = "SELECT * FROM partenaire WHERE login = :login";
        $stmt = $this->connection->prepare($req);
        $stmt->bindParam(":login", $unLogin, PDO::PARAM_STR);
        $stmt->execute();

        // S'il n'y a aucune ligne, le login n'existe pas
        if ($stmt->rowCount() == 0)
          $exist = false;

        $this->off();

        return $exist;
      }
  }

?>