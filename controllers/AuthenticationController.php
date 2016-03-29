<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 29/03/16
 * Time: 20:56
 */


namespace app\controllers;

use yii\helpers\Url;

class AuthenticationController extends BaseController{


    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest()) {
            return $this->goBack();
        }

        return $this->redirect(Url::to('saml/login'));

    }
}