<?php
  session_start();
  include_once('./classes/index.php');
  Template::head('login page');

  if (!isset($_SESSION['estConnecte']))
    $_SESSION['estConnecte'] = False;

  Template::header('Connexion');

  $url = $_SERVER['REQUEST_URI'];

  $bdd = new BDD;

  if (!isset($_SESSION['estConnecte'])) {
    $_SESSION['estConnecte'] = False;
  }

  if (isset($_POST['connexion'])) {
    $login = $_POST['login'];
    $password= $_POST['motDePasse'];

    if ($bdd->checkUser($login, $password)) {
      $_SESSION['estConnecte'] = True;
      header("Refresh:0");
      exit;
    } else {
      echo 'erreur de connexion';
    }
  }
?>


    <main class="content-wrapper">
      <div id="txtHint"></div>
      <?php
        if (!$_SESSION['estConnecte'])
          Template::loginForm();
      ?>
    </main>

    <h1><?php echo $bdd->generateNewClient('microsoft'); ?></h1>



<?php
if ($_SESSION['estConnecte'])
  echo '<script src="./script/index.js"></script>';
?>

<?php
  Template::footer();
?>