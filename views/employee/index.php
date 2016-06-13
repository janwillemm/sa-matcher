<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 07/02/16
 * Time: 12:11
 */

use yii\helpers\Url;

$this->title = "Employee";
$this->params['breadcrumbs'][] = "Employee"

?>


<div class="student-home-page">
    <!-- I want to become SA -->
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <a href="<?= Url::to(array("employee/vacancy/index")) ?>">
                    <div class="btn btn-lg btn-primary btn-block">
                        I want to see my vacancies
                    </div>
                </a>
            </div>
            <!-- I want to review a SA -->
            <div class="col-md-4">

                <a href="<?= Url::to(array("employee/review/index")) ?>">
                    <div class="btn btn-lg btn-primary btn-block">
                        I want to see reviews for my SA's
                    </div>
                </a>

            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <a href="<?= Url::to(array("employee/course/index")) ?>">
                    <div class="btn btn-lg btn-primary btn-block">
                       I want to see my courses
                    </div>
                </a>
            </div>
            <!-- I want to review a SA -->
            <div class="col-md-4">

                <a href="<?= Url::to(array("employee/vacancy/createnew")) ?>">
                    <div class="btn btn-lg btn-primary btn-block">
                        I want to create a new vacancy
                    </div>
                </a>

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

</div>
<style>
    .row {
        margin-top:20px;
    }
</style>