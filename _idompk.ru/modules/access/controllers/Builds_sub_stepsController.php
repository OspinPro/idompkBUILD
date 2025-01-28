<?php

namespace app\modules\access\controllers;

use app\models\BuildsSubSteps;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class Builds_sub_stepsController extends Controller
{

    public function actionIndex()
    {
        $models = BuildsSubSteps::find()->all();
        return $this->render('index',['models'=>$models]);
    }

    public function actionCreate()
    {
        $model = new BuildsSubSteps();
      $model->position = 0;

      $allImg = UploadedFile::getInstances($model, 'image');
      $image = array();


      foreach($allImg as $Record)
      {
        $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
        $Record->saveAs('img/uploads/other/temp/' . $NewName);
        copy('img/uploads/other/temp/' . $NewName,'img/uploads/other/original/' . $NewName);
        $image[] = $NewName;
        BuildsSubSteps::CreateStamp('img/uploads/projects/stamp.png','img/uploads/other/original/' . $NewName);
        BuildsSubSteps::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/thumb/' . $NewName,370,270);
        BuildsSubSteps::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/medium/' . $NewName,880,540);
      }
      if(count($image)>0)
        $model->image = serialize($image);

        if ($model->load(\Yii::$app->request->post())) {


            if ($model->save()) {

              $i=1;
              foreach (BuildsSubSteps::find()->orderBy(['position'=>SORT_ASC])->all() as $recort)
              {
                $recort->position = $i;
                $recort->save();
                $i++;
              }

                \Yii::$app->session->setFlash('status','Запись успешно добавлена!');
                return $this->redirect(['/access/builds_sub_steps']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

  public function actionReposition()
  {
    foreach ($_POST['mass2'] as $key=>$value)
    {
      if(((int)$value)==0)
        return json_encode(['status'=>'error']);
    }

    foreach ($_POST['mass2'] as $key=>$value)
    {
      $rec = $this->findModel($_POST['mass'][$key]);
      $rec->position = $value;
      $rec->save(false);
    }

    return json_encode(['status'=>'ok']);
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
            BuildsSubSteps::CreateStamp('img/uploads/projects/stamp.png','img/uploads/other/original/' . $NewName);
            BuildsSubSteps::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/thumb/' . $NewName,370,270);
            BuildsSubSteps::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/medium/' . $NewName,880,540);
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
              $i=1;
              foreach (BuildsSubSteps::find()->orderBy(['position'=>SORT_ASC])->all() as $recort)
              {
                $recort->position = $i;
                $recort->save();
                $i++;
              }
                \Yii::$app->session->setFlash('status','Запись успешно изменена!');
                return $this->redirect(['/access/builds_sub_steps']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

  public function actionUp($id)
  {
    $active = $this->findModel($id);
    if(!empty($active))
    {
      $model = BuildsSubSteps::find()->where('position < '.$active->position)->orderBy(['position'=>SORT_DESC])->one();
      if(!empty($model))
      {
        $temp = $active->position;
        $active->position = $model->position;
        $active->save(false);

        $model->position = $temp;
        $model->save(false);

        \Yii::$app->session->setFlash('status','Запись успешно перемещена!');
      }
    }
    return $this->redirect('index');
  }

  public function actionDown($id)
  {
    $active = $this->findModel($id);
    if(!empty($active))
    {
      $model = BuildsSubSteps::find()->where('position > '.$active->position)->orderBy(['position'=>SORT_ASC])->one();
      if(!empty($model))
      {
        $temp = $active->position;
        $active->position = $model->position;
        $active->save(false);

        $model->position = $temp;
        $model->save(false);

        \Yii::$app->session->setFlash('status','Запись успешно перемещена!');
      }
    }
    return $this->redirect('index');
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
     * @return BuildsSubSteps the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BuildsSubSteps::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
