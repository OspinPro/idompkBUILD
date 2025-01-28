<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
//    'css/slick.css',
//    'css/style-2.0.css',
//    'css/style-3.0.css',
    'css/style-4.0.css'
  ];
  public $js = [
  ];
  public $depends = [
    'yii\web\YiiAsset',
  ];

  public $jsOptions = ['position' => View::POS_HEAD];
}
