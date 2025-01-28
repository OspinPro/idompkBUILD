<?php

namespace app\modules\access\controllers;

use app\models\HomePageCategory;
use app\models\HomePageItem;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class Home_page_categoryController extends Controller
{

  public function actionIndex()
  {
    $models = HomePageCategory::find()->all();
    return $this->render('index',['models'=>$models]);
  }

  public function actionCreate()
  {
    $model = new HomePageCategory();

    if ($model->load(\Yii::$app->request->post())) {

      $allImg = UploadedFile::getInstances($model, 'image');
      $image = null;

      foreach($allImg as $Record)
      {
        $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
        $Record->saveAs('img/uploads/other/temp/' . $NewName);
        copy('img/uploads/other/temp/' . $NewName,'img/uploads/other/original/' . $NewName);
        $image = $NewName;
        HomePageItem::CreateStamp('img/uploads/projects/stamp.png','img/uploads/other/original/' . $NewName);
        HomePageItem::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/thumb/' . $NewName,370,270);
        HomePageItem::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/medium/' . $NewName,880,540);
      }

      if($image)
        $model->image = $image;

      if ($model->save()) {

        \Yii::$app->session->setFlash('status','Запись успешно добавлена!');
        return $this->redirect(['/access/home_page_category']);
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
      $image = null;

      foreach($allImg as $Record)
      {
        $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
        $Record->saveAs('img/uploads/other/temp/' . $NewName);
        copy('img/uploads/other/temp/' . $NewName,'img/uploads/other/original/' . $NewName);
        $image = $NewName;
        HomePageItem::CreateStamp('img/uploads/projects/stamp.png','img/uploads/other/original/' . $NewName);
        HomePageItem::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/thumb/' . $NewName,370,270);
        HomePageItem::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/medium/' . $NewName,880,540);
      }
      if(count($image)>0) {
        $model->image = $image;

        $allImgD = $model->oldAttributes['image'];
      unlink('img/uploads/other/temp/' . $allImgD);
      unlink('img/uploads/other/thumb/' . $allImgD);
      unlink('img/uploads/other/medium/' . $allImgD);
      unlink('img/uploads/other/original/' . $allImgD);

      } else {
        $model->image = $model->oldAttributes['image'];
      }

      if ($model->save()) {
        \Yii::$app->session->setFlash('status','Запись успешно изменена!');
        return $this->redirect(['/access/home_page_category']);
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
    $allImg =$model->image;
    if(!empty($model))
    {

        unlink('img/uploads/other/temp/'.$allImg);
        unlink('img/uploads/other/thumb/'.$allImg);
        unlink('img/uploads/other/medium/'.$allImg);
        unlink('img/uploads/other/original/'.$allImg);

      if($model->delete())
        return json_encode(['status'=>'ok']);
    }

    return json_encode(['status'=>'error']);
  }


  /**
   * Finds the Dealers model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return HomePageCategory the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = HomePageCategory::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }
}
