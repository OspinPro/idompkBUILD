<?php

namespace app\modules\catalog\controllers;

use app\models\FilterItem;
use app\models\Projects;
use app\models\ProjSettings;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Session;

class ProektyDomovController extends Controller
{
    public function actions()
    {
        $this->enableCsrfValidation = false;
        return parent::actions();
    }

    public function actionIndex()
    {
        \Yii::$app->params['name_filter'] = 'index';


        if ($_POST) {
            $session = new Session();
            $session->open();
            $filter = [];
            foreach ($_POST as $key => $val) {
                if ($val == "all_reset")
                    unset($filter[$key]);
                else
                    $filter[$key] = $val;
            }
        }

        $session['projects_index'] = serialize($filter);
        $projects = Projects::Get_projects();
        $pr_settings = ProjSettings::find()->one();

        return $this->render('index', ['projects' => $projects['projects'], 'pr_settings' => $pr_settings, 'count' => $projects['count'], 'name_filter' => 'index']);


    }

    public function actionItem($name)
    {

        \Yii::$app->params['name_filter'] = $name;

        if ($name == 'index' && $_GET['page'])
            return $this->actionIndex();


        $session = new Session();
        $session->open();

        if ($name == 'go_filter') {
            if (!empty($session['projects_index']))
                unset($session['projects_index']);
            $filter = [];

            foreach ($_GET as $key => $val) {
                if ($val == "all_reset")
                    unset($filter[$key]);
                else
                    $filter[$key] = $val;
            }
            $session['projects_index'] = serialize($filter);

            return $this->redirect('/catalog/proekty-domov', 301);
        }

        if ($name == 'count_filter') {
            $filter = [];

            foreach ($_POST as $key => $val) {
                if ($val == "all_reset")
                    unset($filter[$key]);
                else
                    $filter[$key] = $val;
            }

            $count = Projects::Get_projects(20, $filter, true)['count'];

            echo $count;
            exit;
        }

        $filter = FilterItem::find()->where(['url' => $name])->asArray()->one();

        if ($filter) {


            $filter['dop'] = explode(',', $filter['dop']);
            $filter['dopInfo'] = explode(',', $filter['dopInfo']);
            if ($filter['eta'])
                $filter['eta'] = explode(',', $filter['eta']);
            if ($filter['erker'])
                $filter['erker'] = explode(',', $filter['erker']);
            if (isset($filter['garaj']))
                if ($filter['garaj'] == '') {
                    $filter['garaj'] = 0;
                } else {
                    $filter['garaj'] = explode(',', $filter['garaj']);
                }
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
            $session['projects_' . $name] = serialize($filter);

            $projects = Projects::Get_projects();


            return $this->render('index', ['projects' => $projects['projects'], 'pr_settings' => $filter, 'count' => $projects['count'], 'name_filter' => $name]);

        } else if ($name == 'reset_filer') {
            foreach ($session as $key => $value) {
                if (strstr($key, 'projects_'))
                    unset($session[$key]);
            }

            return $this->redirect('/catalog/proekty-domov', 301);
        } else if ($name == 's-cenoj-na-stroitelstvo') {

            $filter = unserialize($session['projects_' . $name]);
            $filter['cenoj'] = 1;
            $session['projects_' . $name] = serialize($filter);

            $projects = Projects::Get_projects();


            return $this->render('index', ['projects' => $projects['projects'], 'pr_settings' => ProjSettings::find()->where(['id' => 1])->asArray()->one(), 'count' => $projects['count'], 'name_filter' => $name]);

        } else if ($name == 'vse') {

            $filter = unserialize($session['projects_index']);
            unset($filter['cenoj']);
            $session['projects_index'] = serialize($filter);

            return $this->redirect('/catalog/proekty-domov', 301);
        } else if ($name == 'tipovye-proekty-domov-pod-stroitelstvo') {
            return $this->render('tipovye-proekty');
        }

        $article = Projects::find()->where(['num_pr' => $name])->one();

        $rec = Projects::find()->where(['num_pr' => $name])->asArray()->one();

        if (!$rec) {
            if (\Yii::$app->request->getPathInfo() == 'catalog/proekty-domov/index') {
                return $this->redirect('/catalog/proekty-domov', 301);
            } else {
                \Yii::$app->params['isError'] = true;
                return $this->render('@app/views/site/error');
            }
        }


        if ($article) {
            $article->updateCounters(['views_msc' => 1]);
        }


        $itemH = [];
        if ($_COOKIE['itemH_box'])
            $itemH = json_decode($_COOKIE['itemH_box'], true);

        if (in_array($name, $itemH) != true)
            $itemH[] = $name;
        setcookie("itemH_box", json_encode($itemH), time() + 60 * 60 * 24 * 365, '/', $_SERVER['SERVER_NAME']);

        return $this->render('item', ['rec' => $rec, 'article' => $article]);

    }
}