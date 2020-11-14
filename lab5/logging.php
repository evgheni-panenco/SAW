<?php
    function write_logs($action) {
        $filename = "..\\log.txt";
        $fieldsSeparator = "\t\t";

        if (!file_exists($filename)) {
            $file = fopen($filename, "w") or die("Error");

            $logLine = "Время".$fieldsSeparator.$fieldsSeparator.
                       "Файл".$fieldsSeparator.$fieldsSeparator.
                       "User IP".$fieldsSeparator.$fieldsSeparator.
                       "Session ID".$fieldsSeparator.$fieldsSeparator.
                       "Username".$fieldsSeparator.
                       "Role".$fieldsSeparator.
                       "Action";

            fwrite($file, $logLine."\r\n");
            fclose($file);
        }

        $logLine = date("d/m/y H:i:s").$fieldsSeparator.
                   $_SERVER['PHP_SELF'].$fieldsSeparator.
                   $_SERVER['REMOTE_ADDR'].$fieldsSeparator.
                   SESSION_ID().$fieldsSeparator.
                   (("".$_SESSION['login'] != "") ? $_SESSION['login'] : "[-]").$fieldsSeparator.
                   (("".$_SESSION['role'] != "") ? $_SESSION['role'] : "[-]").$fieldsSeparator.
                   $action;

        $file = fopen($filename, "a") or die("Error");
        fwrite($file, $logLine."\r\n");
        fclose($file);
    }
?>
