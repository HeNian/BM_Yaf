<?php
use Library\Core\Controller;
use Model\Index\Dao\User;

class UserController extends Controller
{
  public function indexAction()
  {
    // $userRpc = new Yar_client('http://172.16.1.13:9999/rpc/user');
    $userRpc = new User();

    $list = $userRpc->getUserList(10,'desc');
    

    dd($list);

  }


}