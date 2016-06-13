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

$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['employee/index']];
$this->params['breadcrumbs'][] = "Create Vacancy";

?>

<h2> Choose your course</h2>

<?php $form = RoleBasedActiveForm::begin() ?>

<div class="form-group">
<?php if($mycourses){
    echo Html::DropDownList('course_id', 1,  ArrayHelper::map($mycourses, 'id', 'name'));
    echo "<br /> <br />";
    echo Html::submitButton('Create a Vacancy for above course', ['class' => 'btn btn-primary']);
}
else {
    echo "You have no courses available.";
    echo Html::hiddenInput("course_id", "none");
}
?>
</div>


<div class="form-group">
    <?= Html::submitButton('Create a Vacancy without a course', ['class' => 'btn btn-default']) ?>
</div>

<?php RoleBasedActiveForm::end() ?>
