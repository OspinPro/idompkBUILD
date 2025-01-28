<?php

namespace app\modules\access\controllers;

use app\models\SostavItem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class Sostav_itemsController extends Controller
{

    public function actionIndex()
    {
        $models = SostavItem::find()->all();
        return $this->render('index',['models'=>$models]);
    }

    public function actionCreate()
    {
        $model = new SostavItem();

        if ($model->load(\Yii::$app->request->post())) {


            if ($model->save()) {

                \Yii::$app->session->setFlash('status','Запись успешно добавлена!');
                return $this->redirect(['/access/sostav_items']);
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
                return $this->redirect(['/access/sostav_items']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Dealers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */

    public function actionDelete()
    {
        $model = $this->findModel($_POST['id']);
        if(!empty($model))
        {
            if($model->delete())
                return json_encode(['status'=>'ok']);
        }

        return json_encode(['status'=>'error']);
    }


    /**
     * Finds the Dealers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SostavItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SostavItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
