<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 07/02/16
 * Time: 12:11
 */

use yii\helpers\Url;

$this->title = "Student overview";
$this->params['breadcrumbs'][] = "Student";

?>


<div class="student-home-page">
    <!-- I want to become SA -->
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <a href="<?= Url::to(array("student/vacancy/index")) ?>">
                    <div class="block become-sa">
                        I want to see SA vacancies
                    </div>
                </a>
            </div>
            <!-- I want to review a SA -->
            <div class="col-md-5">

                <a href="<?= Url::to(array("student/review/create")) ?>">
                    <div class="block review-sa">
                        I want to write a review
                    </div>
                </a>

            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <a href="<?= Url::to(array("student/profile/index")) ?>">
                    <div class="block become-sa">
                        I want to edit my profile
                    </div>
                </a>
            </div>
            <!-- I want to review a SA -->
            <div class="col-md-5">

                <a href="<?= Url::to(array("student/review/index")) ?>">
                    <div class="block review-sa">
                        I want to see how I'm reviewed
                    </div>
                </a>

            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

</div>
<style>
    .row {
        margin-top:20px;
    }
</style>