<?php

namespace common\models\fam_money\search;

use yii\base\Model;
use common\models\fam_money\Profile;
use yii\data\ActiveDataProvider;

class ProfileSearch extends Profile
{
    public function rules()
    {
        return [
            ['user_id', 'integer'],
            [['first_name', 'last_name',], 'max' => 255],
            [
                'first_name',
                'last_name',
                'match',
                'pattern' => '/[a-z]*/i',
                'message' => 'Only letters are allowed to input'
            ],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Profile::find();

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
            'user_id' => $this->user_id,
            'first_name' => $this->last_name,
            'last_name' => $this->first_name,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name]);

        return $dataProvider;
    }
}