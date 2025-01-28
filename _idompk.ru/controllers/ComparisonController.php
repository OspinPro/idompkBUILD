<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\Session;

class ComparisonController extends Controller
{

  public function actionIndex()
  {
    return $this->render('index', ['differing' => $_GET['differing']]);
  }

  public function actionSet($id)
  {
    $session = new Session();
    $session->open();

    $rec = unserialize($session['comparison']);
    if(!$rec)
      $rec = [];
    $stat = 'set';
    if(in_array($id,$rec))
    {
      unset($rec[array_search($id,$rec)]);
      $stat = 'unset';
    }
    else
    {
      $rec[] = $id;
    }
    $session['comparison'] = serialize($rec);

    return json_encode(['status'=>$stat,'cn'=>count($rec)]);
  }

}