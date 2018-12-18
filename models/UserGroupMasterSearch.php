<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserGroupMaster;

/**
 * UserGroupMasterSearch represents the model behind the search form about `app\models\UserGroupMaster`.
 */
class UserGroupMasterSearch extends UserGroupMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'modified_by', 'created_by'], 'integer'],
            [['title', 'description', 'group_code', 'modified_date', 'created_date', 'status'], 'safe'],
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
        $query = UserGroupMaster::find();

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
            'group_id' => $this->group_id,
            'modified_date' => $this->modified_date,
            'modified_by' => $this->modified_by,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'group_code', $this->group_code])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
