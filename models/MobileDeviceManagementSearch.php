<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MobileDeviceManagement;

/**
 * MobileDeviceManagementSearch represents the model behind the search form about `app\models\MobileDeviceManagement`.
 */
class MobileDeviceManagementSearch extends MobileDeviceManagement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'delivered_status'], 'integer'],
            [['username', 'device_key', 'status', 'created_by', 'created_date', 'modified_by', 'modified_date', 'imei_no'], 'safe'],
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
        $query = MobileDeviceManagement::find();

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
            'user_id' => $this->user_id,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
            'delivered_status' => $this->delivered_status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'device_key', $this->device_key])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by])
            ->andFilterWhere(['like', 'imei_no', $this->imei_no]);

        return $dataProvider;
    }
}
