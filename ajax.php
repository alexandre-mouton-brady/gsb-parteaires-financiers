<?php
session_start();

if (array_key_exists('deco', $_POST)) {
  unset($_SESSION['estConnecte']);
  echo '1';
}
?>