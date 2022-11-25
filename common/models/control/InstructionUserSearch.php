<?php

namespace common\models\control;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\InstructionUser;

/**
 * InstructionUserSearch represents the model behind the search form of `common\models\control\InstructionUser`.
 */
class InstructionUserSearch extends InstructionUser
{
    private $_iuId;

    public function __construct($iuId, $config = [])
    {
        $this->_iuId = $iuId;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['id', 'user_id', 'instruction_id'], 'integer'],
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
        $query = InstructionUser::find()->where(['instruction_id' => $this->_iuId]);

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
            'user_id' => $this->user_id,
            'instruction_id' => $this->instruction_id,
        ]);

        return $dataProvider;
    }
}
