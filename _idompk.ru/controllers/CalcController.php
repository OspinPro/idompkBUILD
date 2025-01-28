<?php

namespace app\controllers;

use app\models\CalcCategories;
use app\models\CalcFloors;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CalcController extends Controller
{
    public function actionIndex()
    {
        if(\Yii::$app->request->pathInfo != 'kalkulyator-stroitelstva-doma')
            throw new NotFoundHttpException();

        $floors = CalcFloors::find()->orderBy(['position' => SORT_ASC])->all();
        $stages = CalcCategories::getTree();

        return $this->render('index', ['stages' => $stages, 'floors' => $floors]);
    }
}