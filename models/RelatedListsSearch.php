<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RelatedLists;

/**
 * RelatedListsSearch represents the model behind the search form about `app\models\RelatedLists`.
 */
class RelatedListsSearch extends RelatedLists
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['first_table', 'second_table', 'first_table_key', 'second_table_key', 'query'], 'safe'],
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
        $query = RelatedLists::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'first_table', $this->first_table])
            ->andFilterWhere(['like', 'second_table', $this->second_table])
            ->andFilterWhere(['like', 'first_table_key', $this->first_table_key])
            ->andFilterWhere(['like', 'second_table_key', $this->second_table_key])
            ->andFilterWhere(['like', 'query', $this->query]); 

        return $dataProvider;
    }
}
