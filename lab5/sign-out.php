<?php
include_once 'logging.php';

  session_start();
  write_logs("sign out");
  session_destroy();
  header('Location: http://'.$_SERVER['SERVER_NAME']);
?>