<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 30/03/16
 * Time: 09:27
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\HTML;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>

<h1>Preferences page</h1>

<?= $form->field($model, 'emailaddress') ?>

<?= $form->field($model, 'periodPreferences[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']) ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
