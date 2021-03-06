<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Category;

/**
 * CategorySearch represents the model behind the search form of `common\models\Category`.
 */
class CategoryUserSearch extends Category
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'family_id', 'created_at', 'lft', 'rgt', 'depth'], 'integer'],
            [['name'], 'safe'],
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
        $us =Yii::$app->user->identity->getId();

        $query = Category::find()->select("id,name, created_at,lft,rgt,depth")
            ->where('user_id=:user_id', [':user_id' => $us]);

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
            'family_id' => $this->family_id,
            'created_at' => $this->created_at,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'depth' => $this->depth,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
