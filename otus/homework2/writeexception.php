<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Ошибка для exeption");
?>

<?
ob_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$logFile = $_SERVER['DOCUMENT_ROOT'] . '/local/logs/exceptions.log';

function writeOtusLog($message) {
    global $logFile;
    $logDir = dirname($logFile);
    
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    
    $message = "OTUS [DivisionByZeroError] \nOTUS Division by zero\n" . $message . "\n----------\n";
    
    file_put_contents($logFile, date('Y-m-d H:i:s') . "\n" . $message, FILE_APPEND);
}

register_shutdown_function(function() {
    global $logFile;
    
    $output = ob_get_clean();
    
    if (preg_match('/Division by zero.*?\n(.*?):(\d+)/s', $output, $matches)) {
        $file = $matches[1];
        $line = $matches[2];
        
        $errorText = "[DivisionByZeroError] \nOTUS Division by zero\n$file:$line\n----------\n";
        
        file_put_contents($logFile, date('Y-m-d H:i:s') . "\n" . $errorText, FILE_APPEND);
        
        $output = str_replace(
            'OTUSDivision by zero',
            'Division by zero',
            $output
        );
    }
    
    echo $output;
});


function testDivision1() {
    try {
        $result = intdiv(10, 0);
    } catch (DivisionByZeroError $e) {
        throw new Exception("OTUS: Division by zero in " . $e->getFile() . ":" . $e->getLine());
    }
}

function testDivision2() {
    $result = 10 / 0;
}

try {
    testDivision1();
} catch (Exception $e) {
    echo "<pre style='color:blue;'>" . htmlspecialchars($e->getMessage()) . "</pre>";
    writeOtusLog($e->getMessage());
}

testDivision2();


?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>