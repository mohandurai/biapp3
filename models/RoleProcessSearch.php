<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RoleProcess;

/**
 * RoleProcessSearch represents the model behind the search form about `app\models\RoleProcess`.
 */
class RoleProcessSearch extends RoleProcess
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r_id', 'role_id', 'process_id', 'bunit'], 'integer'],
            [['status'], 'safe'],
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
        $query = RoleProcess::find();

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
            'r_id' => $this->r_id,
            'role_id' => $this->role_id,
            'process_id' => $this->process_id,
            'bunit' => $this->bunit,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
