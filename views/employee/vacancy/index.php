<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 09/02/16
 * Time: 22:06
 */

use yii\grid\ActionColumn;
use yii\grid\GridView;


$this->title = "Reviews overview";
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['employee/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h1>
   <?= $this->title ?>
</h1>
<div class="vacancy-overview">
    <?= GridView::widget(array(
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'title',
                'value' => 'title'
            ],
            [
                'attribute' => 'workType',
                'value' => 'workType.type'
            ],
            [
                'attribute' => 'periodTypes',
                'content' => function($model, $key, $index, $column) {
                    $string = "";
                    foreach($model->periodTypes as $periodType){
                        $string .= $periodType->duration . " ,";
                    }
                    return substr($string, 0, -2);
                }
            ],
            [
                'class' => ActionColumn::className(),
            ]
        ],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id];
        },
    )) ?>

</div>
