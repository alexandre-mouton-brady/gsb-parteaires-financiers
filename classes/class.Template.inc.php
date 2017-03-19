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
      echo '<link href="./styles/main.css" rel="stylesheet">';
      echo '</head>';
      echo '<body>';
    }
  }
?>