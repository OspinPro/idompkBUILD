<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Proj_settings".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string $text2
 * @property string $panel_2
 * @property string $panel_3
 * @property string $procentAll
 * @property string $currencyIndex
 * @property string $currencySymbol
 */
class ProjSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Proj_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['panel_2',  'panel_3', 'text', 'text2', 'title', 'description', 'title_s', 'description_s','text_price','text2_price','procentAll','currencyIndex','currencySymbol'], 'safe'],
            [['podsk'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'title',
            'description' => 'Description',
            'title_s' => 'title (в ценой)',
            'description_s' => 'Description (в ценой)',
          'text' => 'Текст сверху страницы',
            'text2' => 'Текст под проектами',
            'podsk' => 'Доп., текст под ценой проекта',
            'text_price' => 'Текст сверху (с ценой)',
            'text2_price' => 'Текст под проектами (с ценой)',
        ];
    }
}
