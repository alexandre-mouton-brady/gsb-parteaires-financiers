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

  if (isset($_REQUEST['deco'])) {
    echo 'DECO';
  }

  if (isset($_POST['connexion'])) {
    $login = $_POST['login'];
    $password= $_POST['motDePasse'];

    if ($bdd->checkUser($login, $password)) {
      $_SESSION['estConnecte'] = True;
      echo 'vous êtes connecté';
    } else {
      echo 'erreur de connexion';
    }
  }
?>
<script>

var deconnexion = document.querySelector('.deconnexion');

function handleClick(e) {

  var xhr = new XMLHttpRequest(),
      method = "GET",
      url = "index.php?deco=1";

  xhr.open(method, url, true);
  xhr.onreadystatechange = function () {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      console.log(xhr.responseText);
    }
  };
  xhr.send();

  // var xmlhttp = new XMLHttpRequest();

  // xmlhttp.onreadystatechange = function() {

  //   console.log('hello');

  //   if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
  //     document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
  //   }
  //   xmlhttp.open('POST', 'ajax.php', true);
  //   xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  //   xmlhttp.send("deco=true");
  //   document.getElementById("txtHint").innerHTML = 'processing...';
  // }
}

deconnexion.addEventListener('click', handleClick);

</script>
    <main class="content-wrapper">
      <div id="txtHint"></div>
      <?php
        if (!$_SESSION['estConnecte'])
          Template::loginForm();
      ?>
    </main>



<?php
  Template::footer();
?>