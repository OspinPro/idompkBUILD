<?php

namespace app\modules\access\controllers;

use app\models\MapItem;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class Map_itemController extends Controller
{

  public function actionIndex()
  {
    $models = MapItem::find()->all();
    return $this->render('index',['models'=>$models]);
  }

  public function actionCreate()
  {
    $model = new MapItem();

    if ($model->load(\Yii::$app->request->post())) {

      $allImg = UploadedFile::getInstances($model, 'images');
      $images = array();
      foreach($allImg as $Record)
      {
        $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
        $Record->saveAs('img/uploads/map/temp/' . $NewName);
        copy('img/uploads/map/temp/' . $NewName,'img/uploads/map/original/' . $NewName);
        $images[] = $NewName;
        MapItem::CreateStamp('img/uploads/projects/stamp.png','img/uploads/map/original/' . $NewName);
        MapItem::img_resize('img/uploads/map/original/' . $NewName,'img/uploads/map/thumb/' . $NewName,170,100);
      }
      if(count($images)>0)
        $model->images = serialize($images);



      if ($model->save()) {

        \Yii::$app->session->setFlash('status','Запись успешно добавлена!');
        return $this->redirect(['/access/map_item']);
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

      $allImg = UploadedFile::getInstances($model, 'images');
      $images = array();

      foreach($allImg as $Record)
      {
        $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
        $Record->saveAs('img/uploads/map/temp/' . $NewName);
        copy('img/uploads/map/temp/' . $NewName,'img/uploads/map/original/' . $NewName);
        $images[] = $NewName;
        MapItem::CreateStamp('img/uploads/projects/stamp.png','img/uploads/map/original/' . $NewName);
        MapItem::img_resize('img/uploads/map/original/' . $NewName,'img/uploads/map/thumb/' . $NewName,170,100);
      }
      if(count($images)>0) {
        $model->images = serialize($images);

        $allImgD = unserialize($model->oldAttributes['images']);
        foreach ($allImgD as $RecordD) {
          unlink('img/uploads/map/temp/' . $RecordD);
          unlink('img/uploads/map/thumb/' . $RecordD);
          unlink('img/uploads/map/original/' . $RecordD);
        }

      } else {
        $model->images = $model->oldAttributes['images'];
      }

      if ($model->save()) {
        \Yii::$app->session->setFlash('status','Запись успешно изменена!');
        return $this->redirect(['/access/map_item']);
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
    $allImg = unserialize($model->images);

    if(!empty($model))
    {

      foreach($allImg as $Record) {
        unlink('img/uploads/map/temp/'.$Record);
        unlink('img/uploads/map/thumb/'.$Record);
        unlink('img/uploads/map/original/'.$Record);
      }

      if($model->delete())
        return json_encode(['status'=>'ok']);
    }

    return json_encode(['status'=>'error']);
  }


  /**
   * Finds the Dealers model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = MapItem::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }
}
