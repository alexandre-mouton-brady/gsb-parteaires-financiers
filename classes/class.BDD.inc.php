<?php

  class BDD {
    private $connection;

    function __construct() {
      $servername = 'localhost';
      $username = 'root';
      $password = '@lexandrE6';
      $dbname = 'gsbpartenaires';

      try {
        $conn = new PDO(
          'mysql:host=$servername;
           dbname=$dbname',
           $username,
           $password
        );

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->connection = $conn;
      }

      catch (PDOException $e) {
        $this->connection = 'La connexion à échouée : ' . $e->getMessage();
      }
    }

    // Fonction permettant de générer un nouvel utilisateur
    // @TODO: Vérifier que le client n'existe pas déjà
    public function generateNewClient($nom) {
      $password = $this->generatePassword();
      $login = $this->generateLogin($nom);

      $stmt = $this->connection
                   ->prepare("INSERT INTO partenaire(login, password, nom)
                              VALUES (:login, :password, :nom)");

      $stmt->bindParam(':login', $login, PDO::PARAM_INT);
      $stmt->bindParam(':password', $password, PDO::PARAM_STR);
      $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);

      $stmt->execute();
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