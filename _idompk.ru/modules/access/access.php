<?php

namespace app\modules\access;

use yii\helpers\Url;

class access extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\access\controllers';

    public function init()
    {
        parent::init();

        if (\Yii::$app->user->isGuest && Url::to('@web')!="/access/login") {
            return \Yii::$app->getResponse()->redirect('/access/login');
        }
        else
            return true;
    }
}