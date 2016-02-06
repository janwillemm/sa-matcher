<?php

namespace app\models;

use Yii;
use app\helpers\CourseRoleHelper;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $tud_id
 * @property integer $name
 * @property integer $leerlijn_id
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tud_id', 'name', 'leerlijn_id'], 'required'],
            [[ 'leerlijn_id'], 'integer'],
            [['name', 'tud_id'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tud_id' => 'Tud ID',
            'name' => 'Name',
            'leerlijn_id' => 'LeerlijnID',
        ];
    }

    /**
     * @return The vacancies this Course has available
     */
    public function getVacancies(){
        return $this->hasMany(Vacancy::className(), ['id' => 'course_id'])->viaTable('course_vacancy', ['vacancy_id' => 'id']);
    }

    /**
     * Returns the Leerlijn of this course
     *
     * @return \yii\db\ActiveQuery Leerlijn
     */
    public function getLeerlijn(){
        return $this->hasOne(LeerlijnType::className(), ['leerlijn_id' => 'id']);
    }

    /**
     * Returns all studentAssistants for this course
     *
     * @return \yii\db\ActiveQuery Person
     */
    public function getStudentAssistants(){
        return $this->hasMany(Person::className(), ['id' => 'person_id'])
            ->viaTable('person_course_role', ['course_id' => 'id'],
                function($query){
                    $query->onCondition(['role_id' => CourseRoleHelper::STUDENTASSISTANT]);
                }
            );

    }
}
