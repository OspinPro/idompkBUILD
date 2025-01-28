<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings_contacts".
 *
 * @property integer $id
 * @property integer $city_id
 * @property integer $country_id
 * @property string $name
 * @property string $value
 *
 * @property Countries $country
 * @property Cities $city
 */
class SettingsContacts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings_contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'country_id', 'name', 'value'], 'safe']
        ];
    }

    public static function getGeoSettings()
    {
        /**
         * @var self[] $all
         */
        $all = self::find()->andWhere('country_id is not null or city_id is not null')->all();

        $countries = [];
        $cities = [];

        foreach ($all as $el)
        {
            if(!empty($el->country_id))
            {
                if (!isset($countries[$el->country_id]))
                {
                    $countries[$el->country_id] = [];
                }

                $countries[$el->country_id][$el->name] = $el->value;
            }
            else if(!empty($el->city_id))
            {
                if (!isset($cities[$el->city_id]))
                {
                    $cities[$el->city_id] = [];
                }

                $cities[$el->city_id][$el->name] = $el->value;
            }
        }

        return [$countries, $cities];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
            'city_id' => 'Город',
            'country_id' => 'Страна'
        ];
    }

    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }
}
