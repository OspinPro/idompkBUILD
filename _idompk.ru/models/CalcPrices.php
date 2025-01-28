<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calc_prices".
 *
 * @property integer $id
 * @property string $name
 * @property string $param
 * @property float $price
 */
class CalcPrices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calc_prices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'param', 'name', 'price'], 'safe']
        ];
    }

    public static function getGeoPrices()
    {
        /**
         * @var self[] $all
         */
        $all = self::find()->all();

        $prices = [];

        foreach ($all as $el)
        {



          $prices[$el->param] = $el->price;

        }

        return $prices;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'param' => 'Param',
        ];
    }

}
