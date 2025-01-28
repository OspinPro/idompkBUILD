<?php

namespace app\modules\access\controllers;

use app\models\CalcPrices;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class Calc_pricesController extends Controller
{
    public function actionIndex()
    {

      $model = CalcPrices::find()->all();


      if (\Yii::$app->request->post())
      {
        $data = \Yii::$app->request->post('CalcPrices');

        foreach ($data as $param => $one)
        {
          $price = $one['price'];
          $calc = CalcPrices::find()->andWhere(['param' => $param])->one();
          if($calc) {
            $calc->price = $price;
            $calc->save();
          }
        }

        \Yii::$app->session->setFlash('status','Запись успешно изменена!');
        return $this->redirect(['/access/calc_prices']);
      }



      return $this->render('index', [
        'model' => $model,
      ]);
    }
}
