<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 27/03/16
 * Time: 14:24
 */

namespace app\controllers;
use app\commands\components\SAAccessRule;


class BaseController extends \yii\base\Controller{

    public function runAction($id, $params=array()){
        $params = array_merge($_POST, $params);
        return parent::runAction($id, $params);
    }

    public function getCurrentUser(){
        return \Yii::$app->user->identity;
    }

    public function getSession(){
        $session = \Yii::$app->session;
        if (!$session->isActive)
            $session->open();
        return $session;
    }
}