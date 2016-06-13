<?php

namespace app\models;

use Yii;
use app\helpers\VacancyRoleHelper;

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

    public $preferences;

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
            [['title', 'description', 'requirements', 'open_date', 'expire_date', 'hours_per_week', 'num_of_sa_needed'], 'required'],
            [['description', 'requirements'], 'string'],
            //[['open_date', 'expire_date'], 'safe'],
            [['id', 'hours_per_week', 'num_of_sa_needed', 'type_work_id', 'is_open'], 'integer'],
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
            'title' => 'Title',
            'description' => 'Description',
            'requirements' => 'Requirements',
            'open_date' => 'Creation date',
            'expire_date' => 'Expire date',
            'is_open' => 'Publish online',
            'hours_per_week' => 'Hours/week per SA',
            'num_of_sa_needed' => 'Number of SA\'s needed',
            'contact_email' => 'Contact Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery WorkType
     */
    public function getWorkTypes(){
        return $this->hasMany(WorkType::className(), ['id' => 'work_type_id'])
            ->viaTable('vacancy_work_type', ['vacancy_id' => 'id']);
    }

    public function getCourse(){
        return $this->hasOne(Course::className(), ['id' => 'course_id'])
            ->viaTable('course_vacancy', ['vacancy_id' => 'id']);
    }

    /**
     * @return The PeriodTypes
     */
    public function getPeriodTypes(){
        return $this->hasMany(PeriodType::className(), ['id' => 'duration_id'])
            ->viaTable('vacancy_period', ['vacancy_id' => 'id']);
    }

    public function getStudentAssistents(){
        return $this->hasMany(Person::className(), ['id' => 'person_id'])
            ->viaTable('person_vacancy_role', ['vacancy_id' => 'id'],
                function($query){
                    $query->onCondition(['role_id' => VacancyRoleHelper::STUDENTASSISTANT]);
                }
            );
    }

    public function getOwners(){
        return $this->hasMany(Person::className(), ['id' => 'person_id'])
            ->viaTable('person_vacancy_role', ['vacancy_id' => 'id'],
                function($query){
                    $query->onCondition(['role_id' => VacancyRoleHelper::OWNER]);
                }
            );
    }

    public function getReviews(){
        return $this->hasMany(Review::className(), ['vacancy_id'=>'id']);
    }

    public function savePreferences($preferences){
        // Remove them all
        // Course_role_type
        $connection = \Yii::$app->getDb();

        // Delete current course_vacancy connections
        $connection
            ->createCommand("DELETE FROM vacancy_work_type WHERE vacancy_id=:vacancy_id")
            ->bindValue(":vacancy_id",$this->getPrimaryKey())
            ->execute();
        $connection
            ->createCommand("DELETE FROM vacancy_period WHERE vacancy_id=:vacancy_id")
            ->bindValue(":vacancy_id",$this->getPrimaryKey())
            ->execute();

        // @TODO create more efficient queries
        foreach($preferences->workTypes as $work_type) {
            $connection
                ->createCommand("INSERT INTO vacancy_work_type (vacancy_id, work_type_id) VALUES (:vacancy_id, :work_type_id)")
                ->bindValue(":vacancy_id", $this->getPrimaryKey())
                ->bindValue(":work_type_id", $work_type)
                ->execute();
        }

        foreach($preferences->durations as $duration){
            $connection
                ->createCommand("INSERT INTO vacancy_period (vacancy_id,duration_id) VALUES (:vacancy_id, :duration_id)")
                ->bindValue(":vacancy_id", $this->getPrimaryKey())
                ->bindValue(":duration_id", $duration)
                ->execute();
        }
        return;
    }

//
//    public function getWorkPreferences(){
//        return $this->hasMany(WorkType::className(), ['id' => 'work_type_id'])
//            ->viaTable('vacancy_work_type', ['vacancy_id' => 'id'])->all();
//    }
//
//    public function getPeriodPreferences(){
//        return $this->hasMany(PeriodType::className(), ['id' => 'duration_id'])
//            ->viaTable('vacancy_period', ['vacancy_id' => 'id'])->all();
//    }


    public function getPreferences(){
        $this->preferences = new Preferences();
        $this->preferences->workTypes = $this->getWorkTypes()->all();
        $this->preferences->durations = $this->getPeriodTypes()->all();
        return $this->preferences;
    }
}
