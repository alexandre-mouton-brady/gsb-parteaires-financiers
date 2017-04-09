<?php

  class Template {

    public static function getUrl() {
      $url = 'http://127.0.0.1/gsb-partenaires/';
      return $url;
    }

    public static function head($title) {
      echo '<!DOCTYPE html>';
      echo '<html lang="fr">';
      echo '<head>';
      echo '<meta charset="utf-8">';
      echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
      echo '<meta name="description" content="Le meilleur moyen de s\'impliquer dans une bonne cause. Simple et facile, participer au financement des projets GSB aujourd\'hui?.">';
      echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
      echo '<title>' . $title . '</title>';
      echo '<link href="' . Template::getUrl() . 'styles/main.css" rel="stylesheet">';
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
      echo '<a href="' . Template::getUrl() . 'inscription" class="btn">';
      echo '<span class="btn__text">Inscription</span>';
      echo '</a>';
      echo '<button type="submit" name="connexion" class="btn btn--raised">';
      echo '<span class="btn__text">Connexion</span>';
      echo '</button>';
      echo '</div>';
      echo '</form>';
    }

    public static function inscriptionForm() {
      echo '<form action="" autocomplete="nope" method="post" class="form form__inscription">';
      echo '<h1 class="form__title">Inscription partenaire</h1>';
      echo '<div class="input">';
      echo '<input type="text" class="input__field" name="name" id="name" required value="">';
      echo '<label for="name" class="input__label">Nom de l\'entreprise</label>';
      echo '<div class="input__focus"></div>';
      echo '</div>';
      echo '<div class="input">';
      echo '<input type="text" class="input__field" name="value" id="value" required value="">';
      echo '<label for="value" class="input__label">Montant du don</label>';
      echo '<div class="input__focus"></div>';
      echo '</div>';
      echo '<div class="group">';
      echo '<a href="' . Template::getUrl() . '" class="btn btn--danger">';
      echo '<span class="btn__text">Retour</span>';
      echo '</a>';
      echo '<button type="submit" name="inscription" class="btn btn--raised">';
      echo '<span class="btn__text">Inscription</span>';
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