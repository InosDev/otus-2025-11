<?php

$autoloadPath = $_SERVER['DOCUMENT_ROOT'] . '/local/App/Debug/autoload.php';

if (file_exists($autoloadPath)) {
    require_once $autoloadPath;

} else {
    error_log("Autoloader NOT found at: " . $autoloadPath);
}
?>