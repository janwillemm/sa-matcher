<?php

namespace app\controllers\student;

use app\models\filter\VacancyFilter;
use Yii;
use app\models\search\VacancySearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Vacancy;

class VacancyController extends Controller {
    // TODO: Check if person is a student
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
//        $searchModel = new VacancySearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $filterModel = new VacancyFilter();

        $filterModel->load(Yii::$app->request->post(), 'VacancyFilter');

        $dataProvider = $filterModel->dataProvider();



        return $this->render('index', [
            'filterModel' => $filterModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vacancy model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        if (($model = Vacancy::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}