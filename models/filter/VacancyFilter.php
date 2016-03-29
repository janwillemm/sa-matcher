<?php
namespace app\models\filter;

use app\models\PeriodType;
use app\models\WorkType;
use app\models\Course;
use yii\helpers\ArrayHelper;
use app\models\Vacancy;
use yii\data\ActiveDataProvider;

/**
 * Created by PhpStorm.
 * User: jw
 * Date: 06/02/16
 * Time: 16:48
 */


class VacancyFilter extends \yii\base\Model{

    public $durations;
    public $workTypes;
    public $courses;

    public $max_hours;

    public function rules()
    {
        return [
            [['durations', 'workTypes', 'courses', 'max_hours'], 'safe'],
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


    public function dataProvider(){

        $query = Vacancy::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

//        $query->andFilterWhere([
//            'hours_per_week' => $this->hours_per_week,
//        ]);

        // Checkboxes

        $query
            ->andFilterWhere(['type_work_id' => $this->workTypes])
            ->andFilterWhere(['<=', 'hours_per_week', $this->max_hours]);

        // TODO: Multiple period types. Or/AND relation? Show all durations
        $query->joinWith(['periodTypes' => function ($q) {
            $q->andFilterWhere(['period_type.id' => $this->durations]);
        }]);

        $query->joinWith(['course' => function ($q) {
            $q->andFilterWhere(['course.id' => $this->courses]);
        }]);

        return $dataProvider;
    }

}