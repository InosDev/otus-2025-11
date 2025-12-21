<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Ошибка для exeption");
?>
<ul class="list-group">
    <li class="list-group-item">
        <a href="/local/logs/exceptions.log">Файл лога</a>
    </li>
</ul>


<?

$a = 10;
$b = 0;
$result = $a / $b; 

?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
