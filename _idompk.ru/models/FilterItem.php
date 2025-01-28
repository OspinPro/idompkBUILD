<?php

namespace app\models;
use corpsepk\yml\behaviors\YmlCategoryBehavior;
use Yii;

/**
 * This is the model class for table "Filter_item".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string $text2
 * @property integer $st_pr_ot
 * @property integer $st_pr_do
 * @property integer $st_st_ot
 * @property integer $st_st_do
 * @property integer $style_pr
 * @property integer $material
 * @property integer $pogreb
 * @property string $eta
 * @property integer $cokol
 * @property integer $is_popular
 * @property integer $is_new
 * @property integer $spalni
 * @property integer $zanuzel
 * @property string $erker
 * @property string $garaj
 * @property integer $area_ot
 * @property integer $area_do
 * @property integer $sale_ot
 * @property integer $sale_do
 * @property string $dop
 * @property string $dopInfo
 * @property integer $cat_id
 * @property integer $is_show_page_project
 * @property integer $is_show_page_home
 *
 * @property integer $cenoj
 */
class FilterItem extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'Filter_item';
  }


    public function behaviors()
    {
        return [
            'ymlCategory' => [
                'class' => YmlCategoryBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select(['id', 'name'])->andWhere('id != 658');
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    if($model->id == 2)
                    {
                        $model->id = 1;
                        $model->name = 'Проекты';
                    }

                    return [
                        'id' => $model->id,
                        'name' => $model->name,
                        'parentId' => 0
                    ];
                }
            ],
        ];
    }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['text', 'text2', 'title', 'description',  'dop','dopInfo','url'], 'string'],
      [['st_pr_ot', 'st_pr_do', 'st_st_ot', 'st_st_do', 'style_pr', 'material', 'cokol', 'is_popular', 'is_new', 'spalni', 'zanuzel', 'area_ot', 'area_do', 'sale_ot', 'sale_do', 'cat_id','mansard','pogreb','gb_s_ot','gb_s_do','gb_d_ot','gb_d_do'], 'integer'],
      [['cat_id'], 'required'],
      [['name','eta', 'garaj', 'erker'], 'string'],
      [['is_show','is_show_filter','townhouse_s', 'is_show_page_project', 'is_show_page_home', 'cenoj'],'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'name' => 'Название',
      'text' => 'Текст сверху страницы',
      'text2' => 'Текст под проектами',
      'title' => 'title',
      'description' => 'Description',
      'st_pr_ot' => 'Стоимость проекта min',
      'st_pr_do' => 'Стоимость проекта max',
      'st_st_ot' => 'Стоимость строительства min',
      'st_st_do' => 'Стоимость строительства max',
      'style_pr' => 'Стиль',
      'material' => 'Материал',
      'eta' => 'Этажность',
      'cokol' => 'Цокольный этаж',
      'spalni' => 'Спальни',
      'area_ot' => 'Площадь дома min',
      'area_do' => 'Площадь дома max',
      'dop' => 'Дополнительно',
      'cat_id' => 'Cat ID',
      'mansard' => 'Мансарда',
      'is_show' => 'Скрыть в меню сайта',
      'is_show_filter' => 'Скрыть в фильтрах на страницах',
      'townhouse_s' => 'Тип дома',
        'is_show_page_project' => 'Показывать на странице проекта',
        'is_show_page_home' => 'Показывать на главной странице',
        'cenoj' => 'С ценой на строительство',
      'gb_s_ot'=>'gb_s_ot',
      'gb_s_do'=>'gb_s_do',
      'gb_d_ot'=>'gb_d_ot',
      'gb_d_do'=>'gb_d_do',
    ];
  }

  public static function get_by_pr($rec)
  {
    $arr_sr = ['style_pr','material','cokol','townhouse_s','is_new','is_popular','pogreb'];

    foreach (\app\models\FilterItem::find()->andWhere(['is_show_page_project' => 1])->asArray()->all() as $filter)
    {
      $filter['dop'] = explode(',',$filter['dop']);
      $filter['dopInfo'] = explode(',',$filter['dopInfo']);
      if($filter['eta'])
        $filter['eta'] = explode(',',$filter['eta']);
      if($filter['erker'])
        $filter['erker'] = explode(',',$filter['erker']);
      if($filter['garaj'])
        $filter['garaj'] = explode(',',$filter['garaj']);
      if($filter['spalni'])
      {
        $spalni = $filter['spalni'];
        unset($filter['spalni']);
        $filter['spalni'][] = $spalni;
      }
      if($filter['zanuzel'])
      {
        $zanuzel = $filter['zanuzel'];
        unset($filter['zanuzel']);
        $filter['zanuzel'][] = $zanuzel;
      }
      $filter['id_roj'] = $rec['id'];

      $projects = Projects::Get_projects(20,$filter);

      if($projects)
        $arr[] = '<a class="text-green" href="/catalog/proekty-domov/'.$filter['url'].'">'.$filter['name'].'</a>';
    }

    return $arr;
  }
}
