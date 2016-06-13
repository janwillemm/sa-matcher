<?php

namespace app\controllers;

use \app\models\Person;

/**
 * Created by PhpStorm.
 * User: jw
 * Date: 07/02/16
 * Time: 12:09
 */

class EmployeeController extends EmployeeBaseController {

    /**
     * Show homepage choices
     * @return mixed
     */
    public function actionIndex()
    {
        // TODO: Real current user
        $user = Person::findOne(3);

        return $this->render('index', [
            'user' => $user,
        ]);
    }


}