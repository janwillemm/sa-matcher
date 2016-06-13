<?php

namespace app\controllers\employee;

use app\controllers\EmployeeBaseController;
use app\helpers\CourseRoleHelper;
use Yii;
use app\models\Course;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends EmployeeBaseController
{

    /**
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {

        $id = \Yii::$app->user->identity->id;
        $query = Course::find()
            ->innerJoin("person_course_role", 'course.id = person_course_role.course_id')
            ->where(["person_course_role.person_id" => $id])
            ->andWhere(["person_course_role.role_id" => CourseRoleHelper::EMPLOYEE]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Course model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {
        $courseID = $_GET['id'];
        $id = \Yii::$app->user->identity->id;
        $model = Course::find()
            ->innerJoin("person_course_role", 'course.id = person_course_role.course_id')
            ->where(["person_course_role.person_id" => $id])
            ->andWhere(["person_course_role.role_id" => CourseRoleHelper::EMPLOYEE])
            ->andWhere(["course.id" => $courseID])->one();
        if(!$model){
            throw new ForbiddenHttpException("You have no access to this course");
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
