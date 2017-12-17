<?php
namespace Model\Index\Logic;

use Model\Index\Dao\User as UserDao;

class User
{
  public function test()
  {
    $user = new UserDao();

    return $user->test();
  }
}