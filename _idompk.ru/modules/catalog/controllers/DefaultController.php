<?php

namespace app\modules\catalog\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
      return $this->redirect('/catalog/proekty-domov',301);
    }
}
