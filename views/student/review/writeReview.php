<?php

use yii\bootstrap\Html;
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 05/02/16
 * Time: 17:11
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
        2 => [
            'title' => 'Pick a TA',
            'icon' => 'glyphicon glyphicon-user',
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
    'start_step' => 3,
];
?>
<?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>
<div class="review-create">


<?= $this->render('_form', [
    'model' => $model,
]) ?>

</div>
