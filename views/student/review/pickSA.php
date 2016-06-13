<?php

use yii\helpers\ArrayHelper;
use app\models\Product;
use app\controllers\extensions\RoleBasedActiveForm;
use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: jw
 * Date: 04/02/16
 * Time: 21:41
 */

$this->title = "Write review";
$this->params['breadcrumbs'][] = ['label' => 'Student', 'url' => ['student/index']];
$this->params['breadcrumbs'][] = "Write review";

$wizard_config = [
    'id' => 'stepwizard',
    'steps' => [
        1 => [
            'title' => 'Pick a course',
            'icon' => 'glyphicon glyphicon-education',
            'content' => '<h2>Pick a TA</h2>',
            'buttons' => [
                'next' => [
                    'html' => ""
                ],
                'previous' => [
                    'html' => ""
                ],
                'save' => [
                    'html' => ""
                ]
            ],
        ],
        2 => [
            'title' => 'Pick a TA',
            'icon' => 'glyphicon glyphicon-user',
            'content' => '<h2>Pick a TA</h2>',
            'buttons' => [
                'next' => [
                    'html' => ""
                ],
                'previous' => [
                    'html' => ""
                ],
                'save' => [
                    'html' => ""
                ]
            ],
        ],
        3 => [
            'title' => 'Write your review',
            'icon' => 'glyphicon glyphicon-pencil',
            'content' => '<h2>Write a review</h2>',
            'buttons' => [
                'next' => [
                    'html' => ""
                ],
                'previous' => [
                    'html' => ""
                ],
                'save' => [
                    'html' => ""
                ]
            ],
        ],
    ],
    'start_step' => 2,
];
?>
<?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>

<?php $form = RoleBasedActiveForm::begin() ?>

<div class="form-group">
<?= Html::DropDownList('receiver_id', 1,  ArrayHelper::map($sas, 'id', 'name')) ?>

</div>

<div class="form-group">
    <?= Html::submitButton('Continue', ['class' => 'btn btn-primary']) ?>
</div>

<?php RoleBasedActiveForm::end() ?>
