<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\VacancySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vacancies';
$this->params['breadcrumbs'][] = ['label' => 'Student', 'url' => ['/student/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="filter float">
        <?= $this->render("_filter", ['filterModel' => $filterModel]) ?>
    </div>

    <div class="vacancy-results float">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'title',
                    'value' => 'title'
                ],
                [
                    'attribute' => 'workType',
                    'content' => function($model, $key, $index, $column) {
                        $string = "";
                        foreach($model->workTypes as $workType){
                            $string .= $workType->type . ", ";
                        }
                        return substr($string, 0, -2);;
                    }
                ],
                [
                    'attribute' => 'periodTypes',
                    'content' => function($model, $key, $index, $column) {
                        $string = "";
                        foreach($model->periodTypes as $periodType){
                            $string .= $periodType->duration . ", ";
                        }
                        return substr($string, 0, -2);;
                    }
                ]
            ],
            'rowOptions' => function ($model, $key, $index, $grid) {
                return ['data-id' => $model->id];
            },

        ]); ?>
    </div>

    <style>
        div.vacancy-results {
            width: 700px;
        }
        div.float{
            float:left
        }
        .grid-view tbody tr:hover {
            cursor:pointer;
            text-decoration: underline;
        }



    </style>
</div>


<?php
$this->registerJs("

    $('td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if(e.target == this)
            location.href = '" . Url::to(['student/vacancy/view']) . "?id=' + id;
    });

");