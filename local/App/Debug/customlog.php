<?php

namespace Bitrix\Main\Diag;

class OtusExceptionHandlerLog extends FileExceptionHandlerLog
{
    /**
     * Переопределяем форматирование сообщения об исключении
     * Добавляем OTUS к каждой ошибке
     */
    protected function writeMessage($exception, $logType)
    {
        $message = $this->formatMessage($exception);
        
        // Добавляем OTUS к сообщению
        $message = $this->addOtusPrefix($message, $exception);
        
        if ($this->fileHandle)
        {
            fwrite($this->fileHandle, $message);
            fflush($this->fileHandle);
        }
    }
    
    /**
     * Форматируем сообщение с добавлением OTUS
     */
    protected function formatMessage(\Throwable $exception): string
    {
        $message = '';
        $exceptionClass = get_class($exception);
        
        // Для DivisionByZeroError - особый формат
        if ($exceptionClass === 'DivisionByZeroError') {
            $message = sprintf(
                "[%s] OTUS [%s] \nDivision by zero\n%s:%d\n%s\n",
                date('Y-m-d H:i:s'),
                $exceptionClass,
                $exception->getFile(),
                $exception->getLine(),
                str_repeat('-', 10)
            );
        } else {
            // Для других исключений
            $message = sprintf(
                "[%s] OTUS [%s] \n%s\n%s:%d\n%s\n",
                date('Y-m-d H:i:s'),
                $exceptionClass,
                $exception->getMessage(),
                $exception->getFile(),
                $exception->getLine(),
                str_repeat('-', 10)
            );
        }
        
        // Добавляем стек вызовов
        $trace = $exception->getTraceAsString();
        $message .= "Stack trace:\n" . $trace . "\n\n";
        
        return $message;
    }
    
    /**
     * Добавляем префикс OTUS к сообщению
     */
    private function addOtusPrefix(string $message, \Throwable $exception): string
    {
        // Уже добавили в formatMessage, но на всякий случай
        if (strpos($message, 'OTUS') === false) {
            $lines = explode("\n", $message);
            if (count($lines) > 0) {
                $lines[0] = str_replace(
                    '[' . get_class($exception) . ']',
                    '[' . get_class($exception) . '] OTUS',
                    $lines[0]
                );
            }
            $message = implode("\n", $lines);
        }
        
        return $message;
    }

    
}