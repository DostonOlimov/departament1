<?php

namespace common\models\control;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\Identification;

/**
 * IdentificationSearch represents the model behind the search form of `common\models\control\Identification`.
 */
class IdentificationSearch extends Identification
{
    private $_companyId;

    public function __construct($companyId, $config = [])
    {
        $this->_companyId = $companyId;
        parent::__construct($config);
    }


    public function rules()
    {
        return [
            [['id', 'control_company_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['file', 'identification'], 'safe'],
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
        $query = Identification::find()->where(['control_company_id' => $this->_companyId]);

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
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'identification', $this->identification]);

        return $dataProvider;
    }
}
