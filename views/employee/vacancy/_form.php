<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vacancy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacancy-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'requirements')->textarea(['rows' => 6]) ?>

    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'expire_date')->input("date") ?>

<!--    <?//= $form->field($model, 'is_open')->input("checkbox") ?>-->

    <?= $form->field($model, 'hours_per_week')->input("number") ?>

    <?= $form->field($model, 'num_of_sa_needed')->input("number") ?>
    </div>
    <div class="col-md-8">
        <?= $this->render("@app/views/shared/preferences/_form", [
            'model' => $model->preferences,
            'form' => $form,
            'no_courses' => true,
        ]); ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
