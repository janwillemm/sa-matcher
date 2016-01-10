<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_period_preference".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $leerlijn_type_id
 */
class StudentPeriodPreference extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_period_preference';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'leerlijn_type_id'], 'required'],
            [['student_id', 'leerlijn_type_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Person id',
            'leerlijn_type_id' => 'Leerlijn type id',
        ];
    }
}
