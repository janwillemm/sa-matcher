<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 30/03/16
 * Time: 09:30
 */

namespace app\models\student;

class PreferenceForm extends \yii\base\Model{

    public $emailaddress;
    public $periodPreferences = [];
    public $workPreferences = [];

    public function rules()
    {
        return [
            // define validation rules here
        ];
    }

    public function load($model){
//        var_dump($model);
//        die();
    }


}