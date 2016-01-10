<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_leerlijn_preference".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $period_type_id
 */
class StudentLeerlijnPreference extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_leerlijn_preference';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'period_type_id'], 'required'],
            [['student_id', 'period_type_id'], 'integer']
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
            'period_type_id' => 'Period type id',
        ];
    }
}
