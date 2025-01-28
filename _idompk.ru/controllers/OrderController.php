<?php

namespace app\controllers;

use app\models\Projects;
use app\models\ProjSettings;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class OrderController extends Controller
{
  public function actionIndex()
  {
    throw new NotFoundHttpException();
    return $this->render('cart');
  }
  public function actionItem($name)
  {
    $proj = Projects::find()->where(['num_pr'=>$name])->asArray()->one();

    return $this->render('index',['proj'=>$proj]);
  }
}