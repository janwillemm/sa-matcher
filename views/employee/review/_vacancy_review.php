<?php

use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
?>

<li>
<?= $vacancy->title?>

<?= \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider = new ActiveDataProvider([
        'query' => $vacancy->getReviews()
    ]),
    'itemView' => "../../shared/review/_review"
]) ?>

</li>
