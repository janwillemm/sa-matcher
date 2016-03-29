<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 09/02/16
 * Time: 20:41
 */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use kartik\widgets\StarRating;

?>

<div class="review_view">
    <?= StarRating::widget([
        'name' => 'rating',
        'value' => $model->score,
        'pluginOptions' => [
            'readonly' => true,
            'showClear' => false,
            'showCaption' => false,
            'size' => 'xs',
        ],
    ]) ?>
    <p><bold>Beschrijving:</bold><?= HtmlPurifier::process($model->explanation) ?></p>
    <p><bold>Voor:</bold><?= Html::encode($model->vacancy->title) ?></p>
</div>


<style>
    .review_view {
        float:left;
        width:250px;
        height:150px;
        margin:25px;
        border:solid 1px black;
    }
    div.rating-disabled{
        cursor:default;
    }
    div.rating-xs{
        font-size:1em;
    }
</style>

<?php
/**
* This is the model class for table "review".
*
* @property integer $id
* @property integer $writer_id
* @property integer $receiver_id
* @property integer $vacancy_id
* @property integer $is_anonymous
* @property double $score
* @property string $explanation
* @property string $creation_date
*/
