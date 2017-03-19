<?php
  session_start();
  include_once('/classes/index.php');
  Template::head('login page');
  $url = $_SERVER['REQUEST_URI'];
?>