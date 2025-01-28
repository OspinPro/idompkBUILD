<?php

namespace app\modules\catalog;

use yii\helpers\Url;

class catalog extends \yii\base\Module
{
  public $controllerNamespace = 'app\modules\catalog\controllers';

  public function init()
  {
    parent::init();
    return true;
  }
}