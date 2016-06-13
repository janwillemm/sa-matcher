<?php

namespace app\controllers\employee;

use app\controllers\EmployeeBaseController;
use app\helpers\VacancyRoleHelper;
use app\helpers\CourseRoleHelper;
use app\models\filter\VacancyFilter;
use app\models\Preferences;
use Yii;
use app\models\search\VacancySearch;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Vacancy;
use yii\data\ActiveDataProvider;
use yii\web\ForbiddenHttpException;

class VacancyController extends EmployeeBaseController {

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


    /**
     * Lists all Vacancy models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id = \Yii::$app->user->identity->id;
        $query = Vacancy::find()
            ->innerJoin("person_vacancy_role", 'vacancy.id = person_vacancy_role.vacancy_id')
            ->where(["person_vacancy_role.person_id" => $id])
            ->andWhere(["person_vacancy_role.role_id" => VacancyRoleHelper::OWNER]);

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
     * Displays a single Vacancy model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {
        return $this->render('view', [
            'model' => $this->findModel($_GET['id']),
        ]);
    }

    /**
     * Finds the Vacancy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vacancy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $personId = \Yii::$app->user->identity->id;
        $vacancyId = $id;
        $vacancy = Vacancy::find()
            ->innerJoin("person_vacancy_role", 'vacancy.id = person_vacancy_role.vacancy_id')
            ->where(["person_vacancy_role.person_id" => $personId])
            ->andWhere(["person_vacancy_role.role_id" => VacancyRoleHelper::OWNER])
            ->andWhere(["vacancy.id" => $vacancyId])
            ->one();
        if ($vacancy !== null) {
            return $vacancy;
        } else {
            throw new ForbiddenHttpException("You don't have access to this course");
        }
    }

    public function actionCreatenew(){
        $session = $this->getSession();

        $data = \Yii::$app->request->post();

        if(isset(\Yii::$app->request->post()['Vacancy'])){
            return  $this->createnewstep3();
        }

        if(isset($data['course_id'])){
            return $this->createnewstep2($data['course_id']);
        }

        return $this->createnewstep1();
    }

    public function createnewstep1(){
        // Step 1: Determine if course based vacancy
        $courses = $this->getCurrentUser()->getCoursesForRole(CourseRoleHelper::EMPLOYEE);

        return $this->render("pickCourse", [
            'mycourses' => $courses,
        ]);
    }

    public function createnewstep2($course_id){
        $session = $this->getSession();
        $session->set('create-new-vacancy-course-id', $course_id);

        $model = new Vacancy();
        $model->preferences = new Preferences();

        return $this->render("create", [
            'model' => $model,
        ]);
    }

    public function createnewstep3(){
        $model = new Vacancy();
        $preferences = new Preferences();
        $data = Yii::$app->request->post();
        $model->load($data);

        $preferences->load($data);


        $transaction = \Yii::$app->db->beginTransaction();
        try {
            //TODO check for errors and cancel transaction
            $model->save();

            $model->savePreferences($preferences);

            $connection = \Yii::$app->db;

            // TODO Place this in preferences logic
            $connection
                ->createCommand(
                    "INSERT INTO person_vacancy_role (person_id, vacancy_id, role_id) " .
                    "VALUES (:person_id, :vacancy_id, :role_id)")
                ->bindValues([
                    ":person_id" => \YII::$app->getUser()->getIdentity()->getId(),
                    ":vacancy_id" => $model->getPrimaryKey(),
                    ":role_id" => VacancyRoleHelper::OWNER
                ])
                ->execute();

            // Vacanty - course_id
            $course_id = $this->getSession()['create-new-vacancy-course-id'];
            if(isset($course_id) && $course_id != "none") {
                $connection
                    ->createCommand("INSERT INTO course_vacancy (course_id, vacancy_id) VALUES (:course_id, :vacancy_id)")
                    ->bindValues([
                        ":course_id" => $course_id,
                        ":vacancy_id" => $model->getPrimaryKey(),
                    ])
                    ->execute();
            }

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $this->actionView($model->id);
    }

    public function actionUpdate(){

        $model = $this->findModel($_GET['id']);
        $model->getPreferences();

        if(isset($_POST['Preferences'])){
            // TODO Safety measures
            // Now the id etc can be changed
            $model->load(Yii::$app->request->post());
            $model->save();
            $model->preferences->load(Yii::$app->request->post());
            $model->savePreferences($model->preferences);

            return Yii::$app->getResponse()->redirect(["employee/vacancy/view", 'id'=>$_GET['id']]);
        }



        return $this->render("update", [
            "model" => $model,
        ]);
    }

}