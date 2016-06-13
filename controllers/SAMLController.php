<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 29/03/16
 * Time: 13:00
 */

namespace app\controllers;

use yii\helpers\Url;
use app\models\Person;
use yii\web\Session;

class SamlController extends BaseController {

    public function actions() {
        return [
            'login' => [
                'class' => 'asasmoyo\yii2saml\actions\LoginAction'
            ],
            'acs' => [
                'class' => 'asasmoyo\yii2saml\actions\AcsAction',
                'successCallback' => [$this, 'callback'],
                'successUrl' => Url::to('site/welcome'),
            ],
            'metadata' => [
                'class' => 'asasmoyo\yii2saml\actions\MetadataAction'
            ],
            'logout' => [
                'class' => 'asasmoyo\yii2saml\actions\LogoutAction',
                'returnTo' => Url::to('site/bye'),
            ]
        ];
    }



    /**
     * @param array $attributes attributes sent by Identity Provider.
     */
    public function callback($attributes) {

        $tud = [
            "uid" => $attributes['urn:mace:dir:attribute-def:uid'][0],
            "email" => $attributes['mail'][0],
            "name" => $attributes['displayName'][0],
            "affliation" => $attributes['urn:mace:dir:attribute-def:eduPersonAffiliation'][0]
        ];
        return $this->redirect($tud);

    }

    public function actionFakeloginstudent(){
        $uid = \Yii::$app->getRequest()->getQueryParam('uid');
        $tud = ["uid" => $uid ? $uid : "jmanenschijn", "email" => "J.W.Manenschijn@student.tudelft.nl", "name" => "J.W. Manenschijn", "affliation" => "student"];
        return $this->redirect($tud);
    }

    public function actionFakeloginemployee(){
        $uid = \Yii::$app->getRequest()->getQueryParam('uid');
        $tud = ["uid" => $uid ? $uid : "docent", "email" => "D.O.cent@tudelft.nl", "name" => "Dirk Owen Cent", "affliation" => "employee"];
        return $this->redirect($tud);
    }

    private function redirect($tud){
        $session = new Session();
        $session->open();
        $session['tud'] = $tud;
        return \Yii::$app->response->redirect(Url::to(['/authentication/response']));
    }
}