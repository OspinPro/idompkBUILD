<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Home_page_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property int $url
 */
class HomePageCategory extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'Home_page_category';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['name', 'image', 'url'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'name' => 'Контент над блоком с видео',
        'image' => 'Изображение'
    ];
  }
}
