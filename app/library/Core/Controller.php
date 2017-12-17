<?php
/**
 * Created by PhpStorm.
 * User: BM
 */
namespace Library\Core;

use Yaf_Controller_Abstract;
use Yaf_Registry;
use Yaf_Dispatcher;
use Yaf_Exception;

class Controller extends Yaf_Controller_Abstract
{
    protected $_layout = null;
    protected $_enable_view = true;

    protected function init(){
        if (!$this->getRequest()->isCli()){
            if ($this->_enable_view){
                $this->_regWidget();
                $this->_setLayout();
            }else {
                Yaf_Dispatcher::getInstance()->returnResponse(true);
                Yaf_Dispatcher::getInstance()->disableView();
                $this->_removeLayout();
            }
        }else {
            try {
                throw new Yaf_Exception("Environment is not in WEB mode.\n");
            } catch (Yaf_Exception $e){
                print $e->getMessage();
                exit(1);
            }
        }
    }

    protected function _regWidget(){
        $this->getView()->widget = function($widget_name=null,$widget_option=array()){
            $widget_name = '\Widget\\' . $widget_name;
            $widget = new $widget_name($widget_option);
        };
    }


    protected function _setLayout(){
        $config = Yaf_Registry::get('config');
        if (!$this->_layout){
            $layout = Yaf_Registry::get('layout');
            $layout->setFile(null);
        }else {
            if ($this->_layout != 'layout'){
                $layout = Yaf_Registry::get('layout');
                $layout->setFile($this->_layout.'.'.$config['application']['view']['ext']);
            }
        }
    }

    protected function _removeLayout(){
        $layout = Yaf_Registry::get('layout');
        $layout->setFile(false);
    }

    protected function assignLayout($key, $val){
        $layout = Yaf_Registry::get('layout');
        $layout->$key = $val;
    }
}