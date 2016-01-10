<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emailaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'picture')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'register_date')->textInput() ?>

    <?= $form->field($model, 'person_type_id')->textInput() ?>

    <?= $form->field($model, 'tud_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
