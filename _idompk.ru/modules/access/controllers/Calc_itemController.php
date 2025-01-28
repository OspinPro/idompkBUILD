<?php

namespace app\modules\access\controllers;

use app\models\CalcCategories;
use app\models\CalcItems;
use app\models\HomePageItem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class Calc_itemController extends Controller
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
    public function actionIndex($category_id)
    {
        $items = CalcItems::find()->andWhere(['category_id' => $category_id])->all();
        $category = CalcCategories::find()->andWhere(['id' => $category_id])->one();

        return $this->render('index', ['models' => $items, 'category' => $category, 'category_id' => $category_id]);
    }

    public function actionCreate()
    {
        $model = new CalcItems();
        $category_id = \Yii::$app->request->get('category_id', 0);
        $category = CalcCategories::find()->andWhere(['id' => $category_id])->one();

        if ($model->load(\Yii::$app->request->post()))
        {

            $allImg = UploadedFile::getInstances($model, 'img');
            $image = null;

            foreach($allImg as $Record)
            {
                $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
                $Record->saveAs('img/uploads/other/temp/' . $NewName);
                copy('img/uploads/other/temp/' . $NewName,'img/uploads/other/original/' . $NewName);
                $image[] = $NewName;
                HomePageItem::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/thumb/' . $NewName,370,270);
                HomePageItem::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/medium/' . $NewName,880,540);
            }

            if($image)
                $model->img = serialize($image);

            if ($model->save())
            {
                \Yii::$app->session->setFlash('status', 'Запись успешно добавлена!');
                return $this->redirect(['/access/calc_item', 'category_id' => $model->category_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'category' => $category,
            'category_id' => $category_id
        ]);
    }


    /**
     * Updates an existing Country model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $category_id = \Yii::$app->request->get('category_id', 0);
        $category = CalcCategories::find()->andWhere(['id' => $category_id])->one();

        if ($model->load(\Yii::$app->request->post()))
        {
            $allImg = UploadedFile::getInstances($model, 'img');
            $image = array();

            foreach($allImg as $Record)
            {
                $NewName = time().'-'.mt_rand() . '.' . $Record->extension;
                $Record->saveAs('img/uploads/other/temp/' . $NewName);
                copy('img/uploads/other/temp/' . $NewName,'img/uploads/other/original/' . $NewName);
                $image[] = $NewName;
                HomePageItem::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/thumb/' . $NewName,370,270);
                HomePageItem::img_resize('img/uploads/other/original/' . $NewName,'img/uploads/other/medium/' . $NewName,880,540);
            }
            if(count($image)>0) {
                $model->img = serialize($image);

                $allImgD = unserialize($model->oldAttributes['img']);
                foreach ($allImgD as $RecordD) {
                    unlink('img/uploads/other/temp/' . $RecordD);
                    unlink('img/uploads/other/thumb/' . $RecordD);
                    unlink('img/uploads/other/medium/' . $RecordD);
                    unlink('img/uploads/other/original/' . $RecordD);
                }

            } else {
                $model->img = $model->oldAttributes['img'];
            }


            if ($model->save()) {
                \Yii::$app->session->setFlash('status','Запись успешно изменена!');
                return $this->redirect(['/access/calc_item', 'category_id' => $model->category_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'category' => $category,
            'category_id' => $category_id
        ]);
    }


    public function actionUp($id)
    {
        $active = $this->findModel($id);
        $parent_id = \Yii::$app->request->get('category_id', 0);
        if(!empty($active))
        {
            $model = CalcItems::find()->andWhere('position < '.$active->position);
            if(!empty($parent_id))
                $model = $model->andWhere(['category_id' => $parent_id]);

            $model = $model->orderBy(['position'=>SORT_DESC])->one();

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

        if(!empty($parent_id))
            return $this->redirect(['index','category_id' =>$parent_id]);
        else
            return $this->redirect('index');
    }

    public function actionDown($id)
    {
        $active = $this->findModel($id);
        $parent_id = \Yii::$app->request->get('category_id', 0);
        if(!empty($active))
        {
            $model = CalcItems::find()->where('position > '.$active->position);
            if(!empty($parent_id))
                $model = $model->andWhere(['category_id' => $parent_id]);
            $model = $model->orderBy(['position'=>SORT_ASC])->one();

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
        if(!empty($parent_id))
            return $this->redirect(['index','category_id' =>$parent_id]);
        else
            return $this->redirect('index');
    }

    public function actionReposition()
    {
        $parent_id = \Yii::$app->request->get('category_id', 0);

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
     * @return CalcItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CalcItems::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
