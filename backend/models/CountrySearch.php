<?php

namespace backend\models;

use common\models\Countries;
use yii\data\ActiveDataProvider;

class CountrySearch extends Countries
{
    public $id;
    public $name;
    public $alias;
    public $code;

    public function rules()
    {
        return [
            [['name', 'alias', 'code'], 'safe'],
        ];
    }

    public function search(array $params)
    {
        $query = Countries::find()->alias('u');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'u.id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'u.name', $this->name]);

        return $dataProvider;
    }
}
