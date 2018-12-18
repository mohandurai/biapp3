<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AllCalander;

/**
 * AllCalanderSearch represents the model behind the search form about `app\models\AllCalander`.
 */
class AllCalanderSearch extends AllCalander
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['calander_id', 'year', 'quarter'], 'integer'],
            [['quarter_name', 'month', 'month_name', 'week', 'week_name', 'day_name', 'date'], 'safe'],
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
        $query = AllCalander::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'calander_id' => $this->calander_id,
            'year' => $this->year,
            'quarter' => $this->quarter,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'quarter_name', $this->quarter_name])
            ->andFilterWhere(['like', 'month', $this->month])
            ->andFilterWhere(['like', 'month_name', $this->month_name])
            ->andFilterWhere(['like', 'week', $this->week])
            ->andFilterWhere(['like', 'week_name', $this->week_name])
            ->andFilterWhere(['like', 'day_name', $this->day_name]);

        return $dataProvider;
    }
}
