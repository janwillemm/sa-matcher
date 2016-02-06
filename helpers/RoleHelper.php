<?php

namespace app\helpers;

/**
 * Created by PhpStorm.
 * User: jw
 * Date: 04/02/16
 * Time: 22:18
 */


abstract class RoleHelper{

    protected $tableName;

    public function getName($role){
        $row = (new \yii\db\Query())
            ->select("type")
            ->from($this->tableName)
            ->where(['id' => '$role'])
            ->one();
        return $row['id'];
    }

}
