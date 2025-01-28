<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Home_page".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $text_1
 * @property string $text_2
 * @property string $text_3
 * @property string $h1
 */
class HomePage extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'Home_page';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['title',  'description', 'text_1', 'text_2', 'text_3', 'block_articles','h1'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'h1' => 'h1',
      'title' => 'Title',
      'description' => 'Description',
      'text_1' => 'Контент над блоком с видео',
      'block_articles' => 'Блок статей',
      'text_2' => 'Контент внизу страницы',
        'text_3' => 'Контент для блока с фильтром',
    ];
  }
}
