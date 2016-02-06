<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 04/02/16
 * Time: 21:09
 */


use yii\widgets\DetailView;
use yii\widgets\LinkPager;
use yii\helpers\Html;

/* @var $this yii\web\View */

?>

<h1> Reviews</h1>
<?= Html::a('Create new review', ['create'], ['class'=>'btn btn-success float']) ?>
<br />
    <h2> My reviews</h2>
<?php
foreach($models as $model){
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'receiver_id',
            'is_anonymous',
            'score',
            'explanation:ntext',
            'creation_date',
        ],
    ]) ?>
    <hr />
<?php } ?>

<?= LinkPager::widget(['pagination' => $pages]) ?>