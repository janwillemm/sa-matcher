<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vacancy */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Student', 'url' => ['student/index']];
$this->params['breadcrumbs'][] = ['label' => 'Vacancies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-view" >

    <h1><?= Html::encode($this->title) ?></h1>
    <h4>Description</h4>
    <p>
        <?=$model->description ?>
    </p>
    <h4>Requirements</h4>
    <p>
        <?=$model->requirements ?>
    </p>

    <?=showProperty("Hours per week", $model->hours_per_week)?>

    <?= showArray("Periods", \yii\helpers\ArrayHelper::map($model->getPeriodTypes()->all(), 'id', 'duration'))?>

    <?= showArray("Type work", \yii\helpers\ArrayHelper::map($model->getWorkTypes()->all(), 'id', 'type'))?>

    <?= showEmployees($model->getOwners()->all())?>


</div>

<?php

function showProperty($descriptor, $value){
    return "<h4>$descriptor </h4><p>$value</p>";
}

function showArray($descriptor, $array){
    $string = "";
    foreach($array as $elem){
        $string .= $elem . "<br />";
    }
    return showProperty($descriptor, $string);
}

function showEmployees($array){
    $string = "";
    foreach($array as $person){
        $string .= $person->name . " - " . $person->emailaddress . "<br />";
    }
    return showProperty("Employees", $string);
}
?>
