<?php

namespace app\modules\access\controllers;

use app\models\FilterItem;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class Filter_itemController extends Controller
{

  public function actionIndex($cat)
  {
    $models = FilterItem::find()->where(['cat_id'=>$cat])->all();
    return $this->render('index',['models'=>$models]);
  }

  public function actionCreate($cat)
  {
    $model = new FilterItem();

    if ($model->load(\Yii::$app->request->post())) {

      if($_POST['dop'])
        $model->dop = implode(',',$_POST['dop']);
      if($_POST['dopInfo'])
        $model->dopInfo = implode(',',$_POST['dopInfo']);
      if($model->eta)
        $model->eta = implode(',',$model->eta);
      if($model->garaj)
        $model->garaj = implode(',',$model->garaj);
      if($model->erker)
        $model->erker = implode(',',$model->erker);

      $model->cat_id = $cat;
      if ($model->save()) {

        \Yii::$app->session->setFlash('status','Запись успешно добавлена!');
        return $this->redirect(['/access/filter_item','cat'=>$cat]);
      }
    }

    if($model->dop)
      $model->dop = explode(',',$model->dop);
    if($model->dopInfo)
      $model->dopInfo = explode(',',$model->dopInfo);
    if($model->eta)
      $model->eta = explode(',',$model->eta);
    if($model->garaj)
      $model->garaj = explode(',',$model->garaj);
    if($model->erker)
      $model->erker = explode(',',$model->erker);

    return $this->render('create', [
      'model' => $model,
    ]);
  }

  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($model->load(\Yii::$app->request->post()))
    {
      if($_POST['dop'])
        $model->dop = implode(',',$_POST['dop']);
      else
        $model->dop = "";

      if($_POST['dopInfo'])
        $model->dopInfo = implode(',',$_POST['dopInfo']);
      else
        $model->dopInfo = "";

      if($model->eta)
        $model->eta = implode(',',$model->eta);
      else
        $model->eta = "";

      if($model->garaj)
        $model->garaj = implode(',',$model->garaj);
      else
        $model->garaj = "";

      if($model->erker)
        $model->erker = implode(',',$model->erker);
      else
        $model->erker = "";

      if ($model->save()) {
        \Yii::$app->session->setFlash('status','Запись успешно изменена!');
        return $this->redirect(['/access/filter_item','cat'=>$model->cat_id]);
      }
    }
    if($model->dop)
      $model->dop = explode(',',$model->dop);
    if($model->dopInfo)
      $model->dopInfo = explode(',',$model->dopInfo);
    if($model->eta)
      $model->eta = explode(',',$model->eta);
    if($model->garaj)
      $model->garaj = explode(',',$model->garaj);
    if($model->erker)
      $model->erker = explode(',',$model->erker);

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
   * @return FilterItem the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = FilterItem::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }
}
