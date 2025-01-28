<?php

namespace app\modules\access\controllers;

use app\models\LoginForm;
use app\models\Projects;
use yii\web\Controller;

class LoginController extends Controller
{
    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect("/access/projects/index");
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->redirect("/access/projects/index");
        }

        return $this->render('/default/login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->redirect("/access");
    }
}
