<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MobileIcons;

/**
 * MobileIconsSearch represents the model behind the search form about `app\models\MobileIcons`.
 */
class MobileIconsSearch extends MobileIcons
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icon_id'], 'integer'],
            [['module', 'img_path','model_label_name'], 'safe'],
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
        $query = MobileIcons::find();

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
            'icon_id' => $this->icon_id,
        ]);

        $query->andFilterWhere(['like', 'module', $this->module])

 ->andFilterWhere(['like', 'model_label_name', $this->model_label_name])
            ->andFilterWhere(['like', 'img_path', $this->img_path]);

        return $dataProvider;
    }
}
