<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\Session;

class IzbrannoeController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSet($id)
    {
        $session = new Session();
        $session->open();

        $rec = unserialize($session['izbrannoe']);
        if(!$rec)
            $rec = [];
        $stat = 'set';
        if(in_array($id,$rec))
        {
            unset($rec[array_search($id,$rec)]);
            $stat = 'unset';
        }
        else
        {
            $rec[] = $id;
        }
        $session['izbrannoe'] = serialize($rec);

        return json_encode(['status'=>$stat,'cn'=>count($rec)]);
    }
}