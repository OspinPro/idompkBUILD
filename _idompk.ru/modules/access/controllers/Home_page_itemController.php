<?php

namespace app\modules\access\controllers;

use app\models\HomePageItem;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class Home_page_itemController extends Controller
{

  public function actionIndex()
  {
    $models = HomePageItem::find()->all();
    return $this->render('index',['models'=>$models]);
  }

  public function actionCreate()
  {
    $model = new HomePageItem();

    if ($model->load(\Yii::$app->request->post())) {

      $allImg = UploadedFile::getInstances($model, 'image');
      $image = array();


      foreach($allImg as $Record)
      {
        $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
        $Record->saveAs('img/uploads/other/temp/' . $NewName);
        copy('img/uploads/other/temp/' . $NewName,'img/uploads/other/original/' . $NewName);
        $image[] = $NewName;
        HomePageItem::CreateStamp('img/uploads/projects/stamp.png','img/uploads/other/original/' . $NewName);
        HomePageItem::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/thumb/' . $NewName,370,270);
        HomePageItem::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/medium/' . $NewName,880,540);
      }
      if(count($image)>0)
        $model->image = serialize($image);




      if ($model->save()) {

        \Yii::$app->session->setFlash('status','Запись успешно добавлена!');
        return $this->redirect(['/access/home_page_item']);
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

      $allImg = UploadedFile::getInstances($model, 'image');
      $image = array();

      foreach($allImg as $Record)
      {
        $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
        $Record->saveAs('img/uploads/other/temp/' . $NewName);
        copy('img/uploads/other/temp/' . $NewName,'img/uploads/other/original/' . $NewName);
        $image[] = $NewName;
        HomePageItem::CreateStamp('img/uploads/projects/stamp.png','img/uploads/other/original/' . $NewName);
        HomePageItem::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/thumb/' . $NewName,370,270);
        HomePageItem::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/medium/' . $NewName,880,540);
      }
      if(count($image)>0) {
        $model->image = serialize($image);

        $allImgD = unserialize($model->oldAttributes['image']);
        foreach ($allImgD as $RecordD) {
          unlink('img/uploads/other/temp/' . $RecordD);
          unlink('img/uploads/other/thumb/' . $RecordD);
          unlink('img/uploads/other/medium/' . $RecordD);
          unlink('img/uploads/other/original/' . $RecordD);
        }

      } else {
        $model->image = $model->oldAttributes['image'];
      }



      if ($model->save()) {
        \Yii::$app->session->setFlash('status','Запись успешно изменена!');
        return $this->redirect(['/access/home_page_item']);
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
    $allImg = unserialize($model->image);
    if(!empty($model))
    {

      foreach($allImg as $Record) {
        unlink('img/uploads/other/temp/'.$Record);
        unlink('img/uploads/other/thumb/'.$Record);
        unlink('img/uploads/other/medium/'.$Record);
        unlink('img/uploads/other/original/'.$Record);
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
   * @return HomePageItem the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = HomePageItem::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }
}
