<?php

use Library\Core\Controller;
use Library\Core\Model;
use Library\Core\Log;

use Model\Index\Logic\DateRange;

class IndexController extends Controller
{
	public function indexAction()
  {
    $db = new Model();
    $result = $db->select('order', [
        "[>]order_customize" => ['id'=>'order_id']
      ], '*', ['LIMIT'=>5]);

    Log::alert('hello');

    Log::error('userList', $result);

    $this->assign('content', $result);
    $this->display('index');
	}

  public function testAction()
  {
    $date = '2017-11-11';
    $start = 1;

    $dateRange = new DateRange();

    $result = $dateRange->byWeek($date, $start);
    dump($result);
  }
}