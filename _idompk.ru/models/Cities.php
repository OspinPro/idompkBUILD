<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $iso
 * @property string $name
 *
 * @property Countries $country
 */
class Cities extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'cities';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['name','iso','country_id'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
        'name' => 'Name',
        'iso' => 'Iso',
        'country_id' => 'Страна'
    ];
  }

  public function getCountry()
  {
      return $this->hasOne(Countries::className(), ['id' => 'country_id']);
  }
}
