<?php
  setcookie('cookie_auth', '', time() - 3600, '/');
  header('Location: /neatest/scripts/php/shop/landingpage.php');
  exit();
?>


