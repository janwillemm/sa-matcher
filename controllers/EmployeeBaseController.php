<?php

namespace app\controllers;

use \app\models\Person;

/**
 * Created by PhpStorm.
 * User: jw
 * Date: 07/02/16
 * Time: 12:09
 */

class EmployeeController extends BaseController {

    /**
     * Show homepage choices
     * @return mixed
     */

    public function beforeAction(){
        PARENT::beforeAction();
        if (\Yii::$app->user->isGuest()) {
            return false;
        }
        if(!\Yii::$app->user->isEmployee()){
            return false;
        }
        return true;
    }


}