<?php

  namespace app\controllers;

  use app\models\SitePages;
  use app\models\User;
  use yii\web\Controller;

  class SitePagesController extends Controller
  {
    public function actionIndex()
    {
      return $this->render('/site/error');
    }

    public function actionItem($name,$original_url)
    {
      $page = SitePages::find()->where(['link_url'=>$name])->asArray()->one();
      if(!$page) {
        \Yii::$app->params['isError'] = true;
        return $this->render('error');
      } else {
        return $this->render('item', ['page' => $page]);
      }
    }
  }