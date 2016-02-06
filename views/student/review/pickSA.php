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

?>

<h2> Choose your course</h2>

<?php $form = RoleBasedActiveForm::begin() ?>

<div class="form-group">
<?= Html::DropDownList('course_id', 1,  ArrayHelper::map($models, 'id', 'name')) ?>

</div>

<div class="form-group">
    <?= Html::submitButton('Continue', ['class' => 'btn btn-primary']) ?>
</div>

<?php RoleBasedActiveForm::end() ?>
