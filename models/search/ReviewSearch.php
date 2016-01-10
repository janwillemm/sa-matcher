<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Review;

/**
 * ReviewSearch represents the model behind the search form about `app\models\Review`.
 */
class ReviewSearch extends Review
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'writer_id', 'receiver_id', 'vacancy_id', 'is_anonymous'], 'integer'],
            [['score'], 'number'],
            [['explanation', 'creation_date'], 'safe'],
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
        $query = Review::find();

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
            'writer_id' => $this->writer_id,
            'receiver_id' => $this->receiver_id,
            'vacancy_id' => $this->vacancy_id,
            'is_anonymous' => $this->is_anonymous,
            'score' => $this->score,
            'creation_date' => $this->creation_date,
        ]);

        $query->andFilterWhere(['like', 'explanation', $this->explanation]);

        return $dataProvider;
    }
}
