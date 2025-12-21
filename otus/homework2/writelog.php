<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/App/Debug/log.php';

$message = 'Записали текущую дату в лог!';

\App\Debug\Log::LogCustom($message);

$APPLICATION->SetTitle("Добавление в лог");
?>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="/local/logs/log_custom.log">Файл лога</a>,
            в лог добавленно 'Открыта страница writelog.php'
        </li>
    </ul>
<?

?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>