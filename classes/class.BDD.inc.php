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

    private function off() {
      $this->connection = null;
    }

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

    // Fonction permettant de générer un nouvel utilisateur
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
      $stmt->bindParam(":donation", $donation, PDO::PARAM_INT);
      $stmt->bindParam(":idPartenaire", $lastId, PDO::PARAM_INT);

      $stmt->execute();

      /*---------------------------*/

      $lastId = $this->connection->lastInsertId();

      foreach ($projects as $project) {
        if ($montant <= 0)
          break;
        if ($project['montantActuel'] === 0)
          continue;

        if ($project['montantActuel'] - $montant >= 0) {
          $req = "INSERT INTO affectation (idDonation, idProjet) VALUES (:idDonation, :idProjet)";
          $stmt = $this->connection->prepare($req);

          $stmt->bindParam(":idDonation", $lastId, PDO::PARAM_INT);
          $stmt->bindParam(":idProjet", $project['id'], PDO::PARAM_INT);

          $stmt->execute();

          /* --- */

          $montant = $montant - $project['montantActuel'];
          $nouveauMontant = $montant * -1;

          $req = "UPDATE projet SET montantActuel = :nouveauMontant WHERE idProjet = :idProjet";
          $stmt = $this->connection->prepare($req);

          $stmt->bindParam(":nouveauMontant", $nouveauMontant, PDO::PARAM_INT);
          $stmt->bindParam(":idProjet", $project['id'], PDO::PARAM_INT);

          $stmt->execute();
        }
      }

      $this-off();
    }

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

    // Fonction qui permet de générer un login unique
    // basé sur le nom de l'entreprise
    // @TODO: Vérifier que le login n'existe pas déjà
    private function generateLogin($nom) {
      $login = str_split($nom);
      $login[0] = strtoupper($login[0]);
      $tempLogin = "";
      $max = count($login) > 6 ? 6 : count($login);

      for($i = 0; $i < $max; ++$i) {
        $tempLogin .= $login[$i];
      }

      $login = $tempLogin;
      $login .= rand(1, 999);

      return $login;
    }

    // Fonction qui permet de générer un mot de passe unique
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
  }

?>