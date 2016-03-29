<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vacancy;

/**
 * VacancySearch represents the model behind the search form about `app\models\Vacancy`.
 */
class VacancySearch extends Vacancy
{
    public $workType;
    public $periodTypes;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_open', 'hours_per_week', 'num_of_sa_needed', 'type_work_id', 'period_id'], 'integer'],
            [['title', 'description', 'requirements', 'open_date', 'expire_date', 'contact_email', 'workType', 'periodTypes'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    // TODO: http://www.yiiframework.com/wiki/653/displaying-sorting-and-filtering-model-relations-on-a-gridview/

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Vacancy::find();

        $query->joinWith(['workType']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);



        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'hours_per_week' => $this->hours_per_week,
        ]);

        // Checkboxes

        $query->andFilterWhere(['like', 'contact_email', $this->contact_email])
            ->andFilterWhere(['like', 'work_type.type', $this->workType])
            ->andFilterWhere(['like', 'period_type.duration', $this->periodTypes]);
        // filter by country name

        return $dataProvider;
    }
}
