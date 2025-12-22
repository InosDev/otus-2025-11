<?php


$autoloadPath = $_SERVER['DOCUMENT_ROOT'] . '/local/App/Debug/autoload.php';

if (file_exists($autoloadPath)) {
    require_once $autoloadPath;

} else {
    error_log("Autoloader NOT found at: " . $autoloadPath);
}

set_error_handler(function($errno, $errstr, $errfile, $errline) {

    $error = new \ErrorException($errstr, 0, $errno, $errfile, $errline);
    

    $application = \Bitrix\Main\Application::getInstance();
    $exceptionHandler = $application->getExceptionHandler();
    

    if ($exceptionHandler instanceof OTUSExceptionLogger) {
        $exceptionHandler->logError($errno, $errstr, $errfile, $errline);
    } else {

        error_log("OTUS: [{$errno}] {$errstr} in {$errfile} on line {$errline}");
    }
    

    return false;
});


?>