<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Adv_settings".
 *
 * @property integer $id
 * @property string $filter_top_banner
 * @property string $filter_bottom_banner
 * @property string $card_banner
 */
class AdvSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Adv_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filter_top_banner','filter_bottom_banner','card_banner'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID'
        ];
    }
}
