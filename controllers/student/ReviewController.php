<?php

namespace app\controllers\student;

use app\controllers\StudentBaseController;
use app\models\Course;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use app\models\Review;
use app\models\Vacancy;
use yii\data\ActiveDataProvider;


/**
 * ReviewController implements the actions a Student can do
 */
class ReviewController extends StudentBaseController
{
    /**
     * Lists all your student Review models.
     * @return mixed
     */
    public function actionIndex()
    {
        // Show only your reviews
        // Now hardcoded user ID = 1 which is a student
        $student_ID = \Yii::$app->user->identity->getId();


        // Get the AVG score
        $avgScore = Review::find()->where(['receiver_id' => $student_ID ])->average('score');
        Yii::trace($avgScore);

        // Get the reviews
        $query = Review::find()->where(['receiver_id' => $student_ID ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'avgScore' => $avgScore,
        ]);
    }

    /**
     * Shows the end user the different steps to create a review.
     * The first stiep is picking a course
     * The second step is picking a student you want to review
     * The third step is writing the review.
     *
     * The model is stored in a session to  transfer information between steps
     * so the user won't be able to change hidden input fields.
     *
     * @return mixed
     */
    public function actionCreate(){
        // Get/create the session in which we'll store the model
        $session = Yii::$app->session;
        if (!$session->isActive)
            $session->open();

        // Get/create the model
        $model = $session->get("review_model");
        if(!$model){
            $model = new Review();
            $session->set("review_model",  $model);
        }

        // Fill the model with post data
        $data = Yii::$app->request->post();
        $model->load($data);

        // If the review is written, the last step
        // Save the model
        if(isset($data['step'])){
            if($model->save()) {
                // TODO: Show saved correctly message
                $session->remove("review_model");
                return \Yii::$app->getResponse()->redirect("/student/index");
            }
            else {
                // TODO: Error handling
                return $this->render('writeReview', [
                    'model' => $model
                ]);
            }
        }

        // If the student is chosen, show write review page
        if(isset($data['receiver_id'])){
            return $this->_createReview($model, $data['receiver_id']);
        }
        // If a course is chosen, show the student page.
        // Also store the course id, to use in the create_review part,
        // which is used to find the vacancy the student is working for
        if(isset($data['course_id'])){
            $session->set('create_review_session', $data['course_id']);
            return $this->_pickStudentAssistant($model, $data['course_id']);
        }

        // show the pick course page
        return $this->_pickCourse($model);

    }

    /**
     *
     * Shows the course picking page
     * @param $model
     * @return string
     */
    private function _pickCourse($model){
        // TODO: only show courses the student is following or has recently followed
        $models = Course::find()->all();
        return $this->render('pickCourse', [
            'model' => $model,
            'models' => $models
        ]);
    }

    /**
     * Show the student assistant picking page
     *
     * @param $model
     * @param $course_id
     * @return string
     */
    private function _pickStudentAssistant($model, $course_id){
        // Fetch all students assistants
        $course = Course::findOne($course_id);


        return $this->render('pickSA', [
            'model' => $model,
            'sas' => $course->studentAssistants, // Get the students assitants for this course
        ]);

    }

    private function _createReview($model, $student_id){
        $model->writer_id = \Yii::$app->user->identity->getId();
        $model->receiver_id = $student_id;

        // TODO: fix date!
        $model->creation_date = "NOW()";

        $session = Yii::$app->session;
        $courseID = $session->get('create_review_session');

        // Get vacancy id from student Assistant for the course.
        // SELECT *
        // FROM vacancy
        // WHERE id IN
        //      (SELECT pcr.vancacy_id FROM person_vacancy_role as pcr WHERE pcr.person_id = $student_id)
        // AND id in
        //      (SELECT cvr.vacancy_id FROM course_vacancy as cvr WHERE cvr.course_id = $courseID)

        $pcrSubQuery = (new Query())
            ->select("vacancy_id")
            ->from("person_vacancy_role")
            ->where(["person_id" => $student_id ]);
        $cvSubQuery = (new Query())
            ->select("vacancy_id")
            ->from("course_vacancy")
            ->where(["course_id" => $courseID]);

        $vacancy = Vacancy::find()
            ->where(["in", "id", $pcrSubQuery])
            ->andWhere(["in", "id", $cvSubQuery])
            ->one();

        $model->vacancy_id = $vacancy->id;
        $this->getSession()["review_model"] = $model;
        return $this->render('writeReview', [
            'model' => $model
        ]);


    }

}