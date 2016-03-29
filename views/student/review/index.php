<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 04/02/16
 * Time: 21:09
 */



use kartik\rating\StarRating;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Reviews';
$this->params['breadcrumbs'][] = ['label' => 'Student', 'url' => ['student/index']];
$this->params['breadcrumbs'][] = 'Reviews';


?>

<h1> Reviews</h1>
<!--<?= Html::a('Create new review', ['create'], ['class'=>'btn btn-success float']) ?> -->
<br />
    <h2> Reviews about me</h2>
    <?= StarRating::widget([
        'name' => 'avg_rating',
        'value' => round($avgScore, 2, PHP_ROUND_HALF_UP),
        'pluginOptions' => [
            'readonly' => true,
            'showClear' => false,
            'showCaption' => true,
            'size' => 'sm',
        ],
    ]) ?>



    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => "../../shared/review/_review"
    ]) ?>
