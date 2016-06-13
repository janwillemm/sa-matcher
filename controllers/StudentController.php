<?php

namespace app\controllers;

/**
 * Created by PhpStorm.
 * User: jw
 * Date: 07/02/16
 * Time: 12:09
 */

class StudentController extends StudentBaseController {

    /**
     * Show homepage choices
     * @return mixed
     */
    public function actionIndex()
    {
        // TODO: Real current user
        $user = \app\models\Person::findOne(1);

        return $this->render('index', [
            'user' => $user,
        ]);
    }


}