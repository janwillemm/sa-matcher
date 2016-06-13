<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 30/03/16
 * Time: 09:22
 */

namespace app\controllers\student;

use app\models\student\PreferenceForm;
use \app\controllers;
use app\models\Preferences;


class ProfileController extends \app\controllers\StudentBaseController {

    public function actionPreferences()
    {
        $model = new PreferenceForm();

        $model->load(\Yii::$app->request->post());

        return $this->render('preferences',
            ['person' => \yii::$app->user->identity,
                'model' => $model
            ]
        );
    }

    public function actionIndex(){
        //Get the preferences model
        $preferences = new Preferences();

        // Make an user model from current user
        $person = \Yii::$app->user->identity;

        if(isset(\Yii::$app->request->post()['Preferences'])){
            $preferences->load(\Yii::$app->request->post());
            $preferences->saveForUser($person);
        }

        // Fill preferences with user preferences
        $preferences->fillForUser($person);


        // Show data as form

        return $this->render("index",[
            "model" => $person,
            "preferences" => $preferences,
        ]);
    }
}