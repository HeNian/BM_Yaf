<?php
/**
 * Created by PhpStorm.
 * User: BM
 */
namespace Library\Core;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{
  private static $name = 'BM';
  private static $log = null;
  private static $path = '/logs/log.txt';

  public static function getInstance()
  {
    if( is_null(self::$log) ){
      self::$log = $log = new Logger(self::$name);
      $log->pushHandler(new StreamHandler(APPLICATION_PATH . self::$path, Logger::WARNING));
    }

    return self::$log;
  }

  public static function __callStatic($action, $params)
  {
    $log = self::getInstance();
    call_user_func_array([$log, $action], $params);
  }
}