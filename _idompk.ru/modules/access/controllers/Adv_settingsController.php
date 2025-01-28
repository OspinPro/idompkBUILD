<?php
  namespace app\modules\access\controllers;

  use app\models\AdvSettings;
  use yii\web\Controller;
  use yii\web\UploadedFile;

  class Adv_settingsController extends Controller
  {
    public function actionIndex()
    {
      $model = AdvSettings::find()->one();
      if ($model->load(\Yii::$app->request->post()))
      {
        if ($model->save()) {
          \Yii::$app->session->setFlash('status','Запись успешно изменена!');
          return $this->redirect(['/access/adv_settings']);
        }
      }
      return $this->render('index', [
        'model' => $model,
      ]);
    }
  }
