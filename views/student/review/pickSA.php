<?php

use yii\helpers\ArrayHelper;
use app\models\Product;
use app\controllers\extensions\RoleBasedActiveForm;
use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: jw
 * Date: 04/02/16
 * Time: 21:41
 */

$this->title = "Write review";
$this->params['breadcrumbs'][] = ['label' => 'Student', 'url' => ['student/index']];
$this->params['breadcrumbs'][] = "Write review";

?>

<h2> Choose the Student Assistant</h2>

<?php $form = RoleBasedActiveForm::begin() ?>

<div class="form-group">
<?= Html::DropDownList('receiver_id', 1,  ArrayHelper::map($sas, 'id', 'name')) ?>

</div>

<div class="form-group">
    <?= Html::submitButton('Continue', ['class' => 'btn btn-primary']) ?>
</div>

<?php RoleBasedActiveForm::end() ?>
