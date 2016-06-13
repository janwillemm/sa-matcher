<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 22/05/16
 * Time: 18:14
 */
namespace app\controllers\employee;

use yii\data\SqlDataProvider;
use app\models\Person;

class MatchController extends \app\controllers\EmployeeBaseController{


    public function actionView(){
        $id = \Yii::$app->getRequest()->get()['match'];
        $vacancy = \Yii::$app->getRequest()->get()['vacancy'];
        $person = Person::findOne($id);
        return $this->render("view", ["person" => $person]);
    }


    public function actionShowmatches(){
        $id = \Yii::$app->getRequest()->get()['vacancy'];
        $query = "
            FROM
                ( SELECT
                    student_id,
                    count(wp.student_id) as total
                FROM
                    student_work_preference as wp
                WHERE
                    wp.work_type_id IN (
                        SELECT
                            work_type_id
                        FROM
                            vacancy_work_type
                        WHERE
                            vacancy_id = :vacancy_id
                    )
                group by
                    wp.student_id
              UNION ALL
                SELECT
                    student_id,
                    count(dur.student_id) as total
                FROM
                    student_period_preference as dur
                WHERE
                    dur.period_type_id IN (
                        SELECT
                            duration_id
                        FROM
                            vacancy_period
                        WHERE
                            vacancy_id = :vacancy_id
                    )
                group by
                    dur.student_id
              UNION ALL
                SELECT
                    student_id,
                    count(course.student_id) as total
                FROM
                    student_course_preference as course
                WHERE
                    course.course_type_id IN(
                        SELECT
                            course_id
                        FROM
                            course_vacancy
                        WHERE
                            vacancy_id = :vacancy_id
                    )
                ) as thing
            INNER JOIN person on thing.student_id = person.id
            GROUP BY
                thing.student_id";

        $countQuery = "SELECT
                count(*) " . $query;
        $totalCount = \YII::$app->getDb()->createCommand($countQuery)->bindValue(":vacancy_id", $id)->queryScalar();

        $fetchQuery = "            SELECT
                SUM(total) as score,
                person.* " . $query;
        $provider = new SqlDataProvider([
            'sql' => $fetchQuery,
            'params' => [':vacancy_id' => $id],
            'totalCount' => $totalCount,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'score',
                    'reviewScore',
                    'name',
                ],
            ],
        ]);

        return $this->render("matches", ["provider" => $provider]);

    }
}