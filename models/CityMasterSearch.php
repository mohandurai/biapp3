<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CityMaster;

/**
 * CityMasterSearch represents the model behind the search form about `app\models\CityMaster`.
 */
class CityMasterSearch extends CityMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 's_id'], 'integer'],
            [['city_name', 'created_by', 'created_date', 'modified_by', 'modified_date', 'postal_code'], 'safe'],
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
        $query = CityMaster::find();

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
            'city_id' => $this->city_id,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
            's_id' => $this->s_id,
        ]);

        $query->andFilterWhere(['like', 'city_name', $this->city_name])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code]);

        return $dataProvider;
    }
}
