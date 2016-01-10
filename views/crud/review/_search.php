<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\ReviewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'writer_id') ?>

    <?= $form->field($model, 'receiver_id') ?>

    <?= $form->field($model, 'vacancy_id') ?>

    <?= $form->field($model, 'is_anonymous') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'explanation') ?>

    <?php // echo $form->field($model, 'creation_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
