<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calc_catrgories".
 *
 * @property integer $id
 * @property integer $floor_id
 * @property integer $parent_id
 * @property string $name
 * @property string $is_fundament
 * @property float $is_cokol
 * @property int $position
 *
 * @property CalcCategories $parent
 * @property CalcFloors $floor
 */
class CalcCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calc_categories';
    }

    public function beforeSave($insert)
    {
        if($this->parent_id === null || $this->parent_id == '')
            $this->parent_id = 0;

        if($this->position === null || $this->position == '')
            $this->position = 0;

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['floor_id', 'parent_id', 'name', 'is_fundament', 'is_cokol', 'position'], 'safe']
        ];
    }

    public static function getTree()
    {
        /** @var self[] $categories */
        $categories = self::find()->orderBy(['position' => SORT_ASC])->all();
        $result = [];

        foreach ($categories as $category)
        {
            if($category->parent_id == 0)
            {
                $result[$category->id] = ['parent' => $category, 'childs' => []];
            }
        }

        foreach ($categories as $category)
        {
            if($category->parent_id !=0)
            {
                array_push($result[$category->parent_id]['childs'], $category);
            }
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'floor_id' => 'Floor ID',
            'parent_id' => 'Parent',
            'name' => 'Name',
            'is_fundament' => 'Fundament',
            'is_cokol' => 'Cokol',
        ];
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    public function getFloor()
    {
        return $this->hasOne(CalcFloors::className(), ['id' => 'floor_id']);
    }
}
