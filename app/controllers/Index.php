<?php

use Library\Core\Controller;
use Library\Core\Model;

class IndexController extends Controller
{
  protected $_layout = 'layout';
  protected $_enable_view = true;

	public function indexAction()
  {
    $db = new Model();
    $result = $db->select('order', [
        "[>]order_customize" => ['id'=>'order_id']
      ], '*', ['LIMIT'=>5]);

    //给 layout赋值
    $this->assignLayout('title','hello Layout');

    $this->getView()->assign('content', $result);
    $this->getView()->assign('layout','hello');
		return true;
	}
}