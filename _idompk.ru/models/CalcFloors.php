<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calc_floors".
 *
 * @property integer $id
 * @property string $name
 * @property string $sh
 * @property float $fl
 * @property int $position
 *
 */
class CalcFloors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calc_floors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sh', 'fl', 'position'], 'safe']
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
            'sh' => 'Sh',
            'fl' => 'Fl',
        ];
    }
}
