<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calc_items".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property float $price_kvm
 * @property string $img
 * @property int $position
 *
 * @property CalcCategories $category
 */
class CalcItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calc_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'price_kvm', 'img', 'position'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category',
            'name' => 'Name',
            'price_kvm' => 'Price per 1kvm',
            'img' => 'Img',
        ];
    }

    public static function getByCategory($category_id)
    {
        return self::find()->andWhere(['category_id' => $category_id])->orderBy(['position' => SORT_ASC])->all();
    }

    public function getCategory()
    {
        return $this->hasOne(CalcCategories::className(), ['id' => 'category_id']);
    }
}
