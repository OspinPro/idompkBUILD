<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property integer $id
 * @property string $iso
 * @property string $name
 */
class Countries extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'countries';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['name','iso'], 'safe']
    ];
  }

  public function getCities() {
      return Cities::find()->andWhere(['country_id' => $this->id])->all();
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
    ];
  }
}
