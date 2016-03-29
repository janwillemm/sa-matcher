<?php

namespace app\controllers;

/**
 * Created by PhpStorm.
 * User: jw
 * Date: 07/02/16
 * Time: 12:09
 */

class StudentController extends BaseController {

    /**
     * Show homepage choices
     * @return mixed
     */

    public function beforeAction(){
        PARENT::beforeAction();
        if (\Yii::$app->user->isGuest()) {
            return false;
        }
        if(!\Yii::$app->user->isStudent()){
            return false;
        }
        return true;
    }


}