<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 09/02/16
 * Time: 22:06
 */

use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Person;
use yii\helpers\Url;


$this->title = "Matches";
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['employee/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h1>
    <?= $this->title ?>
</h1>
<div class="vacancy-overview">
    <?= GridView::widget(array(
        'dataProvider' => $provider,
        'columns' => [
            [
                'attribute' => 'Match Score',
                'value' => 'score'
            ],
            [
                'attribute' => 'Name',
                'value' => 'name'
            ],[
                'attribute' => 'Email',
                'value' => 'emailaddress',
            ],
            [
                'attribute' => 'Review AVG',
                'content' => function($model, $key, $index, $column) {
                    $person = Person::findOne($model['id']);
                    return $person->getReviewScore();
                }
            ],
        ],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['data-id' => $model['id']];
        },
    )) ?>

</div>

    <style>
        .grid-view tbody tr:hover {
            cursor:pointer;
            text-decoration: underline;
        }



    </style>

<?php
$this->registerJs("

    $('td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if(e.target == this)
            location.href = '" . Url::to(['employee/match/view']) . "?match=' + id + '&vacancy=" . \Yii::$app->getRequest()->get()['vacancy'] . "';
    });

");