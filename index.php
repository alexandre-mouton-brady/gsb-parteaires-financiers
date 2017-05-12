<?php
  session_start();

  // On recupère la méthode avec laquelle est appellée la page "Connexion"
  $req = $_SERVER['REQUEST_METHOD'];

  $currUrl = $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
  $_SESSION['home'] = parse_url($currUrl, PHP_URL_SCHEME) . '://' . parse_url($currUrl, PHP_URL_HOST) . parse_url($currUrl, PHP_URL_PATH);

if (isset($_GET['logout'])) {
    $_SESSION['log'] = false;
    header('Location: ' . $_SESSION['home'] . 'connexion');
}

if ($req == 'POST') {
    if (isset($_POST['validerDon'])) {
        require ('./classes/class.BDD.inc.php');
        $db = new BDD();

        $res = $db->makeNewDonation($_SESSION['currentUser']['idPartenaire'],
        $_POST['montantDon']);

        if (!$res) {
            $_SESSION['error'] = 'La donation n\'a pas pu être enregistrée';
        } else {
            $_SESSION['success'] = 'La donation a correctement été enregistrée';
        }

        header('Location: ' . $_SESSION['home']);
    }
}

if ($req == 'GET') {
    if (!isset($_SESSION['log']) || !$_SESSION['log']) {
        header('Location: ' . $_SESSION['home'] . 'connexion');
    } else {
        require ('./classes/class.BDD.inc.php');
        require ('./classes/class.Partenaire.inc.php');
        require ('./views/templates/header.php');

        $db = new BDD();

        $id = $_SESSION['currentUser']['idPartenaire'];
        $nom = $_SESSION['currentUser']['nom'];
        $login= $_SESSION['currentUser']['login'];
        $password = $_SESSION['currentUser']['motDePasse'];
        $donations = $db->getProjectsForUser($id);

        $currentUser = new Partenaire($id, $nom, $login, $password, $donations);

        require ('./views/pages/home.php');

        if (isset($_SESSION['warning']) || isset($_SESSION['error'])) {
            echo '<div class="msg msg--warning"> ' . $_SESSION['warning'] . '</div>';
            unset($_SESSION['warning']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="msg msg--error"> ' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo '<div class="msg msg--success"> ' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        require ('./views/components/donation-form.php');
        // require ('./views/components/overlay.php');
        require ('./views/templates/footer.php');
    }
}
