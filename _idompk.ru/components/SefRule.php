<?php
namespace app\components;

use app\models\BazaZnanijArticles;
use app\models\SitePages;
use app\models\Urls;
use yii\web\UrlRuleInterface;

class SefRule implements UrlRuleInterface{

  public $connectionID = 'db';
  public $name;

  public function init(){
    if ($this->name === null) {
      $this->name = __CLASS__;
    }
  }

  public function createUrl($manager, $route, $params){
   /* $link = '';
    if(count($params)){
      $link = "?";
      foreach ($params as $key => $value){
        $link .= "$key=$value&";
      }
      $link = substr($link, 0, -1);
    }
    $sef = Urls::find()->where(['link' => $route.$link])->one();
    if ($sef){
      return $sef->link;
    }*/
    return false;
  }

  public function parseRequest($manager, $request)
  {
    $pathInfo = substr($_SERVER['REQUEST_URI'],1);
    if(!$pathInfo)
      return false;

    $link_data = explode('?',$pathInfo);

    $to_search = ($link_data[0]&&$link_data[0]!=$pathInfo)?([$pathInfo,$link_data[0]]):$pathInfo;
    $row = SitePages::find()->where(['link_url' => $to_search])->asArray()->one();
    $row1 = BazaZnanijArticles::find()->where(['link_url' => explode('/',$to_search)[1]])->asArray()->one();
    if($row || $row1) {
      $params = [];
      $route = $row? '/site-pages/item' : '/baza-znanij/item';
      $params['name'] = $to_search;
      $params['original_url'] = 1;
      $link_data[1] = urldecode($link_data[1]);
      if(isset($link_data[1])){
        $temp = explode('&',$link_data[1]);
        foreach($temp as $t){
          $t = explode('=', $t);
          $params[$t[0]] = $t[1];
        }
      }
      return [$route, $params];
    }
    else
      return false;
  }
}
