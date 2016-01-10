<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vacancy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacancy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'requirements')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'open_date')->textInput() ?>

    <?= $form->field($model, 'expire_date')->textInput() ?>

    <?= $form->field($model, 'is_open')->textInput() ?>

    <?= $form->field($model, 'hours_per_week')->textInput() ?>

    <?= $form->field($model, 'num_of_sa_needed')->textInput() ?>

    <?= $form->field($model, 'type_work_id')->textInput() ?>

    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
