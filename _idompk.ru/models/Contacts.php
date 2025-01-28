<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Contacts".
 *
 * @property integer $id
 * @property string $footer
 * @property string $c_email
 * @property string $c_adress
 * @property string $c_phone_1
 * @property string $c_phone_2
 * @property string $c_work_time
 * @property string $c_company_name
 * @property string $c_company_slogan
 * @property string $c_company_coordinate
 * @property string $c_soc_vk
 * @property string $c_soc_fb
 * @property string $c_soc_inst
 * @property string $c_common_address
 */
class Contacts extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'Contacts';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['footer', 'c_email', 'c_adress', 'c_phone_1', 'c_phone_2', 'c_work_time', 'c_company_name', 'c_company_slogan', 'c_company_coordinate', 'c_soc_vk', 'c_soc_fb', 'c_soc_inst', 'c_common_address'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'footer' => 'Подвал сайта',
      'c_email' => 'E-mail компании',
      'c_adress' => 'Почтовый адрес',
      'c_phone_1' => 'Телефон (МСК)',
      'c_phone_2' => 'Телефон (8-800)',
      'c_work_time' => 'Время работы',
      'c_company_name' => 'Название компании',
      'c_company_slogan' => 'Краткое описание компании',
      'c_company_coordinate' => 'Yandex координаты',
      'c_soc_vk' => 'Ссылка на Vkontakte',
      'c_soc_fb' => 'Ссылка на Facebook',
      'c_soc_inst' => 'Ссылка на Instagram',
        'c_common_address' => 'Основной адрес'
    ];
  }
}
