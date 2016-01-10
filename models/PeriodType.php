<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "period_type".
 *
 * @property integer $id
 * @property string $duration
 */
class PeriodType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'period_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['duration'], 'required'],
            [['duration'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Internal identifier',
            'duration' => 'The period of an vacancy',
        ];
    }
}
