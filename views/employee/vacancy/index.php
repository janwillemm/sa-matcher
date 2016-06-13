<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 09/02/16
 * Time: 22:06
 */

use yii\grid\GridView;
use yii\helpers\Url;


$this->title = "Vacancies overview";
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['employee/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h1>
   <?= $this->title ?>
</h1>
<div class="vacancy-overview">
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
        .grid-view tbody tr:hover {
            cursor:pointer;
            text-decoration: underline;
        }



    </style>
<?php
//
//$this->registerJs("
//
//    $('td').click(function (e) {
//        var id = $(this).closest('tr').data('id');
//        if(e.target == this)
//            location.href = '" . Url::to(['employee/vacancy/view']) . "?id=' + id;
//    });
//
//");