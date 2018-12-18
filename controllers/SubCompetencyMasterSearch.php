<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubCompetencyMaster;

/**
 * SubCompetencyMasterSearch represents the model behind the search form about `app\models\SubCompetencyMaster`.
 */
class SubCompetencyMasterSearch extends SubCompetencyMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subcompetency_id', 'status', 'created_by', 'modified_by', 'bunit_id'], 'integer'],
            [['subcompetency_code', 'subcompetency_name', 'sub_competency_description', 'created_date', 'modified_date'], 'safe'],
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
        $query = SubCompetencyMaster::find();

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
            'subcompetency_id' => $this->subcompetency_id,
            'status' => $this->status,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'modified_date' => $this->modified_date,
            'modified_by' => $this->modified_by,
            'bunit_id' => $this->bunit_id,
        ]);

        $query->andFilterWhere(['like', 'subcompetency_code', $this->subcompetency_code])
            ->andFilterWhere(['like', 'subcompetency_name', $this->subcompetency_name])
            ->andFilterWhere(['like', 'sub_competency_description', $this->sub_competency_description]);

        return $dataProvider;
    }
}
