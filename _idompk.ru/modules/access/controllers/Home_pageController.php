<?php

namespace app\modules\access\controllers;

use app\models\HomePage;
use app\models\User;
use yii\web\Controller;
use yii\web\UploadedFile;

class Home_pageController extends Controller
{
    public function actionIndex()
    {
        $model = HomePage::find()->one();

        if ($model->load(\Yii::$app->request->post()))
        {

            if ($model->save()) {
                \Yii::$app->session->setFlash('status','Запись успешно изменена!');
                return $this->redirect(['/access/home_page']);
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
