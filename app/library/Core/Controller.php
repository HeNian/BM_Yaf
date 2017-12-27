<?php
/**
 * Created by PhpStorm.
 * User: BM
 */
namespace Library\Core;
use Yaf_Dispatcher;

use Yaf_Controller_Abstract;

class Controller extends Yaf_Controller_Abstract
{
    public function init()
    {
        Yaf_Dispatcher::getInstance()->autoRender(false);
    }

    protected function assign($key, $val)
    {
        $this->getView()->assign($key, $val);
    }

    protected function display($tpl = NULL, ?array $parameters = NULL)
    {
      if(is_null($tpl)) $tpl = $this->getRequest()->getActionName();
      parent::display($tpl,$parameters);
    }
}