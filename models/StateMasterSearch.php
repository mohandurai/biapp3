<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StateMaster;

/**
 * StateMasterSearch represents the model behind the search form about `app\models\StateMaster`.
 */
class StateMasterSearch extends StateMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_id', 'c_id', 'zone_id'], 'integer'],
            [['state_code', 'state_name', 'created_by', 'created_date', 'modified_by', 'modified_date'], 'safe'],
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
        $query = StateMaster::find();

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
            's_id' => $this->s_id,
            'c_id' => $this->c_id,
            'zone_id' => $this->zone_id,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'state_code', $this->state_code])
            ->andFilterWhere(['like', 'state_name', $this->state_name])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
