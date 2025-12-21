<?php

require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/header.php';

/**
 *  @var cMain $APPLICATION
 */

$APPLICATION->SetTitle('Пример использования dump() из symhony');

dump(123);

require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/footer.php';

?>
