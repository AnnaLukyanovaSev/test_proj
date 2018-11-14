<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * TransactionSearch represents the model behind the search form of `common\models\Transaction`.
 */
class TransactionUserSearch extends Transaction
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'amount', 'user_id', 'account_id', 'category_id', 'family_id', 'created_at'], 'integer'],
            [['currency', 'date'], 'safe'],
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
        $us = Yii::$app->user->identity->getId();

        $query = Transaction::find()
            ->select("transaction.id,transaction.amount,transaction.currency,date,account_id,
            category_id,account.name,category.name")
            ->joinWith('account')
            ->joinWith('category')
            ->where('transaction.user_id=:user_id', [':user_id' => $us]);

        //  ->andWhere(['account.id' => $this->account_id]);

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
            'amount' => $this->amount,
            'user_id' => $this->user_id,
            'account_id' => $this->account_id,
            'category_id' => $this->category_id,
            'family_id' => $this->family_id,
            'created_at' => $this->created_at,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'currency', $this->currency]);

        return $dataProvider;
    }
}
