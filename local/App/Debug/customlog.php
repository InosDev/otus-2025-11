<?php

namespace Bitrix\Main\Diag;

class OtusExceptionHandlerLog extends FileExceptionHandlerLog
{
    private $URL;

   public function initialize(array $options)
   {
      $this->URL = $options["send_url"];
   }

   public function write($exception, $logType)
   {
      $title = \Bitrix\Main\Diag\ExceptionHandlerFormatter::severityToString($exception->getSeverity());
      $text = $exception->getMessage();
      $text .= "\n".$exception->getFile()."[".$exception->getLine()."]";
      $text = "OTUS - ".$text;
      $this->writeToFile($title,$text);
   }

    protected function writeToFile($title, $text)
   {

      $fullPath = $this->logDir . $this->logFile;

      $logFile = $_SERVER['DOCUMENT_ROOT'].'/local/logs/exceptions.log';
      
      $logEntry = sprintf(
         "[%s] [%s] %s\n%s\n\n%s\n%s\n\n",
         date('Y-m-d H:i:s'),
         $title,
         str_repeat("=", 80),
         $text,
         str_repeat("-", 80),
         PHP_EOL
      );
      
      file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
      
   }

   protected function SendError($title,$text)
   {
      $data = array('name' => $title, 'text' => $text);
      $sock = new CHTTP();
      $sock->Post($this->URL,$data);
   }  
    
}