<?php
  namespace app\modules\access\controllers;

  use app\models\SitePages;
  use yii\web\Controller;
  use yii\web\NotFoundHttpException;
  use yii\web\UploadedFile;

  class Site_pagesController extends Controller
  {

    public function actionIndex()
    {
      $models = SitePages::find()->orderBy(['id'=>SORT_DESC])->all();
      return $this->render('index',['models'=>$models]);
    }

    public function actionCreate()
    {
      $model = new SitePages();
      if ($model->load(\Yii::$app->request->post())) {
        $model->date_create = gmdate("Y-m-d H:i:s");
        $model->date_update = gmdate("Y-m-d H:i:s");

        $allImg = UploadedFile::getInstances($model, 'preview_image');
        $image = array();
        foreach($allImg as $Record)
        {
          $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
          $Record->saveAs('img/uploads/other/temp/' . $NewName);
          copy('img/uploads/other/temp/' . $NewName,'img/uploads/other/original/' . $NewName);
          $image[] = $NewName;
          SitePages::CreateStamp('img/uploads/projects/stamp.png','img/uploads/other/original/' . $NewName);
          SitePages::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/thumb/' . $NewName,370,270);
          SitePages::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/medium/' . $NewName,880,540);
        }
        if(count($image)>0)
          $model->preview_image = serialize($image);

        if ($model->save()) {
          \Yii::$app->session->setFlash('status','Запись успешно добавлена!');
          return $this->redirect(['/access/site_pages']);
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
        $model->date_update = gmdate("Y-m-d H:i:s");
        $allImg = UploadedFile::getInstances($model, 'preview_image');
        $image = array();
        foreach($allImg as $Record)
        {
          $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
          $Record->saveAs('img/uploads/other/temp/' . $NewName);
          copy('img/uploads/other/temp/' . $NewName,'img/uploads/other/original/' . $NewName);
          $image[] = $NewName;
          SitePages::CreateStamp('img/uploads/projects/stamp.png','img/uploads/other/original/' . $NewName);
          SitePages::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/thumb/' . $NewName,370,270);
          SitePages::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/medium/' . $NewName,880,540);
        }
        if(count($image)>0) {
          $model->preview_image = serialize($image);
          $allImgD = unserialize($model->oldAttributes['preview_image']);
          foreach ($allImgD as $RecordD) {
            unlink('img/uploads/other/temp/' . $RecordD);
            unlink('img/uploads/other/thumb/' . $RecordD);
            unlink('img/uploads/other/medium/' . $RecordD);
            unlink('img/uploads/other/original/' . $RecordD);
          }
        } else {
          $model->preview_image = $model->oldAttributes['preview_image'];
        }

        if ($model->save()) {
          \Yii::$app->session->setFlash('status','Запись успешно изменена!');
          return $this->redirect(['/access/site_pages']);
        }
      }
      return $this->render('update', [
        'model' => $model,
      ]);
    }

    public function actionDelete()
    {
      $model = $this->findModel($_POST['id']);
      $allImg = unserialize($model->preview_image);
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

    protected function findModel($id)
    {
      if (($model = SitePages::findOne($id)) !== null) {
        return $model;
      } else {
        throw new NotFoundHttpException('The requested page does not exist.');
      }
    }
  }
