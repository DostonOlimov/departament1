<?php

namespace common\models\control;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\PrimaryData;

/**
 * PrimaryDataSearch represents the model behind the search form of `common\models\control\PrimaryData`.
 */
class PrimaryDataSearch extends PrimaryData
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'control_company_id', 'count', 'compared_count', 'invalid_count', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['certificate', 'residue_quantity', 'residue_amount', 'potency', 'year_quantity', 'year_amount'], 'safe'],
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
        $query = PrimaryData::find();

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
            'count' => $this->count,
            'compared_count' => $this->compared_count,
            'invalid_count' => $this->invalid_count,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'certificate', $this->certificate])
            ->andFilterWhere(['like', 'residue_quantity', $this->residue_quantity])
            ->andFilterWhere(['like', 'residue_amount', $this->residue_amount])
            ->andFilterWhere(['like', 'potency', $this->potency])
            ->andFilterWhere(['like', 'year_quantity', $this->year_quantity])
            ->andFilterWhere(['like', 'year_amount', $this->year_amount]);

        return $dataProvider;
    }
}
