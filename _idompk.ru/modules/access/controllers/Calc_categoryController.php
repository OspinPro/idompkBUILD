<?php

namespace app\modules\access\controllers;

use app\models\CalcCategories;
use app\models\CalcConfigPrice;
use http\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class Calc_categoryController extends Controller
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
    public function actionIndex($category_id=null)
    {
        if(!$category_id)
        {
            $models = CalcCategories::find()->orderBy(['position' => SORT_ASC])->andWhere(['parent_id' => 0]);
            $floor_id = \Yii::$app->request->get('floor_id', null);

            if($floor_id)
                $models->andWhere(['floor_id' => $floor_id]);

            $models = $models->all();
        }
        else
            $models = CalcCategories::find()->andWhere(['parent_id' => $category_id])->all();

        return $this->render('index', ['models' => $models, 'category_id' => $category_id]);
    }

    public function actionSettings()
    {
        $config = CalcConfigPrice::find()->indexBy('param')->all();

        if(\Yii::$app->request->isPost)
        {
            foreach ($_POST as $key => $value)
            {
                if(!in_array($key, array_keys($config)))
                    continue;

                $config[$key]->value = $value;
                $config[$key]->save();
            }

            \Yii::$app->session->setFlash('status', 'Успешно сохранено!');
            return $this->redirect(['/access/calc_category/settings']);
        }

        return $this->render('settings', ['config' => $config]);
    }

    public function actionCreate()
    {
        $model = new CalcCategories();

        $add_red = '';
        $category_id = \Yii::$app->request->get('category_id');
        if($category_id)
        {
            $add_red = '?category_id='.$category_id;
            $model->parent_id = $category_id;
        }


        if ($model->load(\Yii::$app->request->post()))
        {
            if ($model->save())
            {
                \Yii::$app->session->setFlash('status', 'Запись успешно добавлена!');
                return $this->redirect(['/access/calc_category'.$add_red]);
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
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
     * Updates an existing Country model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(\Yii::$app->request->post()))
        {
            if ($model->save()) {
                \Yii::$app->session->setFlash('status','Запись успешно изменена!');
                return $this->redirect(['/access/calc_category']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUp($id)
    {
        $active = $this->findModel($id);
        $parent_id = \Yii::$app->request->get('category_id', 0);
        if(!empty($active))
        {
            $model = CalcCategories::find()->andWhere('position < '.$active->position);
            if(!empty($parent_id))
                $model = $model->andWhere(['parent_id' => $parent_id]);
            else
                $model = $model->andWhere(['parent_id' => 0]);
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
            $model = CalcCategories::find()->where('position > '.$active->position);
            if(!empty($parent_id))
                $model = $model->andWhere(['parent_id' => $parent_id]);
            else
                $model = $model->andWhere(['parent_id' => 0]);
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
     * @return CalcCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CalcCategories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
