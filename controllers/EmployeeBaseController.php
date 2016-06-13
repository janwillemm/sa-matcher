<?php

namespace app\controllers;

use \app\models\Person;
use yii\helpers\Url;

/**
 * Created by PhpStorm.
 * User: jw
 * Date: 07/02/16
 * Time: 12:09
 */

class EmployeeBaseController extends BaseController {

    /**
     * Show homepage choices
     * @return mixed
     */

    public function beforeAction($action){
        if (\Yii::$app->user->isGuest) {
            return \Yii::$app->response->redirect(Url::to(['/authentication/login']));
        }
        if(!\Yii::$app->user->identity->isEmployee()){
            throw new \yii\web\UnauthorizedHttpException("Je bent geen Docent");
        }
        return parent::beforeAction($action);
    }


}