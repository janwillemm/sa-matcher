<?php

namespace app\controllers;
use yii\helpers\Url;

/**
 * Created by PhpStorm.
 * User: jw
 * Date: 07/02/16
 * Time: 12:09
 */

class StudentBaseController extends BaseController {

    /**
     * Show homepage choices
     * @return mixed
     */

    public function beforeAction($action){
        if (\Yii::$app->user->isGuest) {
            return \Yii::$app->response->redirect(Url::to(['/authentication/login']));
        }
        if(!\Yii::$app->user->identity->isStudent()){
            return false;
        }
        return parent::beforeAction($action);
    }


}