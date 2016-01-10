<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_work_preference".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $work_type_id
 */
class StudentWorkPreference extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_work_preference';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'work_type_id'], 'required'],
            [['student_id', 'work_type_id'], 'integer']
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
            'work_type_id' => 'Work type id',
        ];
    }
}
