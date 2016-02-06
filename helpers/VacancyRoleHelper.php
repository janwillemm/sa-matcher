<?php

namespace app\helpers;
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 05/02/16
 * Time: 14:03
 */

use app\helpers\RoleHelper;

class VacancyRoleHelper extends RoleHelper {

    protected $tableName = 'vacancy_role_type';

    const OWNER = 1;
    const STUDENTASSISTANT = 2;

}
