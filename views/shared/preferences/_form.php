<?php

use yii\helpers\Html;
use app\models\Preferences;
use yii\widgets\ActiveForm;



?>
<div class="preferences">
<?= $form->field($model, 'durations')->checkboxlist(Preferences::getDurationsList()) ?>

<?= $form->field($model, 'workTypes')->checkboxlist(Preferences::getWorkTypesList()) ?>

<?= !$no_courses ? $form->field($model, 'courses')->checkboxlist(Preferences::getCoursesList()) : "" ?>
</div>


