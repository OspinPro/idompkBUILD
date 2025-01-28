<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calc_config_price".
 *
 * @property integer $id
 * @property string $param
 * @property string $value
 *
 */
class CalcConfigPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calc_config_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param', 'value'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'param' => 'Param',
            'value' => 'Value',
        ];
    }
}
