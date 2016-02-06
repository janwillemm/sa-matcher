<?php

use \app\controllers\extensions\RoleBasedActiveForm;
use \kartik\widgets\StarRating;
use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: jw
 * Date: 05/02/16
 * Time: 17:12
 */

?>

<div class="review-form">

    <?php $form = RoleBasedActiveForm::begin(); ?>

    <?= $form->field($model, 'is_anonymous')->checkBox() ?>

    <?= $form->field($model, 'score')->widget(StarRating::className(), ['pluginOptions' => ['size'=>'sm']]) ?>

    <?= $form->field($model, 'explanation')->textarea(['rows' => 6]) ?>

    <input type="hidden" value="create" name="step" />

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php RoleBasedActiveForm::end(); ?>

</div>