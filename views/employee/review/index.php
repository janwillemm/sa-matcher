<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 04/02/16
 * Time: 21:09
 */

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Reviews';
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['employee/index']];
$this->params['breadcrumbs'][] = 'Reviews';


?>

<h1> Reviews</h1>
<!--<?= Html::a('Create new review', ['create'], ['class'=>'btn btn-success float']) ?> -->
<br />
    <h2> Reviews</h2>

<ul>
<?php

foreach($vacancies as $vacancy){
    echo $this->render("_vacancy_review", ["vacancy" =>$vacancy]);
}
?>
</ul>