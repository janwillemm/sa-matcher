<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Review */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'writer_id')->textInput() ?>

    <?= $form->field($model, 'receiver_id')->textInput() ?>

    <?= $form->field($model, 'vacancy_id')->textInput() ?>

    <?= $form->field($model, 'is_anonymous')->textInput() ?>

    <?= $form->field($model, 'score')->textInput() ?>

    <?= $form->field($model, 'explanation')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'creation_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
