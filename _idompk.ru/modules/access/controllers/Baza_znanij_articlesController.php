<?php
  namespace app\modules\access\controllers;

  use app\models\BazaZnanijArticles;
  use yii\helpers\FileHelper;
  use yii\web\Controller;
  use yii\web\NotFoundHttpException;
  use yii\web\UploadedFile;

  class Baza_znanij_articlesController extends Controller
  {

    public function actionIndex()
    {
      $models = BazaZnanijArticles::find()->orderBy(['id'=>SORT_DESC])->all();
      return $this->render('index',['models'=>$models]);
    }

    public function actionCreate()
    {
      $model = new BazaZnanijArticles();
      if ($model->load(\Yii::$app->request->post())) {
        $model->date_create = gmdate("Y-m-d H:i:s");
        $model->date_update = gmdate("Y-m-d H:i:s");

        $allImg = UploadedFile::getInstances($model, 'img_preview');
        $image = array();
        foreach($allImg as $Record)
        {
          $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
          $Record->saveAs('img/uploads/other/temp/' . $NewName);
          copy('img/uploads/other/temp/' . $NewName,'img/uploads/other/original/' . $NewName);
          $image[] = $NewName;
          BazaZnanijArticles::CreateStamp('img/uploads/projects/stamp.png','img/uploads/other/original/' . $NewName);
          BazaZnanijArticles::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/thumb/' . $NewName,370,270);
          BazaZnanijArticles::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/medium/' . $NewName,880,540);
        }
        if(count($image)>0)
          $model->img_preview = serialize($image);

        if ($model->save()) {
          \Yii::$app->session->setFlash('status','Запись успешно добавлена!');
          return $this->redirect(['/access/baza_znanij_articles']);
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
        $allImg = UploadedFile::getInstances($model, 'img_preview');
        $image = array();
        foreach($allImg as $Record)
        {
          $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
          $Record->saveAs('img/uploads/other/temp/' . $NewName);
          copy('img/uploads/other/temp/' . $NewName,'img/uploads/other/original/' . $NewName);
          $image[] = $NewName;
          BazaZnanijArticles::CreateStamp('img/uploads/projects/stamp.png','img/uploads/other/original/' . $NewName);
          BazaZnanijArticles::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/thumb/' . $NewName,370,270);
          BazaZnanijArticles::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/medium/' . $NewName,880,540);
        }
        if(count($image)>0) {
          $model->img_preview = serialize($image);
          $allImgD = unserialize($model->oldAttributes['img_preview']);
          foreach ($allImgD as $RecordD) {
            unlink('img/uploads/other/temp/' . $RecordD);
            unlink('img/uploads/other/thumb/' . $RecordD);
            unlink('img/uploads/other/medium/' . $RecordD);
            unlink('img/uploads/other/original/' . $RecordD);
          }
        } else {
          $model->img_preview = $model->oldAttributes['img_preview'];
        }

        if ($model->save()) {
          \Yii::$app->session->setFlash('status','Запись успешно изменена!');
          return $this->redirect(['/access/baza_znanij_articles']);
        }
      }
      return $this->render('update', [
        'model' => $model,
      ]);
    }

    public function actionDelete()
    {
      $model = $this->findModel($_POST['id']);
      $allImg = unserialize($model->img_preview);
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
      if (($model = BazaZnanijArticles::findOne($id)) !== null) {
        return $model;
      } else {
        throw new NotFoundHttpException('The requested page does not exist.');
      }
    }
  }
