<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 09/02/16
 * Time: 22:06
 */

use yii\grid\GridView;
use yii\helpers\Url;


$this->title = "Courses overview";
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['employee/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h1>
   <?= $this->title ?>
</h1>
<div class="course-overview">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'Course ID',
                'value' => 'tud_id'
            ],
            [
                'attribute' => 'Course Name',
                'value' => 'name'
            ],
        ],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id];
        },

    ]); ?>

    <style>
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
            location.href = '" . Url::to(['employee/course/view']) . "?id=' + id;
    });

");