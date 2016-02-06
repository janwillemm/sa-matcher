<?php

use yii\bootstrap\Html;
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 05/02/16
 * Time: 17:11
 */

?>
<div class="review-create">

    <h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

</div>
