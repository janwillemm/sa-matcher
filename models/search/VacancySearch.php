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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_open', 'hours_per_week', 'num_of_sa_needed', 'type_work_id', 'period_id'], 'integer'],
            [['title', 'description', 'requirements', 'open_date', 'expire_date', 'contact_email'], 'safe'],
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
            'id' => $this->id,
            'open_date' => $this->open_date,
            'expire_date' => $this->expire_date,
            'is_open' => $this->is_open,
            'hours_per_week' => $this->hours_per_week,
            'num_of_sa_needed' => $this->num_of_sa_needed,
            'type_work_id' => $this->type_work_id,
            'period_id' => $this->period_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'requirements', $this->requirements])
            ->andFilterWhere(['like', 'contact_email', $this->contact_email]);

        return $dataProvider;
    }
}
