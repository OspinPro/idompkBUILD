<?php

  namespace app\models;

  use Yii;

  /**
   * This is the model class for table "Translate".
   *
   * @property integer $id
   * @property string $lang
   * @property string $word
   * @property string $translate
   */
  class T extends \yii\db\ActiveRecord
  {
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
      return 'Translate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
      return [
        [['lang', 'word', 'translate'], 'required'],
        [['lang'], 'string', 'max' => 10],
        [['word', 'translate'], 'safe']
      ];
    }

    public static function t($word)
    {
      $row = self::find()->where(['lang'=>Yii::$app->language,'word'=>$word])->select('translate')->asArray()->one();
      if(!empty($row['translate']))
        return $row['translate'];
      else
        return $word;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
      return [
        'id' => 'ID',
        'lang' => 'Lang',
        'word' => 'Word',
        'translate' => 'Translate',
      ];
    }
  }