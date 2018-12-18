<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DepartmentMaster;

/**
 * DepartmentMasterSearch represents the model behind the search form about `app\models\DepartmentMaster`.
 */
class DepartmentMasterSearch extends DepartmentMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id'], 'integer'],
            [['department_code', 'department_name', 'created_date', 'created_by', 'modified_date', 'modified_by'], 'safe'],
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
        $query = DepartmentMaster::find();

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
            'department_id' => $this->department_id,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'department_code', $this->department_code])
            ->andFilterWhere(['like', 'department_name', $this->department_name])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
