<?php

namespace common\models\profilactic;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProAnswerSearch represents the model behind the search form of `common\models\ProAnswer`.
 */
class AnswerSearch extends Answer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pro_company_id', 'import_export', 'lab_check', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['product_name', 'internation_standard', 'product_quality', 'employee', 'smk', 'international_certificate', 'level', 'import_export_product'], 'safe'],
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
        $query = Answer::find();

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
            'import_export' => $this->import_export,
            'lab_check' => $this->lab_check,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'internation_standard', $this->internation_standard])
            ->andFilterWhere(['like', 'product_quality', $this->product_quality])
            ->andFilterWhere(['like', 'employee', $this->employee])
            ->andFilterWhere(['like', 'smk', $this->smk])
            ->andFilterWhere(['like', 'international_certificate', $this->international_certificate])
            ->andFilterWhere(['like', 'level', $this->level])
            ->andFilterWhere(['like', 'import_export_product', $this->import_export_product]);

        return $dataProvider;
    }
}
