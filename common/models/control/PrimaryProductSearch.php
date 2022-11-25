<?php

namespace common\models\control;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\PrimaryProduct;

/**
 * PrimaryProductSearch represents the model behind the search form of `common\models\control\PrimaryProduct`.
 */
class PrimaryProductSearch extends PrimaryProduct
{
    public $primaryDataId;

    public function __construct($primaryDataId, $config = [])
    {
        $this->primaryDataId = $primaryDataId;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['id', 'control_primary_data_id', 'date_from', 'date_to'], 'integer'],
            [['product_type_id', 'nd', 'nd_type', 'number_blank', 'number_reestr'], 'safe'],
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
        $query = PrimaryProduct::find()->where(['control_primary_data_id' => $this->primaryDataId]);

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
            'control_primary_data_id' => $this->control_primary_data_id,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
        ]);

        $query->andFilterWhere(['like', 'product_type_id', $this->product_type_id])
            ->andFilterWhere(['like', 'nd', $this->nd])
            ->andFilterWhere(['like', 'nd_type', $this->nd_type])
            ->andFilterWhere(['like', 'number_blank', $this->number_blank])
            ->andFilterWhere(['like', 'number_reestr', $this->number_reestr]);

        return $dataProvider;
    }
}
