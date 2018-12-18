<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InterviewOption;

/**
 * InterviewOptionSearch represents the model behind the search form about `app\models\InterviewOption`.
 */
class InterviewOptionSearch extends InterviewOption
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'modified_by', 'status'], 'integer'],
            [['role', 'name', 'created_date', 'modified_date'], 'safe'],
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
        $query = InterviewOption::find();

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
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
            'modified_by' => $this->modified_by,
            'modified_date' => $this->modified_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
