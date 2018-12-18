<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ZoneMaster;

/**
 * ZoneMasterSearch represents the model behind the search form about `app\models\ZoneMaster`.
 */
class ZoneMasterSearch extends ZoneMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'modified_by'], 'integer'],
            [['zone_name', 'created_date', 'modified_date'], 'safe'],
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
        $query = ZoneMaster::find();

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
            'id' => $this->id,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
            'created_by' => $this->created_by,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'zone_name', $this->zone_name]);

        return $dataProvider;
    }
}
