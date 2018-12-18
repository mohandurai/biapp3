<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfileLog;

/**
 * ProfileLogSearch represents the model behind the search form about `app\models\ProfileLog`.
 */
class ProfileLogSearch extends ProfileLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userid'], 'integer'],
            [['json_query', 'status', 'created_date', 'modified_date'], 'safe'],
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
        $query = ProfileLog::find()->where(['userid'=>Yii::$app->user->identity->id])->orderBy('id desc');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'userid' => $this->userid,
        ]);

        $query->andFilterWhere(['like', 'json_query', $this->json_query])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_date', $this->created_date])
            ->andFilterWhere(['like', 'modified_date', $this->modified_date]);

        return $dataProvider;
    }
}
