<?php
class Bootstrap extends Yaf_Bootstrap_Abstract{

    private $_config;

    public function _initConfig(Yaf_Dispatcher $dispatcher){
        $this->_config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set('config', $this->_config);
    }

    //错误转异常 统一处理
    public function _initError(Yaf_Dispatcher $dispatcher){
        if (DEBUG) {
            ini_set('display_errors',1);
            error_reporting(E_ALL);
        } else {
            error_reporting(0);
            return;
        }
        
        ob_start();

        set_error_handler(function($type, $message, $file, $line){
            $e = new ErrorToException($message);
            $e->file = $file;
            $e->line = $line;
            $e->code = $type;
            throw $e;
        });

        // register_shutdown_function(function(){
        //     $e = error_get_last();    
        //     print_r($e);  
        // });

        set_exception_handler(function($exception){
            ob_end_clean();

            $view = new Yaf_View_Simple(APPLICATION_PATH . '/app/views/error');

            if (!is_null($exception->getPrevious())) {
                $exception = $exception->getPrevious();
            }

            $msg = array(
                'code'=>$exception->getCode(),
                'file'=>$exception->getFile(),
                'line'=>$exception->getLine(),
                'message'=>$exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            );

            $view->assign($msg);
            $errorPage = $view->render('error.phtml');
            exit($errorPage);
        });
    }

    public function _initLoader(Yaf_Dispatcher $dispatcher) {

    }

    public function _initRoute(Yaf_Dispatcher $dispatcher){

    }

    public function _initLayout(Yaf_Dispatcher $dispatcher){
        $layout = new LayoutPlugin('layout.'.$this->_config['application']['view']['ext'], $this->_config->application->directory.'/views/');

        Yaf_Registry::set('layout',$layout);

        $dispatcher->registerPlugin($layout);
    }

    public function _initView(Yaf_Dispatcher $dispatcher){

    }

    public function _initComposer(Yaf_Dispatcher $dispatcher){
        $autoload = $this->_config['composer']['autoload'];
        if (file_exists($autoload)) {
            Yaf_Loader::import($autoload);
        }
    }
}





class ErrorToException extends Exception
{
    public function __set($key, $val)
    {
        $this->$key = $val;
    }
}