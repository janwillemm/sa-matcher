<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 06/02/16
 * Time: 16:42
 */

// Checkboxes for duration
// Checkboxes for type work
// Checkboxes for courses

use \app\controllers\extensions\RoleBasedActiveForm;
use \app\models\filter\VacancyFilter;
use yii\bootstrap\Html;
use kartik\slider\Slider;


?>

<?php $form = RoleBasedActiveForm::begin() ?>

<div class="filter-form vacancy">

    <?= $form->field($filterModel, 'durations')->checkboxlist(VacancyFilter::getDurationsList()) ?>

    <?= $form->field($filterModel, 'workTypes')->checkboxlist(VacancyFilter::getWorkTypesList()) ?>

    <?= $form->field($filterModel, 'courses')->checkboxlist(VacancyFilter::getCoursesList()) ?>


    <?= $form->field($filterModel, 'max_hours')->widget(Slider::className(), [
        'name'=>'max_hours',
        'value'=>7,
        'sliderColor'=>Slider::TYPE_GREY,
        'handleColor'=>Slider::TYPE_DANGER,
        'pluginOptions'=>[
            'handle'=>'triangle',
            'tooltip'=>'always',
            'min' => 2,
            'max' => 20,
            'step' => 1,

        ]]) ?>

    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>


    <style>
        div.slider.slider-horizontal{
            #width:150px;
            display:block;
        }
    </style>


</div>

<?php RoleBasedActiveForm::end();