<?php

namespace app\modules\access\controllers;

use app\components\My_castom_elem;
use app\models\Contacts;
use app\models\Modifications;
use app\models\ProjectLinks;
use app\models\SettingsContacts;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ModificationsController extends Controller
{
    public function actionIndex()
    {
        $models = Modifications::find()->all();
        return $this->render('index', ['models' => $models]);
    }

    public function actionCreate()
    {
        $model = new Modifications();

        if ($model->load(\Yii::$app->request->post()))
        {
            if ($model->save())
            {
                \Yii::$app->session->setFlash('status', 'Запись успешно добавлена!');
                $post = \Yii::$app->request->post();
                $linked_projects = $post['Modifications']['linked_projects'];
                ProjectLinks::saveLinks($model->id, $linked_projects);

                return $this->redirect(['/access/modifications']);
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
            $post = \Yii::$app->request->post();
            $linked_projects = $post['Modifications']['linked_projects'];
            if($linked_projects != $model->linked_projects)
            {
                ProjectLinks::saveLinks($id, $linked_projects);
            }

            if ($model->save()) {
                \Yii::$app->session->setFlash('status','Запись успешно изменена!');
                return $this->redirect(['/access/modifications']);
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
        return $this->redirect(['/access/modifications']);

    }

    protected function findModel($id)
    {
        if (($model = Modifications::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
