<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vacancy */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['employee/index']];
$this->params['breadcrumbs'][] = ['label' => 'Vacancies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?= Html::a('Find TA Matches', ['employee/match/showmatches', 'vacancy' => $model->id], [
            'class' => 'btn btn-primary']) ?>
        <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description:ntext',
            'requirements:ntext',
            'open_date',
            'expire_date',
//            'is_open',
            'hours_per_week',
            'num_of_sa_needed',
        ],
    ]) ?>

    <!-- @TODO: Add preferences options -->
</div>
