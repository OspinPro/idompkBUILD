<?php
namespace app\components;

use yii\helpers\Json;

class My_castom_elem
{

  public static function get_ip()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }

  public static function save_data_contacts($model)
  {
    $arrContacts = [];
    $arrContacts[] = $model;

    file_put_contents('contacts.json',Json::encode($arrContacts));
  }

  public static function arr_to_col($all,$col)
  {
    $nums_arr = [];
    $cont = 1;$cont_ms = 0;
    foreach ($all as $mns)
    {
      $nums_arr[$cont_ms][] = $mns;
      if($cont==$col)
      {
        $cont = 1;
        $cont_ms++;
      } else {
        $cont++;
      }
    }
    return $nums_arr;
  }
}