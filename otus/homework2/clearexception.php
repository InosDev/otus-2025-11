<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$logFile = $_SERVER['DOCUMENT_ROOT'].'/local/logs/exceptions.log';
        
file_put_contents($logFile, '');

LocalRedirect('/otus/homework2/');
