<?php

try {
    if (!file_exists("logging.php")) {
        throw new Exception('logging.php does not exist!');
    } else {
        include_once 'logging.php';
    }
} catch (Exception $exception) {
    error_log($exception->getMessage() . "\t\t" . date("d/m/y H:i:s") . "\t\t" . $_SERVER['PHP_SELF'] . "\r\n", 3, "..\\error_log.txt");
    header('Location: http://' . $_SERVER['SERVER_NAME'] . '/error-page.html');
}

  session_start();
  write_logs("sign out");
  session_destroy();
  header('Location: http://'.$_SERVER['SERVER_NAME']);
?>