<?php

namespace app\modules\access\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        //return $this->render('index');
      return $this->redirect("/access/projects/index");
    }
}
