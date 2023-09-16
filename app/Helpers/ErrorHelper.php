<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Log;

class ErrorHelper{


   /**
    * Handles all errors
    *
    * @param [type] $level
    * @param string $message the error message
    * @param string $file The file where error is thrown
    * @param int $line The line on the file
    * @return void
    */
   public static function errorHandler($level,$message,$file,$line){
      if(error_reporting() !== 0){
         throw new \ErrorException($message,0,$level,$file,$line);
      }
   }

   /**
    * Exception Handler
    *
    * @param \Exception $e the exception
    * @return void
    */
   public static function exceptionHandler($e): void
   {
      $code = $e->getCode();
      $logFile = "./storage/logs/".date("Y-m-d").".txt";
       ini_set("error_log",$logFile);
      http_response_code($code);

       $error = "Uncaught Exception: '". get_class($e) ."'";
       $error .= " with Message: ". $e->getMessage();
       $error .= "\nStack trace: ". $e->getTraceAsString();
       $error .= "\nThrown in: ". $e->getFile(). " on line ". $e->getLine();
        print($logFile);
      if(env('APP_ENV') !== 'local'){
         Log::error($error);
      }else{
         echo $error;
      }
   }

}
