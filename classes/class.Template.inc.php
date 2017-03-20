<?php

  class Template {

    public static function head($title) {
      echo '<!DOCTYPE html>';
      echo '<html lang="fr">';
      echo '<head>';
      echo '<meta charset="utf-8">';
      echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
      echo '<meta name="description" content="Le meilleur moyen de s\'impliquer dans une bonne cause. Simple et facile, participer au financement des projets GSB aujourd\'hui?.">';
      echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
      echo '<title>' . $title . '</title>';
      echo '<link href="styles/main.css" rel="stylesheet">';
      echo '</head>';
      echo '<body>';
    }

    public static function header($page) {
      echo '<header class="header">';
      echo '<section class="header__section">';
      echo '<span class="header__title">GSB - Partenaires | ' . $page . '</span>';
      echo '</section>';
      echo '<section class="header__section">';
      if ($_SESSION['estConnecte'] == True) {
        echo '<button class="deconnexion">Déconnexion</button>';
      }
      echo '</section>';
      echo '</header>';
    }

    public static function footer() {
      echo '</body>';
      echo '</html>';
    }

    public static function loginForm() {
      echo '<form action="" autocomplete="nope" method="post" class="form">';
      echo '<h1 class="form__title">Connexion partenaire</h1>';
      echo '<div class="input">';
      echo '<input type="text" class="input__field" name="login" id="login" required value="">';
      echo '<label for="login" class="input__label">Nom d\'utilisateur</label>';
      echo '<div class="input__focus"></div>';
      echo '</div>';
      echo '<div class="input">';
      echo '<input type="password" class="input__field" name="motDePasse" id="motDePasse" required value="">';
      echo '<label for="motDePasse" class="input__label">Mot de passe</label>';
      echo '<div class="input__focus"></div>';
      echo '</div>';
      echo '<div class="group">';
      echo '<a href="<?php echo $url; ?>inscription" class="btn">';
      echo '<span class="btn__text">Inscription</span>';
      echo '</a>';
      echo '<button type="submit" name="connexion" class="btn btn--raised">';
      echo '<span class="btn__text">Connexion</span>';
      echo '</button>';
      echo '</div>';
      echo '</form>';
    }

    public static function information($success, $message) {
      $class = $success ? 'success' : 'danger';

      echo '<div class="modal ' . $class . '">';
      echo '<span>' . $message . '</span>';
      echo '</div>';
    }

  }

?>