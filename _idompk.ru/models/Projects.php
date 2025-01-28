<?php

namespace app\models;

use corpsepk\yml\behaviors\YmlOfferBehavior;
use corpsepk\yml\models\Offer;
use Yii;
use yii\helpers\FileHelper;
use yii\web\Session;

/**
 * This is the model class for table "Projects".
 *
 * @property integer $id
 * @property integer $is_have
 * @property string $num_pr
 * @property string $builds
 * @property string $original_num_pr
 * @property string $desc_material
 * @property string $style_pr
 * @property integer $dop
 * @property integer $dopInfo
 * @property integer $area
 * @property string $razd_pr
 * @property integer $material
 * @property integer $priority
 * @property integer $sostav
 * @property string $shirina_doma
 * @property string $dlina_doma
 * @property integer $count_et
 * @property integer $spalen
 * @property integer $garaj
 * @property integer $erker
 * @property string $is_sale
 * @property string $fundament
 * @property string $perekrytija
 * @property string $krysha
 * @property string $krovlja
 * @property string $fasad
 * @property string $price_pr
 * @property string $prcie_ps
 * @property string $price_copy
 * @property string $prcie_all
 * @property string $price_vznos
 * @property string $perekrytie_fundamenta
 * @property string $steny_vneh
 * @property string $steny_vnut
 * @property string $precr_1
 * @property string $cherd_per
 * @property string $strip_sys
 * @property string $mat_crovl
 * @property string $naruzhnaja_otdelka
 * @property string $is_zerkal
 * @property string $is_new
 * @property integer $is_slider
 * @property integer $is_home
 * @property string $is_popular
 * @property string $images
 * @property string $images_plan
 * @property string $image_slider
 * @property string $h1
 * @property string $title
 * @property string $description
 * @property string $build_info
 * @property string $dop_info
 * @property integer $views_msc
 */
class Projects extends \yii\db\ActiveRecord
{
    public $linked_projects;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Projects';
    }

    public function behaviors()
    {
        return [
            'ymlOffer' => [
                'class' => YmlOfferBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    //$model->limit(10);
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    $paramsArray = $model->generateParams();

                    foreach ($paramsArray as $i => $p) {
                        if (empty($p['value']))
                            unset($paramsArray[$i]);
                    }

                    if (empty($paramsArray))
                        $paramsArray = null;


                    return new Offer([
                        'id' => $model->id,
                        'url' => 'https://idompk.ru/catalog/proekty-domov/' . $model->num_pr,
                        'price' => $model->price_pr,
                        'currencyId' => 'RUR',
                        'categoryId' => 1,
                        'downloadable' => true,
                        'picture' => $model->ymlImages(),
                        'name' => 'test',
                        'vendor' => null,
                        'description' => $model->description,
                        'param' => $paramsArray
                    ]);
                }
            ],
        ];
    }

    public function generateParams()
    {

        $text_ett = '';
        if ($this->cokol && $this->mansard)
            $text_ett = '+ Мансардный + Цокольный';
        else if ($this->pogreb && $this->mansard)
            $text_ett = '+ Мансардный + Погреб';
        else if ($this->cokol)
            $text_ett = '+ Цокольный';
        else if ($this->mansard)
            $text_ett = '+ Мансардный';
        else if ($this->pogreb)
            $text_ett = '+ Погреб';

        return [
            ['name' => 'Полезная площадь', 'value' => $this->area],
            ['name' => 'Террасы и балконы', 'value' => $this->area_tb],
            ['name' => 'Количество автомест', 'value' => $this->garaj],
            ['name' => 'Количество спален', 'value' => $this->spalen],
            ['name' => 'Количество санузлов', 'value' => $this->zanuzel],
            ['name' => 'Этажность', 'value' => $this->count_et . $text_ett],
            ['name' => 'Габариты', 'value' => $this->shirina_doma . ' x ' . $this->dlina_doma . ' м'],
            ['name' => 'Фундамент', 'value' => $this->fundament],
            ['name' => 'Материал стен', 'value' => $this->desc_material],
            ['name' => 'Перекрытия', 'value' => $this->perekrytija],
            ['name' => 'Тип крыши', 'value' => $this->krysha],
            ['name' => 'Кровельный материал', 'value' => $this->krovlja],
            ['name' => 'Наружная отделка', 'value' => $this->fasad],
            //['name' => 'Архитектурный стиль', 'value' => $this->desc_material],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area', 'material', 'count_et', 'spalen', 'views_msc'], 'integer'],
            [['num_pr', 'original_num_pr', 'razd_pr', 'shirina_doma', 'dlina_doma', 'fundament', 'perekrytija', 'krysha', 'krovlja', 'fasad', 'price_pr', 'prcie_ps', 'price_copy', 'prcie_all', 'price_vznos', 'strip_sys'], 'string', 'max' => 255],
            [['is_zerkal'], 'string', 'max' => 11],
            [['dop', 'dopInfo', 'cokol', 'mansard', 'priority', 'sostav', 'ovk', 'pogreb', 'desc_material', 'style_pr', 'images', 'images_plan', 'image_slider', 'h1', 'title', 'description', 'townhouse_s', 'dop_info', 'is_have', 'is_popular', 'is_sale', 'is_home',
                'build_info',
                'builds',
                'is_new', 'is_slider', 'erker', 'garaj', 'zanuzel', 'area_tb', 'price_pdf', 'price_uchastok', 'price_enginer'], 'safe']
        ];
    }

    public function ymlImages()
    {
        $arr = [];
        $max = 10;
        $i = 0;
        foreach (unserialize($this->images) as $img) {
            if ($i >= $max)
                break;
            $arr[] = 'https://idompk.ru/img/uploads/projects/original/' . $img;
            $i++;
        }

        return $arr;
    }

    public function afterFind()
    {
        parent::afterFind();
    }

    public function loadLinked()
    {
        $this->linked_projects = ProjectLinks::getLinks($this->id);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]|self[]
     */
    public function getModifications()
    {
        $links = ProjectLinks::getLinks($this->id, true);

        if (!$links)
            return null;

        return self::find()->andWhere(['id' => $links])->all();
    }

    public function getFloors()
    {
        $text_ett = '';
        if ($this->cokol && $this->mansard)
            $text_ett = '+М+Ц';
        else if ($this->pogreb && $this->mansard)
            $text_ett = '+М+П';
        else if ($this->cokol)
            $text_ett = '+Ц';
        else if ($this->mansard)
            $text_ett = '+М';
        else if ($this->pogreb)
            $text_ett = '+П';

        return $this->count_et . '' . $text_ett;
    }

    public function getCars()
    {
        $text_garaj = '';
        if ($this->garaj == 1) {
            $text_garaj = '1';
        } else if ($this->garaj == 2) {
            $text_garaj = '2';
        } else if ($this->garaj == 3) {
            $text_garaj = '3';
        } else if ($this->garaj == 4) {
            $text_garaj = '4';
        } else if ($this->garaj > 4) {
            $text_garaj = '5+';
        }

        if ($text_garaj == '') {
            $text_garaj = 'Нет';
        }

        return $text_garaj;
    }

    public static function getForSlider()
    {
        $sort = ['priority' => SORT_ASC, 'id' => SORT_DESC];

        return self::find()->andWhere(['is_slider' => 1])->orderBy($sort)->all();
    }

    public static function Get_projects($limit = 20, $filter = false, $only_count = false)
    {

//        var_dump(Yii::$app->session['projects_'.$name_filter]);
//        exit(1);

        $name_filter = (!empty(\Yii::$app->params['name_filter'])) ? \Yii::$app->params['name_filter'] : '';

        $count = 0;
        $sort = ['priority' => SORT_ASC, 'id' => SORT_DESC];


        if ($_POST['pr_num']) {
            $projects = Projects::find()
                ->where(['LIKE', 'num_pr', '%'.Yii::$app->request->post('pr_num').'%'])
                ->orderBy($sort)
                ->limit($limit)
                ->asArray()
                ->all();
        } else if (Yii::$app->session['projects_' . $name_filter] || $filter) {

            if (!$filter)
                $filter = unserialize(Yii::$app->session['projects_' . $name_filter]);

            if ($filter['sort'] && $filter['sort']['tp']) {
                if ($filter['sort']['tp'] != 'priority')
                    $sort = [$filter['sort']['tp'] => $filter['sort']['type'] == 'up' ? SORT_ASC : SORT_DESC];
            }


            $projects = self::find()->where('id != 0');


            if ($filter['cenoj'])
                $projects->andWhere('prcie_all > 0');


            if ($filter['st_pr_ot'])
                $projects->andWhere(['>=', 'price_pr', $filter['st_pr_ot']]);
            if ($filter['st_pr_do'])
                $projects->andWhere(['<=', 'price_pr', $filter['st_pr_do']]);


            if ($filter['st_st_ot'])
                $projects->andWhere(['>=', 'prcie_all', $filter['st_st_ot']]);
            if ($filter['st_st_do'])
                $projects->andWhere(['<=', 'prcie_all', $filter['st_st_do']]);


            if ($filter['area_ot'])
                $projects->andWhere(['>=', 'area', $filter['area_ot']]);
            if ($filter['area_do'])
                $projects->andWhere(['<=', 'area', $filter['area_do']]);



            if ($filter['townhouse_s'])
                $projects->andWhere('townhouse_s = ' . $filter['townhouse_s']);


            if (count($filter['dop']) > 0) {
                foreach ($filter['dop'] as $dop) {
                    if ($dop) {
                        $projects->andWhere(['LIKE', 'dop', '-' . $dop . '-']);
                        /*if ($dop == 22) {
                          $projects->orWhere(['LIKE', 'dop', '-4-']);
                        }*/
                    }

                }
            }



            if (count($filter['dopInfo']) > 0) {
                foreach ($filter['dopInfo'] as $dopInfo) {
                    if ($dopInfo) {
                        $projects->andWhere(['LIKE', 'dopInfo', '-' . $dopInfo . '-']);
                    }

                }
            }



            if ($filter['eta']) {
                $i = 0;
                $cc = '';
                foreach ($filter['eta'] as $spl) {


                    $spl[0] = (int)$spl[0];


                    if ($i == 0) {
                        if ($spl >= 10)
                            $cc .= '(count_et = ' . $spl[0] . ' AND mansard = 1)';
                        else
                            $cc .= '(count_et = ' . $spl[0] . ' AND mansard = 0)';
                    } else {
                        if ($spl >= 10)
                            $cc .= 'OR (count_et = ' . $spl[0] . ' AND mansard = 1)';
                        else
                            $cc .= 'OR (count_et = ' . $spl[0] . ' AND mansard = 0)';
                    }
                    $i++;
                }


                if ($i > 0)
                    $projects->andWhere($cc);
            }



            if ($filter['cokol'])
                $projects->andWhere(['cokol' => 1]);

            if ($filter['pogreb'])
                $projects->andWhere(['pogreb' => 1]);

            if ($filter['is_popular'])
                $projects->andWhere(['is_popular' => 1]);

            if ($filter['sale_ot'] || $filter['sale_do'])
                $projects->andFilterWhere(['>', 'is_sale', 0]);
            if ($filter['is_new'])
                $projects->andWhere(['is_new' => 1]);

            if ($filter['spalni']) {
                foreach ($filter['spalni'] as $spl) {
                    if ($spl >= 5)
                        $projects->andWhere(['>=', 'spalen', (int)$spl]);
                    else
                        $projects->andWhere(['=', 'spalen', (int)$spl]);
                }
            }


            if ($filter['zanuzel']) {
                $i = 0;
                $cc = '';
                foreach ($filter['zanuzel'] as $spl) {
                    if ($i == 0)
                        $cc = 'zanuzel = ' . (int)$spl;
                    if ($spl == 5)
                        $cc .= ' OR zanuzel >= ' . (int)$spl;
                    else
                        $cc .= ' OR zanuzel = ' . (int)$spl;
                    $i++;
                }
                if ($i > 0)
                    $projects->andWhere($cc);
            }


            if ($filter['erker']) {
                $i = 0;
                $cc = '';
                foreach ($filter['erker'] as $spl) {
                    if ($i == 0) {
                        if ($spl >= 10)
                            $cc .= '(erker = ' . $spl[0] . ')';
                        else
                            $cc .= '(erker = ' . $spl[0] . ')';
                    } else {
                        if ($spl >= 10)
                            $cc .= 'OR (erker = ' . $spl[0] . ')';
                        else
                            $cc .= 'OR (erker = ' . $spl[0] . ')';
                    }
                    $i++;
                }
                if ($i > 0)
                    $projects->andWhere($cc);
            }


            if ($filter['garaj']) {
                $i = 0;
                $cc = '';
                foreach ($filter['garaj'] as $spl) {
                    if ($i == 0) {
                        if ($spl >= 10)
                            $cc .= '(garaj = ' . $spl[0] . ')';
                        else
                            $cc .= '(garaj = ' . $spl[0] . ')';
                    } else {
                        if ($spl >= 10)
                            $cc .= 'OR (garaj = ' . $spl[0] . ')';
                        else
                            $cc .= 'OR (garaj = ' . $spl[0] . ')';
                    }
                    $i++;
                }
                if ($i > 0)
                    $projects->andWhere($cc);
            }


            if ($filter['style_pr'])
                $projects->andWhere(['style_pr' => $filter['style_pr']]);
            if ($filter['material'])
                $projects->andWhere(['material' => $filter['material']]);


            if (!isset($filter['only_inverse_razmer']))
                $filter['only_inverse_razmer'] = 1;
            if (!isset($filter['only_fact_razmer']))
                $filter['only_fact_razmer'] = 1;


            $all_variants_gb = (empty($filter['only_inverse_razmer']) && empty($filter['only_fact_razmer'])) || (!empty($filter['only_inverse_razmer']) && !empty($filter['only_fact_razmer']));
            $fact_gb = $all_variants_gb;
            $inverse_gb = $all_variants_gb;
            if (!$all_variants_gb) {
                if (!empty($filter['only_inverse_razmer']))
                    $inverse_gb = true;
                else if (!empty($filter['only_fact_razmer']))
                    $fact_gb = true;
            }


            //$conditions_gb = ['gb_s_ot' => [], 'gb_s_do' => [], 'gb_d_ot' => [], 'gb_d_do' => []];
            $conditions_gb = ['fact' => [], 'inverse' => []];
            if ($fact_gb) {
                if ($filter['gb_s_ot'])
                    $conditions_gb['fact'][] = 'shirina_doma >= ' . $filter['gb_s_ot'];
                if ($filter['gb_s_do'])
                    $conditions_gb['fact'][] = 'shirina_doma <= ' . $filter['gb_s_do'];

                if ($filter['gb_d_ot'])
                    $conditions_gb['fact'][] = 'dlina_doma >= ' . $filter['gb_d_ot'];
                if ($filter['gb_d_do'])
                    $conditions_gb['fact'][] = 'dlina_doma <= ' . $filter['gb_d_do'];
            }


            if ($inverse_gb) {
                if ($filter['gb_s_ot'])
                    $conditions_gb['inverse'][] = 'shirina_doma >= ' . $filter['gb_d_ot'];
                if ($filter['gb_s_do'])
                    $conditions_gb['inverse'][] = 'shirina_doma <= ' . $filter['gb_d_do'];

                if ($filter['gb_d_ot'])
                    $conditions_gb['inverse'][] = 'dlina_doma >= ' . $filter['gb_s_ot'];
                if ($filter['gb_d_do'])
                    $conditions_gb['inverse'][] = 'dlina_doma <= ' . $filter['gb_s_do'];
            }


            $cond = [];
            if (!empty($conditions_gb['fact']))
                $cond[] = '(' . implode(' and ', $conditions_gb['fact']) . ')';
            if (!empty($conditions_gb['inverse']))
                $cond[] = '(' . implode(' and ', $conditions_gb['inverse']) . ')';



          if ($cond)
            $projects->andWhere(implode(' or ', $cond));

            /*if(isset($_GET['demo'])) {
                var_dump($projects->createCommand()->getRawSql());exit;
            }*/
            /*if($filter['gb_s_ot'])
              $projects->andWhere('shirina_doma >= '.$filter['gb_s_ot']);
            if($filter['gb_s_do'])
              $projects->andWhere('shirina_doma <= '.$filter['gb_s_do']);

            if($filter['gb_d_ot'])
              $projects->andWhere('dlina_doma >= '.$filter['gb_d_ot']);
            if($filter['gb_d_do'])
              $projects->andWhere('dlina_doma <= '.$filter['gb_d_do']);*/


            if ($filter['id_roj']) {
                return $projects->andWhere(['id' => $filter['id_roj']])->count();
            }


            $count = $projects;
            $projects = $projects->orderBy($sort)->limit($limit);
            if ($_GET['page'])
                $projects = $projects->offset(($_GET['page'] * 20) - 20);
            if (!$only_count)
                $projects = $projects->asArray()->all();
            $count = $count->count();
        } else {
            if (!$only_count) {
                $projects = Projects::find()->orderBy($sort);
                if ($_GET['page'])
                    $projects = $projects->offset(($_GET['page'] * 20) - 20);
                $projects = $projects->asArray()->limit($limit)->all();
            }
            $count = Projects::find()->count();
        }


        return ['projects' => $projects, 'count' => $count];
    }

    public static function Get_filter_projects($id)
    {
        $count = 0;
        $filter = FilterItem::find()->where(['id' => $id])->asArray()->one();
        if (!$filter)
            return 0;
        $filter['dop'] = explode(',', $filter['dop']);
        $filter['dopInfo'] = explode(',', $filter['dopInfo']);
        if ($filter['eta'])
            $filter['eta'] = explode(',', $filter['eta']);
        if ($filter['erker'])
            $filter['erker'] = explode(',', $filter['erker']);
        if ($filter['garaj'])
            $filter['garaj'] = explode(',', $filter['garaj']);
        if ($filter['spalni']) {
            $spalni = $filter['spalni'];
            unset($filter['spalni']);
            $filter['spalni'][] = $spalni;
        }
        if ($filter['zanuzel']) {
            $zanuzel = $filter['zanuzel'];
            unset($filter['zanuzel']);
            $filter['zanuzel'][] = $zanuzel;
        }

        $projects = self::find()->where('id != 0');

        if ($filter['cenoj'])
            $projects->andWhere('prcie_all > 0');

        if ($filter['st_pr_ot'])
            $projects->andWhere('price_pr >= ' . $filter['st_pr_ot']);
        if ($filter['st_pr_do'])
            $projects->andWhere('price_pr <= ' . $filter['st_pr_do']);
        if ($filter['st_st_ot'])
            $projects->andWhere('prcie_all >= ' . $filter['st_st_ot']);
        if ($filter['st_st_do'])
            $projects->andWhere('prcie_all <= ' . $filter['st_st_do']);

        if ($filter['area_ot'])
            $projects->andWhere('area >= ' . $filter['area_ot']);
        if ($filter['area_do'])
            $projects->andWhere(['<=', 'area', $filter['area_do']]);

        if ($filter['townhouse_s'])
            $projects->andWhere('townhouse_s = ' . $filter['townhouse_s']);

        if (count($filter['dop']) > 0) {
            foreach ($filter['dop'] as $dop) {
                if ($dop) {
                    $projects->andWhere(['LIKE', 'dop', '-' . $dop . '-']);
                }
            }
        }

        if (count($filter['dopInfo']) > 0) {
            foreach ($filter['dopInfo'] as $dopInfo) {
                if ($dopInfo) {
                    $projects->andWhere(['LIKE', 'dopInfo', '-' . $dopInfo . '-']);
                }
            }
        }

        if ($filter['eta']) {
            $i = 0;
            $cc = '';
            foreach ($filter['eta'] as $spl) {
                if ($i == 0) {
                    if ($spl >= 10)
                        $cc .= '(count_et = ' . $spl[0] . ' AND mansard = 1)';
                    else
                        $cc .= '(count_et = ' . $spl[0] . ' AND mansard = 0)';
                } else {
                    if ($spl >= 10)
                        $cc .= 'OR (count_et = ' . $spl[0] . ' AND mansard = 1)';
                    else
                        $cc .= 'OR (count_et = ' . $spl[0] . ' AND mansard = 0)';
                }
                $i++;
            }
            if ($i > 0)
                $projects->andWhere($cc);
        }

        if ($filter['cokol'])
            $projects->andWhere(['cokol' => 1]);
        if ($filter['pogreb'])
            $projects->andWhere(['pogreb' => 1]);

        if ($filter['is_popular'])
            $projects->andWhere(['is_popular' => 1]);
        if ($filter['sale_ot'])
            $projects->andFilterWhere(['>', 'sale_ot', 1]);
        if ($filter['is_new'])
            $projects->andWhere(['is_new' => 1]);

        if ($filter['is_sale'])
            $projects->andWhere(['>=', 'is_sale', 1]);

        if ($filter['spalni']) {
            $i = 0;
            $cc = '';
            foreach ($filter['spalni'] as $spl) {

                $spl = (int)$spl;

                if ($i == 0)
                    $projects->andWhere(['spalen' => (int)$spl]);
                if ($spl == 5)
                    $projects->orWhere(['>=', 'spalen', (int)$spl]);
                else
                    $projects->orWhere(['=', 'spalen', (int)$spl]);
            }

        }

        if ($filter['zanuzel']) {
            $i = 0;
            $cc = '';
            foreach ($filter['zanuzel'] as $spl) {
                if ($i == 0)
                    $cc = 'zanuzel = ' . $spl;
                if ($spl == 5)
                    $cc .= ' OR zanuzel >= ' . $spl;
                else
                    $cc .= ' OR zanuzel = ' . $spl;
                $i++;
            }
            if ($i > 0)
                $projects->andWhere($cc);
        }


        if ($filter['erker']) {
            $i = 0;
            $cc = '';
            foreach ($filter['erker'] as $spl) {
                if ($i == 0) {
                    if ($spl >= 10)
                        $cc .= '(erker = ' . $spl[0] . ')';
                    else
                        $cc .= '(erker = ' . $spl[0] . ')';
                } else {
                    if ($spl >= 10)
                        $cc .= 'OR (erker = ' . $spl[0] . ')';
                    else
                        $cc .= 'OR (erker = ' . $spl[0] . ')';
                }
                $i++;
            }
            if ($i > 0)
                $projects->andWhere($cc);
        }


        if ($filter['garaj']) {
            $i = 0;
            $cc = '';
            foreach ($filter['garaj'] as $spl) {
                if ($i == 0) {
                    if ($spl >= 10)
                        $cc .= '(garaj = ' . $spl[0] . ')';
                    else
                        $cc .= '(garaj = ' . $spl[0] . ')';
                } else {
                    if ($spl >= 10)
                        $cc .= 'OR (garaj = ' . $spl[0] . ')';
                    else
                        $cc .= 'OR (garaj = ' . $spl[0] . ')';
                }
                $i++;
            }
            if ($i > 0)
                $projects->andWhere($cc);
        }

        if ($filter['style_pr'])
            $projects->andWhere(['style_pr' => $filter['style_pr']]);
        if ($filter['material'])
            $projects->andWhere(['material' => $filter['material']]);

        if ($filter['gb_s_ot'])
            $projects->andWhere(['>=', 'shirina_doma', $filter['gb_s_ot']]);
        if ($filter['gb_s_do'])
            $projects->andWhere(['<=', 'shirina_doma', $filter['gb_s_do']]);

        if ($filter['gb_d_ot'])
            $projects->andWhere(['>=', 'dlina_doma', $filter['gb_d_ot']]);
        if ($filter['gb_d_do'])
            $projects->andWhere(['<=', 'dlina_doma', $filter['gb_d_do']]);


        return $projects->count() ?: 0;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num_pr' => 'Номер проекта для публикации на сайте',
            'original_num_pr' => ' Оригинальный номер проекта',
            'desc_material' => 'Описание используемых материалов',
            'style_pr' => 'Стиль проекта',
            'dop' => 'Дополнительно',
            'dopInfo' => 'Дополнительно',
            'area' => 'Площадь',
            'razd_pr' => 'Разделы проекта',
            'material' => 'Основной материал',
            'shirina_doma' => 'Ширина дома',
            'dlina_doma' => 'Длина дома',
            'count_et' => 'Этажность',
            'spalen' => 'Кол-во спален',
            'fundament' => 'Фундамент',
            'perekrytija' => 'Перекрытия',
            'krysha' => 'Крыша',
            'krovlja' => 'Кровля',
            'fasad' => 'Фасад',
            'price_pr' => 'Цена проекта',
            'prcie_ps' => 'Цена паспорта',
            'price_copy' => 'Цена копии',
            'prcie_all' => 'Полная стоимость строительства',
            'price_vznos' => 'Первоначальный взнос',
            'perekrytie_fundamenta' => 'Перекрытие фундамента',
            'steny_vneh' => 'Внешние несущие стены',
            'steny_vnut' => 'Внутренние несущие стены',
            'precr_1' => 'Перекрытие 1-го этажа',
            'cherd_per' => 'Чердачное перекрытие',
            'strip_sys' => 'Стропильная система',
            'mat_crovl' => 'Материал кровли',
            'naruzhnaja_otdelka' => 'Наружная отделка',
            'is_zerkal' => 'Наличие зеркала у проекта',
            'is_popular' => 'Популярный проект',
            'is_have' => 'Наличие проекта',
            'is_sale' => 'Наличие скидки',
            'is_new' => 'Новинка',
            'is_slider' => 'В слайдер',
            'images' => 'Изображения для проекта + планы',
            'h1' => 'H1',
            'title' => 'Title',
            'description' => 'Description',
            'cokol' => 'Цоколь',
            'mansard' => 'Мансарда',
            'pogreb' => 'Погреб',
            'townhouse_s' => 'Тип дома',
            'dop_info' => 'Дополнительная информация',
            'steny_vneh_price' => '',
            'steny_vneh_1_price' => '',
            'steny_vneh_2_price' => ''
        ];
    }

    public static function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 51)
    {
        if (!file_exists($src)) {
            return false;
        }
        $size = getimagesize($src);

        if ($size === false) {
            return false;
        }

        $mimeType = FileHelper::getMimeType($src);

        $format = substr($mimeType, strrpos($mimeType, "/") + 1);
        $icfunc = 'imagecreatefrom' . $format;
        if (!function_exists($icfunc)) {
            return false;
        }

        $x_ratio = $width / $size[0];
        $y_ratio = $height / $size[1];

        if ($height == 0) {

            $y_ratio = $x_ratio;
            $height = $y_ratio * $size[1];

        } elseif ($width == 0) {

            $x_ratio = $y_ratio;
            $width = $x_ratio * $size[0];

        }

        $ratio = min($x_ratio, $y_ratio);
        $use_x_ratio = ($x_ratio == $ratio);

        $new_width = $use_x_ratio ? $width : floor($size[0] * $ratio);
        $new_height = !$use_x_ratio ? $height : floor($size[1] * $ratio);
        $new_left = $use_x_ratio ? 0 : floor(($width - $new_width) / 2);
        $new_top = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

        $isrc = $icfunc($src);
        $idest = imagecreatetruecolor($width, $height);

        imagefill($idest, 0, 0, $rgb);

        imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);

        imagejpeg($idest, $dest, $quality);

        imagedestroy($isrc);
        imagedestroy($idest);

        return true;
    }

    public static function CreateStamp($img1, $imag2)
    {

        //imagesavealpha($img1, true);
        //$trans_background = imagecolorallocatealpha($img1, 0, 0, 0, 127);
        //imagefill($img1, 0, 0, $trans_background);

        $stamp = imagecreatefrompng($img1);
        $image_info = getimagesize($imag2);


        $mimeType = FileHelper::getMimeType($imag2);

        $format = substr($mimeType, strrpos($mimeType, "/") + 1);

        $im_cr_func = "imagecreatefrom" . $format;
        $im_cr_func0 = "image" . $format;

        //$im0 = imagecreatetruecolor($image_info[0], $image_info[1]);
        //imagefill($im0, 0, 0, 0xFFFFFF);

        $im = $im_cr_func($imag2);

        if ($format == 'png') {
            $bg = imagecreatetruecolor(imagesx($im), imagesy($im));
            imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
            imagealphablending($bg, TRUE);
            imagecopy($bg, $im, 0, 0, 0, 0, imagesx($im), imagesy($im));
            imagejpeg($bg, $imag2);

            imagecopy($bg, $stamp, imagesx($bg) / 2 - (imagesx($stamp) / 2), imagesy($bg) / 2 - (imagesy($stamp) / 2), 0, 0, imagesx($stamp), imagesy($stamp));

            imagejpeg($bg, $imag2);
            imagedestroy($bg);
        } else {

            imagecopy($im, $stamp, imagesx($im) / 2 - (imagesx($stamp) / 2), imagesy($im) / 2 - (imagesy($stamp) / 2), 0, 0, imagesx($stamp), imagesy($stamp));

            imagejpeg($im, $imag2);
            imagedestroy($im);
        }


    }
}
