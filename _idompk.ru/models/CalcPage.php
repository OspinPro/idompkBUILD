<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calc_page".
 *
 * @property integer $id
 * @property string $title
 * @property string $meta_description
 * @property string $content
 * @property string $text2
 * @property int $sh_cokol
 */
class CalcPage extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'calc_page';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['title', 'meta_description', 'content', 'text2', 'sh_cokol'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'title' => 'Title',
      'meta_description' => 'Meta Description',
      'content' => 'Content',
        'text2' => 'Text 2',
        'sh_cokol' => 'SH Cokol'
    ];
  }
}
