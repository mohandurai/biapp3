<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InstanceSetting;

/**
 * InstanceSettingSearch represents the model behind the search form about `app\models\InstanceSetting`.
 */
class InstanceSettingSearch extends InstanceSetting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['header_color', 'sidebar_color', 'img_path'], 'safe'],
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
        $query = InstanceSetting::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'header_color', $this->header_color])
            ->andFilterWhere(['like', 'sidebar_color', $this->sidebar_color])
            ->andFilterWhere(['like', 'img_path', $this->img_path]);

        return $dataProvider;
    }
}
