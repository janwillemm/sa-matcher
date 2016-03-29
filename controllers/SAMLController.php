<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 29/03/16
 * Time: 13:00
 */

namespace app\controllers;

use yii\helpers\Url;

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
        // Find the user
        var_dump($attributes);
        die();
        // Log in the user

        Yii::$app->user->login($user, 3600*24*30);

        return $this->goHome();
    }
}