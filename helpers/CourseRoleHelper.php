<?php

namespace app\helpers;

/**
 * Created by PhpStorm.
 * User: jw
 * Date: 05/02/16
 * Time: 14:05
 */
use app\helpers\RoleHelper;

class CourseRoleHelper extends RoleHelper {

    protected $tableName = 'course_role_type';

    const TEACHER = 0;
    const STUDENT = 1;
    const STUDENTASSISTANT = 2;
}
