<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 29/03/16
 * Time: 20:56
 */


namespace app\controllers;

use \yii\base\ErrorException;
use \yii\helpers\Url;
use \yii\web\Session;
use \app\models\Person;
class AuthenticationController extends BaseController{


    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goBack();
        }

        return \Yii::$app->response->redirect(Url::to(['/saml/login']));

    }

    public function actionResponse(){
        $session = new Session();
        $session->open();
        $tud = $session['tud'];

        // First try to find id
        $person = Person::findOne(['tud_id' => $tud['uid']]);
        if($person){
            $person->updatePerson($tud);
            return $this->login($person);
        }

        // Then try to find emailaddress (Which is also a valid identifier)
        $person = Person::findOne(['emailaddress' => $tud['email']]);
        if($person){
            $person->updatePerson($tud);
            return $this->login($person);
        }
        return $this->create($tud);
    }

    public function actionLogout(){
        \yii::$app->user->logout(true);
        return \yii::$app->response->redirect(Url::to(['site/index']));
    }


    private function login($person)
    {

        \Yii::$app->user->login($person, 0);//3600*24*30);

        if ($person->isStudent()) {
            return \Yii::$app->response->redirect(Url::to(['/student/index']));
        }
        if ($person->isEmployee()) {
            return \Yii::$app->response->redirect(Url::to(['/employee/index']));
        }
        return \Yii::$app->response->redirect(Url::to(['/site/index']));
    }

    private function create($tud){
        $person = Person::createPerson($tud);

        if(!$person){
            // TODO: Should never happen
            throw new ErrorException("You should fix this!");
        }
        \Yii::$app->user->login($person);

        if($person->isStudent()){
            return \yii::$app->response->redirect(Url::to(['/student/profile/preferences']));
        } elseif($person->isEmployee()) {
            return \yii::$app->response->redirect(Url::to(['/employee/profile/preferences']));
        }

    }
}