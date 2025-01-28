<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Home_page_projects".
 *
 * @property integer $id
 * @property integer $mod_id
 * @property integer $project_id
 * @property integer $position
 */
class ProjectLinks extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'projects_links';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['mod_id', 'project_id','position',], 'safe']
    ];
  }

    public static function getLinksByMod($mod_id)
    {
        $query = self::find()->andWhere('mod_id='.$mod_id.'');
        $arr = $query->asArray()->all();

        $l = [];
        foreach ($arr as $el)
        {
            $l[] = $el['project_id'];
        }


        $pr_numbers = Projects::find()->select('num_pr,id')->andWhere(['id' => $l])->indexBy('id')->asArray()->column();

        return implode(',', $pr_numbers);
    }

    public static function getLinks($project_id, $get_id = false)
    {
        $query = self::find()->andWhere('mod_id in(select mod_id from projects_links where project_id='.$project_id.')');
        $arr = $query->asArray()->all();

        $l = [];
        foreach ($arr as $el)
        {
            if( $el['project_id'] != $project_id)
                $l[] = $el['project_id'];
        }

        if($get_id)
        {
            return $l;
        }

        $pr_numbers = Projects::find()->select('num_pr,id')->andWhere(['id' => $l])->indexBy('id')->asArray()->column();

        return implode(',', $pr_numbers);
    }

    public static function saveLinks($mod_id, $num_pr)
    {
        self::deleteAll('mod_id='.$mod_id);
        $num_pr = explode(',', $num_pr);
        foreach ($num_pr as $k => $n0)
            $num_pr[$k] = trim($n0);

        $ids = Projects::find()->select('id,num_pr')->andWhere(['num_pr' => $num_pr])->indexBy('num_pr')->asArray()->column();

        foreach ($num_pr as $n)
        {
            if(!empty($ids[$n]))
            {
                $lnk = new self();
                $lnk->mod_id = $mod_id;
                $lnk->project_id = $ids[$n];

                $lnk->save();
            }
        }
    }

  /*public static function getLinks($project_id, $get_id = false)
  {
      $query = self::find()->andWhere('project1_id='.$project_id.' or project2_id='.$project_id.'');
      $arr = $query->asArray()->all();
      $l = [];
      foreach ($arr as $el)
      {
          $l[] = ($project_id == $el['project1_id'])? $el['project2_id'] : $el['project1_id'];
      }

      if($get_id)
      {
          return $l;
      }

      $pr_numbers = Projects::find()->select('num_pr,id')->andWhere(['id' => $l])->indexBy('id')->asArray()->column();

      return implode(',', $pr_numbers);
  }

  public static function saveLinks($project_id, $num_pr)
  {
      self::deleteAll('project1_id='.$project_id.' or project2_id='.$project_id.'');
      $num_pr = explode(',', $num_pr);

      $ids = Projects::find()->select('id,num_pr')->andWhere(['num_pr' => $num_pr])->indexBy('num_pr')->asArray()->column();

      foreach ($num_pr as $n)
      {
          if(!empty($ids[$n]))
          {
              $lnk = new self();
              $lnk->project1_id = $project_id;
              $lnk->project2_id = $ids[$n];

              $lnk->save();
          }
      }
  }*/

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'mod_id' => 'Модификация ИД',
      'project_id' => 'Проект',
        'position' => 'Позиция',
    ];
  }
}
