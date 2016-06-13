<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 30/04/16
 * Time: 16:49
 */

namespace app\models;

use yii\helpers\ArrayHelper;
use app\models\PeriodType;
use app\models\WorkType;
use app\models\Course;


class Preferences extends \Yii\base\Model
{
    public $durations;
    public $workTypes;
    public $courses;

    public function rules()
    {
        return [
            [['durations', 'workTypes', 'courses'], 'safe'],
        ];
    }

    public static function getDurationsList(){
        $periods = PeriodType::find()->all();
        return ArrayHelper::map($periods, 'id', 'duration');
    }

    public static function getWorkTypesList(){
        $workTypes = WorkType::find()->all();
        return ArrayHelper::map($workTypes, 'id', 'type');
    }

    public static function getCoursesList(){
        $courses = Course::find()->all();
        return ArrayHelper::map($courses, 'id', 'tud_id');
    }

    public function fillForUser(Person $user){
        $this->durations = []; $this->workTypes = []; $this->courses = [];

        foreach($user->getWorkPreferences() as $workPref){

            $this->workTypes[] = $workPref["id"];
        }

        foreach($user->getPeriodPreferences() as $periodPref){
            $this->durations[] = $periodPref["id"];
        }

        foreach($user->getCoursePreferences() as $coursePref){
            $this->courses[] = $coursePref["id"];
        }

    }

    public function saveForUser($user){
        // Remove them all
        // Course_role_type
        $connection = \Yii::$app->getDb();

        // Delete current course_vacancy connections
        $connection
            ->createCommand("DELETE FROM student_course_preference WHERE student_id=:student_id")
            ->bindValue(":student_id",$user->getId())
            ->execute();
        $connection
            ->createCommand("DELETE FROM student_period_preference WHERE student_id=:student_id")
            ->bindValue(":student_id",$user->getId())
            ->execute();
        $connection
            ->createCommand("DELETE FROM student_work_preference WHERE student_id=:student_id")
            ->bindValue(":student_id",$user->getId())
            ->execute();

        // @TODO create more efficient queries
        if(is_array($this->workTypes)){
            foreach($this->workTypes as $work_type) {
                $connection
                    ->createCommand("INSERT INTO student_work_preference (student_id, work_type_id) VALUES (:student_id, :work_type_id)")
                    ->bindValue(":student_id", $user->getPrimaryKey())
                    ->bindValue(":work_type_id", $work_type)
                    ->execute();
            }
        }

        if(is_array($this->durations)){
            foreach($this->durations as $duration){
                $connection
                    ->createCommand("INSERT INTO student_period_preference (student_id, period_type_id) VALUES (:student_id, :duration_id)")
                    ->bindValue(":student_id", $user->getPrimaryKey())
                    ->bindValue(":duration_id", $duration)
                    ->execute();
            }
        }
        if(is_array($this->courses)) {
            foreach ($this->courses as $course) {
                $connection
                    ->createCommand("INSERT INTO student_course_preference (student_id, course_type_id) VALUES (:student_id, :course_id)")
                    ->bindValue(":student_id", $user->getPrimaryKey())
                    ->bindValue(":course_id", $course)
                    ->execute();
            }
        }
        return;
    }

    public function fillForVacancy($vacancy){

    }


}