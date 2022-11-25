<?php

namespace common\models\profilactic;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\profilactic\Result;

/**
 * ResultSearch represents the model behind the search form of `common\models\profilactic\Result`.
 */
class ResultSearch extends Result
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pro_company_id', 'help_count', 'active_count', 'standard_count', 'certificate_text', 'measure_help_count', 'import_export', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['help_name', 'active_name', 'standard_name', 'certificate_help', 'measure_help_name', 'import_export_text', 'smk', 'smk_text', 'decision', 'decision_text', 'problem', 'people'], 'safe'],
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
        $query = Result::find();

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
            'pro_company_id' => $this->pro_company_id,
            'help_count' => $this->help_count,
            'active_count' => $this->active_count,
            'standard_count' => $this->standard_count,
            'certificate_text' => $this->certificate_text,
            'measure_help_count' => $this->measure_help_count,
            'import_export' => $this->import_export,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'help_name', $this->help_name])
            ->andFilterWhere(['like', 'active_name', $this->active_name])
            ->andFilterWhere(['like', 'standard_name', $this->standard_name])
            ->andFilterWhere(['like', 'certificate_help', $this->certificate_help])
            ->andFilterWhere(['like', 'measure_help_name', $this->measure_help_name])
            ->andFilterWhere(['like', 'import_export_text', $this->import_export_text])
            ->andFilterWhere(['like', 'smk', $this->smk])
            ->andFilterWhere(['like', 'smk_text', $this->smk_text])
            ->andFilterWhere(['like', 'decision', $this->decision])
            ->andFilterWhere(['like', 'decision_text', $this->decision_text])
            ->andFilterWhere(['like', 'problem', $this->problem])
            ->andFilterWhere(['like', 'people', $this->people]);

        return $dataProvider;
    }
}
