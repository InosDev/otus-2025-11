<?
namespace App\Debug;

class Log 
{
    public static function LogCustom($message): void
    {
        $logFile = $_SERVER['DOCUMENT_ROOT'].'/local/logs/log_custom.log';
        
        $log  = "\n-----------------------\n";
        $log .= 'Текущая дата лога' . "\n";
        $log .= date('d.m.Y H:i:s') . "\n";
        $log .= print_r($message, true) . "\n";
        $log .= "-----------------------\n";
        
        // Создаем директорию, если она не существует
        $logDir = dirname($logFile);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        file_put_contents($logFile, $log, FILE_APPEND);
    }

    public static function clearlog(): void
    {

        $logFile = $_SERVER['DOCUMENT_ROOT'].'/local/logs/log_custom.log';
        
        file_put_contents($logFile, '');
        
        return;

    
    } 
}  

?>