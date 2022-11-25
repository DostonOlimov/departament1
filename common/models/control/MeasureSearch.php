<?php

namespace common\models\control;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\Measure;

/**
 * MeasureSearch represents the model behind the search form of `common\models\control\Measure`.
 */
class MeasureSearch extends Measure
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'control_company_id', 'type', 'date', 'quantity', 'amount', 'fine_amount', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['person', 'number_passport'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Measure::find();

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
            'control_company_id' => $this->control_company_id,
            'type' => $this->type,
            'date' => $this->date,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'fine_amount' => $this->fine_amount,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'person', $this->person])
            ->andFilterWhere(['like', 'number_passport', $this->number_passport]);

        return $dataProvider;
    }
}
