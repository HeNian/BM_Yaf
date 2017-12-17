<?php
/**
 * Created by PhpStorm.
 * User: BM
 */
namespace Library\Core;
use Yaf_Registry;

use Medoo\Medoo;

class Model extends Medoo
{
  public function __construct($options = null)
  {
    $db = Yaf_Registry::get('config')['mysql']->toArray();
    $options['database_type'] = 'mysql';
    $options['server'] = $db['host'];
    $options['database_name'] = $db['dbname'];
    $options['username'] = $db['username'];
    $options['password'] = $db['password'];
    $options['port'] = $db['port'];
    $options['charset'] = 'utf8';
    $options['option'] = [3=>1]; //PDO 开启异常模式

    parent::__construct($options);
  }
}