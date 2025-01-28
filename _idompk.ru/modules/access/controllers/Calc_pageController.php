<?php

namespace app\modules\access\controllers;

use app\models\CalcPage;
use yii\web\Controller;

class Calc_pageController extends Controller
{
    public function actionIndex()
    {
      $model = CalcPage::find()->one();

      if ($model->load(\Yii::$app->request->post()))
      {
          if ($model->save()) {
              \Yii::$app->session->setFlash('status','Запись успешно изменена!');
              return $this->redirect(['/access/calc_page']);
          }
      }

      return $this->render('index', [
          'model' => $model,
      ]);
    }
}
