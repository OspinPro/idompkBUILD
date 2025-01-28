<?php

namespace app\modules\access\controllers;


use app\components\SSP;
use app\models\ProjectLinks;
use app\models\Projects;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ProjectsController extends Controller
{


  public function actionIndex()
  {
    $models = Projects::find()->all();
    return $this->render('index',['models'=>$models]);
  }

  public function actionCreate()
  {
    $model = new Projects();

    if ($model->load(\Yii::$app->request->post())) {

      $model->shirina_doma = str_replace(",", ".", $model->shirina_doma);
      $model->dlina_doma = str_replace(",", ".", $model->dlina_doma);

      $allImg = UploadedFile::getInstances($model, 'images');
      $images = array();
      foreach($allImg as $Record)
      {
        $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
        $Record->saveAs('img/uploads/projects/temp/' . $NewName);
        copy('img/uploads/projects/temp/' . $NewName,'img/uploads/projects/original/' . $NewName);
        $images[] = $NewName;
        Projects::CreateStamp('img/uploads/projects/stamp.png','img/uploads/projects/original/' . $NewName);
        Projects::img_resize('img/uploads/projects/original/' . $NewName,'img/uploads/projects/thumb/' . $NewName,370,270);
        Projects::img_resize('img/uploads/projects/original/' . $NewName,'img/uploads/projects/medium/' . $NewName,880,540);
      }
      if(count($images)>0)
        $model->images = serialize($images);

      $imageSliderUpload = UploadedFile::getInstances($model, 'image_slider');
      $imageSlider = null;
      foreach($imageSliderUpload as $imgSlider)
      {
        $fname = 'slider-'.time().'-'.mt_rand() . '.' . $imgSlider->extension;
        $imgSlider->saveAs('img/uploads/projects/temp/' . $fname);
        copy('img/uploads/projects/temp/' . $fname,'img/uploads/projects/original/' . $fname);
        $imageSlider = $fname;
        Projects::CreateStamp('img/uploads/projects/stamp.png','img/uploads/projects/original/' . $fname);
        Projects::img_resize('img/uploads/projects/original/' . $fname,'img/uploads/projects/thumb/' . $fname,370,270);
        Projects::img_resize('img/uploads/projects/original/' . $fname,'img/uploads/projects/medium/' . $fname,880,540);
      }

      if($imageSlider)
        $model->image_slider = $imageSlider;

        $allImgPlan = UploadedFile::getInstances($model, 'images_plan');
        $imagesPlan = array();
        foreach($allImgPlan as $RecordPlan)
        {
            $NewNamePlan = 'plan-'.time().'-'.mt_rand() . '.' . $RecordPlan->extension;
            $RecordPlan->saveAs('img/uploads/projects/temp/' . $NewNamePlan);
            copy('img/uploads/projects/temp/' . $NewNamePlan,'img/uploads/projects/original/' . $NewNamePlan);
            $imagesPlan[] = $NewNamePlan;
            Projects::CreateStamp('img/uploads/projects/stamp.png','img/uploads/projects/original/' . $NewNamePlan);
            Projects::img_resize('img/uploads/projects/original/' . $NewNamePlan,'img/uploads/projects/thumb/' . $NewNamePlan,370,270);
            Projects::img_resize('img/uploads/projects/original/' . $NewNamePlan,'img/uploads/projects/medium/' . $NewNamePlan,880,540);
        }
        if(count($imagesPlan)>0)
            $model->images_plan = serialize($imagesPlan);

      if($_POST['dop_pr'])
        $model->dop = implode(',',$_POST['dop_pr']);

      if($_POST['dop_info'])
        $model->dopInfo = implode(',',$_POST['dop_info']);

      if ($model->save()) {

          $post = \Yii::$app->request->post();
          $linked_projects = $post['Projects']['linked_projects'];
          if($linked_projects != $model->linked_projects)
          {
              ProjectLinks::saveLinks($model->id, $linked_projects);
          }

        \Yii::$app->session->setFlash('status','Запись успешно добавлена!');
        return $this->redirect(['/access/projects']);
      }
    }

    if($model->dop)
      $model->dop = explode(',',$model->dop);

    if($model->dopInfo)
      $model->dopInfo = explode(',',$model->dopInfo);


    $model->builds = json_encode($_POST['Projects']['builds']);

    return $this->render('create', [
      'model' => $model,
    ]);
  }

  public function actionUpdate($id)
  {
    $model = $this->findModel($id);
      $model->loadLinked();
    if ($model->load(\Yii::$app->request->post()))
    {

      $model->shirina_doma = str_replace(",", ".", $model->shirina_doma);
      $model->dlina_doma = str_replace(",", ".", $model->dlina_doma);

      $allImg = UploadedFile::getInstances($model, 'images');
      $images = array();

      foreach($allImg as $Record)
      {
        $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
        $Record->saveAs('img/uploads/projects/temp/' . $NewName);
        copy('img/uploads/projects/temp/' . $NewName,'img/uploads/projects/original/' . $NewName);
        $images[] = $NewName;
        Projects::CreateStamp('img/uploads/projects/stamp.png','img/uploads/projects/original/' . $NewName);
        Projects::img_resize('img/uploads/projects/original/' . $NewName,'img/uploads/projects/thumb/' . $NewName,370,270);
        Projects::img_resize('img/uploads/projects/original/' . $NewName,'img/uploads/projects/medium/' . $NewName,880,540);
      }
      if(count($images)>0) {
        $model->images = serialize($images);

        $allImgD = unserialize($model->oldAttributes['images']);
        foreach ($allImgD as $RecordD) {
          unlink('img/uploads/projects/temp/' . $RecordD);
          unlink('img/uploads/projects/thumb/' . $RecordD);
          unlink('img/uploads/projects/medium/' . $RecordD);
          unlink('img/uploads/projects/original/' . $RecordD);
        }

      } else {
        $model->images = $model->oldAttributes['images'];
      }

        $imageSliderUpload = UploadedFile::getInstances($model, 'image_slider');
        $imageSlider = null;

        foreach($imageSliderUpload as $imgSlider)
        {
            $fname = 'slider-'.time().'-'.mt_rand() . '.' . $imgSlider->extension;
            $imgSlider->saveAs('img/uploads/projects/temp/' . $fname);
            copy('img/uploads/projects/temp/' . $fname,'img/uploads/projects/original/' . $fname);
            $imageSlider = $fname;
            Projects::CreateStamp('img/uploads/projects/stamp.png','img/uploads/projects/original/' . $fname);
            Projects::img_resize('img/uploads/projects/original/' . $fname,'img/uploads/projects/thumb/' . $fname,370,270);
            Projects::img_resize('img/uploads/projects/original/' . $fname,'img/uploads/projects/medium/' . $fname,880,540);
        }

        if($imageSlider)
            $model->image_slider = $imageSlider;
        else
            $model->image_slider = $model->oldAttributes['image_slider'];

      $allImgP = UploadedFile::getInstances($model, 'images_plan');
      $imagesP = array();

      foreach($allImgP as $RecordP)
      {
        $NewNameP = 'plan-'.time().'-'.mt_rand() . '.' . $RecordP->extension;
        $RecordP->saveAs('img/uploads/projects/temp/' . $NewNameP);
        copy('img/uploads/projects/temp/' . $NewNameP,'img/uploads/projects/original/' . $NewNameP);
        $imagesP[] = $NewNameP;
        Projects::CreateStamp('img/uploads/projects/stamp.png','img/uploads/projects/original/' . $NewNameP);
        Projects::img_resize('img/uploads/projects/original/' . $NewNameP,'img/uploads/projects/thumb/' . $NewNameP,370,270);
        Projects::img_resize('img/uploads/projects/original/' . $NewNameP,'img/uploads/projects/medium/' . $NewNameP,880,540);
      }
      if(count($imagesP)>0) {
        $model->images_plan = serialize($imagesP);

        $allImgDP = unserialize($model->oldAttributes['images_plan']);
        foreach($allImgDP as $RecordDP) {
          unlink('img/uploads/projects/temp/'.$RecordDP);
          unlink('img/uploads/projects/thumb/'.$RecordDP);
          unlink('img/uploads/projects/medium/'.$RecordDP);
          unlink('img/uploads/projects/original/'.$RecordDP);
        }

      } else {
        $model->images_plan = $model->oldAttributes['images_plan'];
      }

      if($_POST['dop_pr'])
        $model->dop = implode(',',$_POST['dop_pr']);
      else
        $model->dop = '';

      if($_POST['dop_info'])
        $model->dopInfo = implode(',',$_POST['dop_info']);
      else
        $model->dopInfo = '';

      $model->builds = json_encode($_POST['Projects']['builds']);

      if ($model->save()) {
        \Yii::$app->session->setFlash('status','Запись успешно изменена!');
        return $this->redirect(['/access/projects']);
      }
    }

    if($model->dop)
      $model->dop = explode(',',$model->dop);

    if($model->dopInfo)
      $model->dopInfo = explode(',',$model->dopInfo);


    if($model->builds)
    $model->builds = Json::decode($model->builds);

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
    $allImgPlan = unserialize($model->images_plan);


    if(!empty($model))
    {
      foreach($allImg as $Record) {
        unlink('img/uploads/projects/temp/'.$Record);
        unlink('img/uploads/projects/thumb/'.$Record);
        unlink('img/uploads/projects/medium/'.$Record);
        unlink('img/uploads/projects/original/'.$Record);
      }

      foreach($allImgPlan as $RecordPlan) {
        unlink('img/uploads/projects/temp/'.$RecordPlan);
        unlink('img/uploads/projects/thumb/'.$RecordPlan);
        unlink('img/uploads/projects/medium/'.$RecordPlan);
        unlink('img/uploads/projects/original/'.$RecordPlan);
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
   * @return Projects the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Projects::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

  public function actionLoad()
  {
    $columns = array(
      array( 'db' => 'id', 'dt' => 0 ),
      array(
        'db' => 'num_pr',
        'dt' => 1 ,
        'formatter' => function($d,$row){
          $i = ('<a href="/catalog/proekty-domov/'.$d.'" class="on-default" target="_blank"><i class="fa fa-eye"></i></a> - '.$d.' ');
          return $i;
        }
      ),
      array( 'db' => 'priority',   'dt' => 2,
        'formatter' => function($d,$row) {
          if ($d == 2) {
            $l = ('Первый');
          }
          if ($d == 3) {
            $l = ('Второй');
          }
          if ($d == 4) {
            $l = ('Третий');
          }
          if ($d == 5) {
            $l = ('Четвертый');
          }
          if ($d == 1) {
            $l = ('Эксклюзив');
          }
          return $l;
        } ),
      array(
        'db' => 'images',
        'dt' => 3,
        'formatter' => function($d,$row) {
          $l = ('<a href="/img/uploads/projects/original/'.unserialize($d)[0].'" class="image-popup-no-margins"><img width="60" alt="" src="/img/uploads/projects/thumb/'.unserialize($d)[0].'"></a>');
          return $l;
        }
      ),
      array( 'db' => 'prcie_all',   'dt' => 4,
        'formatter' => function($d,$row) {
          if (!$d) {
            $l = ('0');
          } else {
            $l = $d;
          }
          return $l;
        }
      ),
      array( 'db' => 'views_msc',   'dt' => 5 ),
      array( 'db' => 'is_home',   'dt' => 6,
        'formatter' => function($d,$row) {
          if ($d == 1) {
            $l = ('опубликован');
          } else {
            $l = ('нет');
          }
          return $l;
        }
      ),
      array(
        'db' => 'id',
        'dt' => 7,
        'formatter' => function($d,$row) {
          $l = ('<a href="/access/projects/update?id='.$d.'" class="on-default edit-row"><i class="fa fa-pencil"></i></a><a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>');
          return $l;
        }
      ),
    );
    $where = "1";
    echo json_encode(
      SSP::simple( $_GET, 'Projects', 'id', $columns, $where  )
    );
  }
}
