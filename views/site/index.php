<?php

/* @var $this yii\web\View */

use \yii\helpers\Url;

$this->title = 'SA Matcher';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>SA-Matcher!</h1>

        <p class="lead">To continue, choose what you are and log in!</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(array('student/index')) ?>">Student</a>
        <a class="btn btn-lg btn-success" href="<?= Url::to(array('employee/index')) ?>">Teacher</a></p>
    </div>

</div>
