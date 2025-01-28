<?php

namespace app\modules\access\controllers;

use app\models\FilterCat;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class Filter_prController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new FilterCat();
        if (!empty($_POST['name']))
        {
            $model->position = 0;
            $model->name = $_POST['name'];
            if($model->save()) {
                $i=1;
                foreach (FilterCat::find()->orderBy(['position'=>SORT_ASC])->all() as $recort)
                {
                    $recort->position = $i;
                    $recort->save();
                    $i++;
                }
                return json_encode(['status'=>'ok','id'=>$model->id,'pos'=>$model->position]);
            }
        }
        return json_encode(['status'=>'error']);
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

    /**
     * Updates an existing Country model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUpdate()
    {
        if (!empty($_POST['id']))
        {
            $model = $this->findModel($_POST['id']);
            $model->name = $_POST['name'];
            if($model->save()) {
                $i=1;
                foreach (FilterCat::find()->orderBy(['position'=>SORT_ASC])->all() as $recort)
                {
                    $recort->position = $i;
                    $recort->save();
                    $i++;
                }
                return json_encode(['status'=>'ok']);
            }
        }
        return json_encode(['status'=>'error']);
    }

    public function actionUp($id)
    {
        $active = $this->findModel($id);
        if(!empty($active))
        {
            $model = FilterCat::find()->where('position < '.$active->position)->orderBy(['position'=>SORT_DESC])->one();
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
            $model = FilterCat::find()->where('position > '.$active->position)->orderBy(['position'=>SORT_ASC])->one();
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
     * Deletes an existing Materials model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionDelete()
    {
        if($this->findModel($_POST['id'])->delete())
            return json_encode(['status'=>'ok']);
        else
            return json_encode(['status'=>'error']);
    }

    /**
     * Finds the Country model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FilterCat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FilterCat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
