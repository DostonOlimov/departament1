<?php

namespace common\models\control;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\PrimaryOv;
use yii\helpers\VarDumper;

/**
 * PrimaryOvSearch represents the model behind the search form of `common\models\control\PrimaryOv`.
 */
class PrimaryOvSearch extends PrimaryOv
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
            [['id', 'control_primary_data_id', 'type'], 'integer'],
            [['measurement', 'compared', 'invalid'], 'safe'],
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
        $query = PrimaryOv::find()->where(['control_primary_data_id' => $this->primaryDataId]);

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
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'measurement', $this->measurement])
            ->andFilterWhere(['like', 'compared', $this->compared])
            ->andFilterWhere(['like', 'invalid', $this->invalid]);

        return $dataProvider;
    }
}
