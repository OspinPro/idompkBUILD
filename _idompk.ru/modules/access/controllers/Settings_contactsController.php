<?php

namespace app\modules\access\controllers;

use app\components\My_castom_elem;
use app\models\Contacts;
use app\models\SettingsContacts;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class Settings_contactsController extends Controller
{
    public function actionIndex()
    {
        $models = SettingsContacts::find()->all();
        return $this->render('index', ['models' => $models]);
    }

    public function actionCreate()
    {
        $model = new SettingsContacts();

        if ($model->load(\Yii::$app->request->post()))
        {
            if ($model->save())
            {
                \Yii::$app->session->setFlash('status', 'Запись успешно добавлена!');
                return $this->redirect(['/access/settings_contacts']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(\Yii::$app->request->post()))
        {
            if ($model->save()) {
                \Yii::$app->session->setFlash('status','Запись успешно изменена!');
                return $this->redirect(['/access/settings_contacts']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete()
    {
        $model = $this->findModel($_GET['id']);

        if(!empty($model))
        {
           $model->delete();
        }
        \Yii::$app->session->setFlash('status','Запись успешно удалена!');
        return $this->redirect(['/access/settings_contacts']);

    }

    protected function findModel($id)
    {
        if (($model = SettingsContacts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
