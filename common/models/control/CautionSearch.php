<?php

namespace common\models\control;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\Caution;

/**
 * CautionSearch represents the model behind the search form of `common\models\control\Caution`.
 */
class CautionSearch extends Caution
{
    private $_companyId;

    public function __construct($companyId, $config = [])
    {
        $this->_companyId = $companyId;
        parent::__construct($config);
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'control_company_id', 'caution_date', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['caution', 'caution_number', 'file', 'description'], 'safe'],
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
        $query = Caution::find()->where(['control_company_id' => $this->_companyId]);

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
            'caution_date' => $this->caution_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'caution', $this->caution])
            ->andFilterWhere(['like', 'caution_number', $this->caution_number])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
