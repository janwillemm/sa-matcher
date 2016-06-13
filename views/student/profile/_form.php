<?php

use yii\helpers\Html;
use app\controllers\extensions\RoleBasedActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form app\controllers\extensions\RoleBasedActiveForm */
?>

<div class="person-form">

    <?php $form = RoleBasedActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emailaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'picture', ['access_rule'=>1])->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tud_id', ['access_rule'=>1])->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php RoleBasedActiveForm::end(); ?>

</div>
