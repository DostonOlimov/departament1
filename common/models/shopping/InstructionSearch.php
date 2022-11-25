<?php

namespace common\models\shopping;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * ShoppingInstructionSearch represents the model behind the search form of `common\models\ShoppingInstruction`.
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
            [['id', 'base', 'letter_date', 'created_by', 'inn', 'region_id'], 'integer'],
            [['letter_number', 'name'], 'safe'],
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
        $query = Instruction::find()->joinWith('company')->joinWith(['company' => function (ActiveQuery $query) {
            return $query->joinWith('region');
        }]);

        if ($this->userId) {
            $query->where(['shopping_instructions.created_by' => $this->userId]);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['inn'] = [
            'asc' => ['shopping_companies.inn' => SORT_ASC],
            'desc' => ['shopping_companies.inn' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['region_id'] = [
            'asc' => ['regions.name' => SORT_ASC],
            'desc' => ['regions.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['name'] = [
            'asc' => ['shopping_companies.name' => SORT_ASC],
            'desc' => ['shopping_companies.name' => SORT_DESC],
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
            'shopping_instructions.created_by' => $this->created_by,
            'regions.id' => $this->region_id,
        ]);

        $query->andFilterWhere(['like', 'letter_number', $this->letter_number])
            ->andFilterWhere(['like', 'shopping_companies.name', $this->name])
            ->andFilterWhere(['like', 'shopping_companies.inn', $this->inn]);

        return $dataProvider;
    }
}
