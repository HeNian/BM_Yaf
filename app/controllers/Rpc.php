<?php
/**
 * Created by PhpStorm.
 * User: BM
 */
use Library\Core\Controller;
use Model\Index\Logic\User;

class RpcController extends Controller {

    public function yarAction(){

        $server = new Yar_Server(new User());
        $server->handle();

        return false;
    }

    public function yar_clientAction(){

        $client = new Yar_Client("http://www.yaf.local/rpc/yar");


        $result = $client->test();

        DebugTools::print_r($result);

        return false;
    }

    public function yar_client_asyncAction(){
        Yar_Concurrent_Client::call("http://yaf.zhaoquan.com/rpc/yar", "getOne", array(), "RpcController::callback");
        Yar_Concurrent_Client::call("http://yaf.zhaoquan.com/rpc/yar", "getList", array(array('cost'=>8)), "RpcController::callback");

        Yar_Concurrent_Client::loop();
        return false;
    }

    static public function callback($ret, $callinfo) {
        echo $callinfo['method'] , " result: ", $ret , "\n";
        DebugTools::print_r($ret);
    }
}