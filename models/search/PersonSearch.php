<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Person;

/**
 * PersonSearch represents the model behind the search form about `app\models\Person`.
 */
class PersonSearch extends Person
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'person_type_id', 'tud_id'], 'integer'],
            [['name', 'emailaddress', 'picture', 'register_date'], 'safe'],
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
        $query = Person::find();

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
            'register_date' => $this->register_date,
            'person_type_id' => $this->person_type_id,
            'tud_id' => $this->tud_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'emailaddress', $this->emailaddress])
            ->andFilterWhere(['like', 'picture', $this->picture]);

        return $dataProvider;
    }
}
