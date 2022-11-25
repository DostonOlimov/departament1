<?php

namespace common\models\shopping;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\shopping\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\shopping\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'shopping_company_id', 'quantity', 'cost', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'photo', 'photo_chek'], 'safe'],
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
        $query = Product::find();

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
            'shopping_company_id' => $this->shopping_company_id,
            'quantity' => $this->quantity,
            'cost' => $this->cost,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'photo_chek', $this->photo_chek]);

        return $dataProvider;
    }
}
