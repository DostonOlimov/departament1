<?php

namespace common\models\control;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\Instruction;
use yii\db\ActiveQuery;

/**
 * InstructionSearch represents the model behind the search form of `common\models\control\Instruction`.
 */
class InstructionSearch extends Instruction
{
    public $userId;
    public $region_id;
    public $name;
    public $inn;

    public function __construct($userId, $config = [])
    {
        $this->userId = $userId;
        parent::__construct($config);
    }


    public function rules()
    {
        return [
            [['id', 'base', 'letter_date', 'command_date', 'checkup_begin_date', 'inn', 'region_id', 'created_by'], 'integer'],
            [['letter_number', 'command_number', 'checkup_finish_date', 'name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Instruction::find()->joinWith('controlCompany')->joinWith(['controlCompany' => function(ActiveQuery $query) {
            return $query->joinWith('region');
        }]);

        if ($this->userId) {
            $query->where(['control_instructions.created_by' => $this->userId]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $dataProvider->sort->attributes['inn'] = [
            'asc' => ['control_companies.inn' => SORT_ASC],
            'desc' => ['control_companies.inn' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['region_id'] = [
            'asc' => ['regions.name' => SORT_ASC],
            'desc' => ['regions.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['name'] = [
            'asc' => ['control_companies.name' => SORT_ASC],
            'desc' => ['control_companies.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'base' => $this->base,
            'letter_date' => $this->letter_date,
            'command_date' => $this->command_date,
            'checkup_begin_date' => $this->checkup_begin_date,
            'control_instructions.created_by' => $this->created_by,
            'regions.id' => $this->region_id,
        ]);

        $query->andFilterWhere(['like', 'letter_number', $this->letter_number])
            ->andFilterWhere(['like', 'command_number', $this->command_number])
            ->andFilterWhere(['like', 'control_companies.name', $this->name])
            ->andFilterWhere(['like', 'control_companies.inn', $this->inn])
            ->andFilterWhere(['like', 'checkup_finish_date', $this->checkup_finish_date]);

        return $dataProvider;
    }
}
