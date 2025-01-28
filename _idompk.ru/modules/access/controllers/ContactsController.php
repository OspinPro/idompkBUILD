<?php

namespace app\modules\access\controllers;

use app\components\My_castom_elem;
use app\models\Contacts;
use app\models\User;
use yii\web\Controller;

class ContactsController extends Controller
{
    public function actionIndex()
    {
        $model = Contacts::find()->one();

        if ($model->load(\Yii::$app->request->post()))
        {
            if ($model->save()) {
                My_castom_elem::save_data_contacts($model);
                \Yii::$app->session->setFlash('status','Запись успешно изменена!');
                return $this->redirect(['/access/contacts']);
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
