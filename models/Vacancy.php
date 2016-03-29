<?php

namespace app\models;

use Yii;
use Yii\helpers\VacancyRoleHelper;

/**
 * This is the model class for table "vacancy".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $requirements
 * @property string $open_date
 * @property string $expire_date
 * @property integer $is_open
 * @property integer $hours_per_week
 * @property integer $num_of_sa_needed
 * @property integer $type_work_id
 * @property string $contact_email
 */
class Vacancy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacancy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'requirements', 'open_date', 'expire_date', 'is_open', 'hours_per_week', 'num_of_sa_needed', 'type_work_id', 'contact_email'], 'required'],
            [['description', 'requirements'], 'string'],
            [['open_date', 'expire_date'], 'safe'],
            [['is_open', 'hours_per_week', 'num_of_sa_needed', 'type_work_id'], 'integer'],
            [['title', 'contact_email'], 'string', 'max' => 257]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Vacature id intern',
            'title' => 'The title, max 257 characters',
            'description' => 'Describes the vacancy',
            'requirements' => 'States the requirements',
            'open_date' => 'The date of creation of the vavancy. Should reset when the vacancy is reopened',
            'expire_date' => 'The date of expirement. If due, should close the vacancy',
            'is_open' => 'Shows if the vacancy is open for applications',
            'hours_per_week' => 'Describes the number of hours per week needed for one SA',
            'num_of_sa_needed' => 'Describes how many SA\'s are needed',
            'type_work_id' => 'Links to the type of work available',
            'contact_email' => 'Contact Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery WorkType
     */
    public function getWorkType(){
        return $this->hasOne(WorkType::className(), ['id' => 'type_work_id']);
    }

    public function getCourse(){
        return $this->hasOne(Course::className(), ['id' => 'course_id'])->viaTable('course_vacancy', ['vacancy_id' => 'id']);
    }

    /**
     * @return The PeriodTypes
     */
    public function getPeriodTypes(){
        return $this->hasMany(PeriodType::className(), ['id' => 'duration_id'])->viaTable('vacancy_period', ['vacancy_id' => 'id']);
    }

    public function getStudentAssistents(){
        return $this->hasMany(Person::className(), ['id' => 'vacancy_id'])
            ->viaTable('person_vacancy_role', ['person_id' => 'id'],
                function($query){
                    $query->onCondition(['role_id' => VacancyRoleHelper::STUDENTASSISTANT]);
                }
            );
    }

    public function getOwners(){
        return $this->hasMany(Person::className(), ['id' => 'vacancy_id'])
            ->viaTable('person_vacancy_role', ['person_id' => 'id'],
                function($query){
                    $query->onCondition(['role_id' => VacancyRoleHelper::OWNER]);
                }
            );
    }

    public function getReviews(){
        return $this->hasMany(Review::className(), ['vacancy_id'=>'id']);
    }
}
