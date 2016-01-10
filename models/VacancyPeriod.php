<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vacancy_period".
 *
 * @property integer $id
 * @property integer $duration_id
 * @property integer $vacancy_id
 */
class VacancyPeriod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacancy_period';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['duration_id', 'vacancy_id'], 'required'],
            [['duration_id', 'vacancy_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'internal id',
            'duration_id' => 'The duration',
            'vacancy_id' => 'The vacancy',
        ];
    }
}
