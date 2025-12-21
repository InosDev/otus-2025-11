<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/App/Debug/log.php';

\App\Debug\Log::clearlog($message);

LocalRedirect('/otus/homework2/');
