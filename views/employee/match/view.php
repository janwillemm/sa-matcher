<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 22/05/16
 * Time: 18:32
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

$courses = "";
$preferences = $person->getCoursePreferences();
foreach($preferences as $course){
    $courses .= $course['tud_id'] . ", ";
}

$workTypes = "";
foreach($person->getWorkPreferences() as $workPreference){
    $workTypes .= $workPreference->type . ", ";
}

$periodTypes = "";
foreach($person->getPeriodPreferences() as $periods){
    $periodTypes .= $periods->duration . ", ";
}

$this->title = $person->name;
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['employee/index']];
$this->params['breadcrumbs'][] = ['label' => 'Matches', 'url' => ['showmatches', "vacancy" => \Yii::$app->getRequest()->get()['vacancy']]];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>




<?= DetailView::widget([
    'model' => $person,
    'attributes' => [
        'emailaddress',
        'reviewScore',
        [
            'label' => "Preferred courses",
            'value' => substr($courses,0, -2),
        ],
        [
            'label' => "Preferred types of Work",
            'value' => substr($workTypes,0, -2),
        ],
        [
            'label' => "Preferred work periods",
            'value' => substr($periodTypes,0, -2),
        ]
    ],
]) ?>
