<?php

namespace common\models\profilactic;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProAnswerCountrySearch represents the model behind the search form of `common\models\ProAnswerCountry`.
 */
class AnswerCountrySearch extends AnswerCountry
{
    private $answer_id;

    public function __construct($answer_id, $config = [])
    {
        $this->answer_id = $answer_id;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['id', 'country_id', 'pro_answer_id'], 'integer'],
        ];
    }

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
        $query = AnswerCountry::find()->where(['pro_answer_id' => $this->answer_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'country_id' => $this->country_id,
            'pro_answer_id' => $this->pro_answer_id,
        ]);

        return $dataProvider;
    }
}
