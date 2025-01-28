<?php

namespace app\modules\access\controllers;

use app\models\Countries;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CountriesController extends Controller
{
    public function actionIndex()
    {
        $models = Countries::find()->all();
        return $this->render('index', ['models' => $models]);
    }

    public function actionCreate()
    {
        $model = new Countries();

        if ($model->load(\Yii::$app->request->post()))
        {
            if ($model->save())
            {
                \Yii::$app->session->setFlash('status', 'Запись успешно добавлена!');
                return $this->redirect(['/access/countries']);
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
                return $this->redirect(['/access/countries']);
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
        return $this->redirect(['/access/countries']);

    }

    protected function findModel($id)
    {
        if (($model = Countries::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
