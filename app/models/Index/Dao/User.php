<?php
namespace Model\Index\Dao;

class User
{
  public function getUserList($limit, $order)
  {
    $userRpc = new \Yar_client('http://172.16.1.13:9999/rpc/user');
    return $userRpc->getUserList($limit, $order);
  }
}