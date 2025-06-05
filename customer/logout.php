<?php
   session_start();
   session_destroy();
   header('Location:../?part-customer=login');
?>

