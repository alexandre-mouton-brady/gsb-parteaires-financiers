<?php
  session_start();

  // On recupère la méthode avec laquelle est appellée la page "Connexion"
  $req = $_SERVER['REQUEST_METHOD'];

  // Si on demande à afficher la page et que l'utilisateur
  // n'est pas déjà connecté, on affiche la page de connexion
  // avec un message d'erreur s'il a déjà essayé de se connecter
  if ($req === 'GET' && (!$_SESSION['log'] || !isset($_SESSION['log']))) {
    require('../views/templates/header.php');

    // Affichage du message d'erreur s'il existe
    if (isset($_SESSION['error'])) {
      echo '<div class="msg msg--error"> ' . $_SESSION['error'] . '</div>';
      unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
      echo '<div class="msg msg--success">';
      echo '<h3> <em>Vos identifients</em> : </h3>';
      echo '<p>' . $_SESSION['success']['login'] . '</p>';
      echo '<p>' . $_SESSION['success']['password'] . '</p>';
      echo '</div>';
      unset($_SESSION['success']);
    }

    require('../views/pages/connexion.php');
    require('../views/templates/footer.php');

  // Si on demande à afficher la page mais que l'utilisateur est déjà
  // connecté, on enregistre un message d'erreur indiquant qu'il est déjà
  // connecté et on le redirige vers la page d'accueil
  } else if ($req === 'GET' && isset($_SESSION['log']) && $_SESSION['log']) {

    // Enregistrement du message
    $_SESSION['warning'] = 'Vous êtes déjà connecté';
    // Redirection
    header('Location:' . $_SESSION['home']);

  // Si la requête est de type POST (donc l'envoie de données),
  // cela veut dire que l'utilisateur essai de se connecter.
  // On compare donc les logs données avec la base de données
  // et on agit en conséquence.
  } else if ($req === 'POST') {
    require ('../classes/class.BDD.inc.php');
    require ('../classes/class.Partenaire.inc.php');

    $bdd = new BDD();
    $isOk = $bdd->checkUser($_POST['username'], $_POST['pass']);

    // Si les logs correspondent, on enregistre la session
    if ($isOk["log"]) {
      $_SESSION['log'] = true;
      $_SESSION['currentUser'] = $isOk['result'];
      header('Location:' . $_SESSION['home']);

    // Autrement on enregistre un message comme quoi les logs ne
    // correpondent pas et on redirige vers la page par la méthode GET
    } else {
      $_SESSION['error'] = "Le nom d'utilisateur ou/et le mot de passe ne correspondent pas";
      header('Location: ' . $_SESSION['home'] . 'connexion');
    }
  }
?>