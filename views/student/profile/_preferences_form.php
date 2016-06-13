<?php

use yii\helpers\Html;
use app\controllers\extensions\RoleBasedActiveForm;
use app\models\Preferences;

/* @var $this yii\web\View */
/* @var $preferences app\models\Preferences */
/* @var $form app\controllers\extensions\RoleBasedActiveForm */
?>

<?php $form = RoleBasedActiveForm::begin(); ?>

<?= $form->field($preferences, 'courses')->checkboxlist(Preferences::getCoursesList()) ?>

<?= $form->field($preferences, 'workTypes')->checkboxlist(Preferences::getWorkTypesList()) ?>

<?= $form->field($preferences, 'durations')->checkboxlist(Preferences::getDurationsList()) ?>



<style>
    .form-group {
        float: left;
        margin-right: 200px;
    }
</style>


<div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
</div>

<?php RoleBasedActiveForm::end(); ?>
