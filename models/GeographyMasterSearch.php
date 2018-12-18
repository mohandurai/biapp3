<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GeographyMaster;

/**
 * GeographyMasterSearch represents the model behind the search form about `app\models\GeographyMaster`.
 */
class GeographyMasterSearch extends GeographyMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['geo_id', 'bunit_id'], 'integer'],
            [['country_code', 'country', 'state', 'city', 'area', 'territory', 'pincode', 'continental'], 'safe'],
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
        $query = GeographyMaster::find();

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
            'geo_id' => $this->geo_id,
            'bunit_id' => $this->bunit_id,
        ]);

        $query->andFilterWhere(['like', 'country_code', $this->country_code])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'territory', $this->territory])
            ->andFilterWhere(['like', 'pincode', $this->pincode])
            ->andFilterWhere(['like', 'continental', $this->continental]);

        return $dataProvider;
    }
}
