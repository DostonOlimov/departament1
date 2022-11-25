<?php

namespace common\models\profilactic;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProAnswerStandardCountSearch represents the model behind the search form of `common\models\ProAnswerStandardCount`.
 */
class AnswerStandardCountSearch extends AnswerStandardCount
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
            [['id', 'pro_answer_id', 'type'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = AnswerStandardCount::find()->where(['pro_answer_id' => $this->answer_id]);

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
            'pro_answer_id' => $this->pro_answer_id,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
