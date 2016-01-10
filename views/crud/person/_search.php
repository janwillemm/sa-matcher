<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\PersonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'emailaddress') ?>

    <?= $form->field($model, 'picture') ?>

    <?= $form->field($model, 'register_date') ?>

    <?php // echo $form->field($model, 'person_type_id') ?>

    <?php // echo $form->field($model, 'tud_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
