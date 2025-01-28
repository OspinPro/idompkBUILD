<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Sostav_item".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 */
class SostavItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Sostav_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
          'name' => 'Имя',
          'text' => 'Text',
        ];
    }
}
