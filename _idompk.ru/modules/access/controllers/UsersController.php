<?php

namespace app\modules\access\controllers;

use app\models\User;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class UsersController extends Controller
{
    public function actionIndex($id)
    {
      $model = $this->findModel($id);

      if ($model->load(\Yii::$app->request->post()))
      {
        if ($model->password != $model->oldAttributes['password']) {
          $model->accessToken = \Yii::$app->security->generateRandomString();
          if (\Yii::$app->user->id == $model->id) {
            setcookie("moment_auth_sha", $model->accessToken, time() +3600*24*300,'/',$_SERVER['HTTP_HOST'],true);
          }
        }
        if($model->password)
          $model->password = $model->password;
        else
          $model->password = $model->oldAttributes['password'];
        if ($model->save()) {
          \Yii::$app->session->setFlash('status','Запись успешно изменена!');
          return $this->redirect(['/access/']);
        }
      }
      $model->password = '';
      return $this->render('update', [
        'model' => $model,
      ]);
    }

    /**
     * Creates a new Dealers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User;

        if ($model->load(\Yii::$app->request->post())) {

            if($model->password)
                $model->password = base64_encode($model->password);
            $model->role = 'client';
            $model->login = $model->email;
            if ($model->save()) {
                \Yii::$app->session->setFlash('status','Запись успешно добавлена!');
                return $this->redirect(['/access/user_clients/']);
            }
        }
        $model->password = '';
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dealers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(\Yii::$app->request->post()))
        {
            if ($model->password != $model->oldAttributes['password']) {
              $model->accessToken = \Yii::$app->security->generateRandomString();
              if (\Yii::$app->user->id == $model->id) {
                setcookie("moment_auth_sha", $model->accessToken, time() +3600*24*300,'/',$_SERVER['HTTP_HOST'],true);
              }
            }
            if($model->password)
                $model->password = $model->password;
            else
                $model->password = $model->oldAttributes['password'];
            if ($model->save()) {
                \Yii::$app->session->setFlash('status','Запись успешно изменена!');
                return $this->redirect(['/access/']);
            }
        }
        $model->password = '';
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
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
