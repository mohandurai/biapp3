<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ResetmoduleRecord;

/**
 * ResetmoduleRecordSearch represents the model behind the search form about `app\models\ResetmoduleRecord`.
 */
class ResetmoduleRecordSearch extends ResetmoduleRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['resetmodule_id', 'emp_id', 'marks', 'module'], 'integer'],
            [['related_question_id', 'mod_record_id', 'response', 'comments', 'role', 'assigned_role', 'created_time', 'modified_time'], 'safe'],
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
        $query = ResetmoduleRecord::find();

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
            'resetmodule_id' => $this->resetmodule_id,
            'emp_id' => $this->emp_id,
            'marks' => $this->marks,
            'module' => $this->module,
            'created_time' => $this->created_time,
            'modified_time' => $this->modified_time,
        ]);

        $query->andFilterWhere(['like', 'related_question_id', $this->related_question_id])
            ->andFilterWhere(['like', 'mod_record_id', $this->mod_record_id])
            ->andFilterWhere(['like', 'response', $this->response])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'assigned_role', $this->assigned_role]);

        return $dataProvider;
    }
}
