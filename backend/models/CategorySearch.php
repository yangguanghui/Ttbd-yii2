<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Category;

/**
 * CategorySearch represents the model behind the search form of `backend\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'source_id', 'source_cate_id', 'source_cate_pid', 'is_last_level', 'rank_pattern_id'], 'integer'],
            [['source_cate_name', 'source_cate_url', 'created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Category::find();

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
            'source_id' => $this->source_id,
            'source_cate_id' => $this->source_cate_id,
            'source_cate_pid' => $this->source_cate_pid,
            'is_last_level' => $this->is_last_level,
            'rank_pattern_id' => $this->rank_pattern_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'source_cate_name', $this->source_cate_name])
            ->andFilterWhere(['like', 'source_cate_url', $this->source_cate_url]);

        return $dataProvider;
    }
}
