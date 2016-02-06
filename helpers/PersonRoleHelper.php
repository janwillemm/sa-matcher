<?php

namespace app\helpers;
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 05/02/16
 * Time: 14:04
 */
use app\helpers\RoleHelper;

class PersonRoleHelper extends RoleHelper {

    protected $tableName = 'course_role_type';

    const STUDENT = 0;
    const EMPOLOYEE = 1;
    const ADMIN = 2;
    const SUPERUSER = 3;

}
