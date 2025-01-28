<?php

namespace app\modules\catalog\controllers;

use yii\web\Controller;

class VseKategoriiController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
