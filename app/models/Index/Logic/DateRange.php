<?php
namespace Model\Index\Logic;


class DateRange
{
  public function byWeek($date, $startDay = 1)
  {
    $time = strtotime($date);

    //通过差值计算起始时间 先获取到周一的日期 加上供应商结算周期起始日期
    $cha = date('N', $time) - 1 - ($startDay -1);

    $time = strtotime($date . '-' . $cha . 'day');

    //如果通过差值调整 当前日期不在范围中，范围前移一个周期
    if(strtotime($date) < $time) $time = strtotime(date('Y-m-d',$time) . '-1week');

    $startTime = date('Y-m-d H:i:s', $time);
    $endTime = date('Y-m-d H:i:s', strtotime(date('Y-m-d',$time) . '+1week'));

    return [$startTime, $endTime];
  }

  public function byMonth()
  {}

  public function byUserDefined()
  {}
}