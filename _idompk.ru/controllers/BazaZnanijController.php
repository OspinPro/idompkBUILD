<?php

  namespace app\controllers;

  use app\models\BazaZnanijArticles;
  use app\models\User;
  use yii\web\Controller;

  class BazaZnanijController extends Controller
  {
    public function actionIndex()
    {
//      return $this->render('/site/error');
      return $this->render('index');
    }

    public function actionItem($name,$original_url)
    {
      $page = BazaZnanijArticles::find()->where(['link_url'=>explode('/',$name)[1]])->asArray()->one();
      if(!$page) {
        \Yii::$app->params['isError'] = true;
        return $this->render('error');
      } else {
        return $this->render('item', ['page' => $page]);
      }
    }
  }