<?php

namespace app\modules\access\controllers;

use app\models\Projects;
use app\models\ProjSettings;
use app\models\User;
use yii\web\Controller;
use yii\web\UploadedFile;

class Pr_settingsController extends Controller
{
    public function actionIndex()
    {
      $model = ProjSettings::find()->one();


        if ($model->load(\Yii::$app->request->post()))
        {



            if ($model->save()) {
                \Yii::$app->session->setFlash('status','Запись успешно изменена!');
                return $this->redirect(['/access/pr_settings']);
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
