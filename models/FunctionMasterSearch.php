<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FunctionMaster;

/**
 * FunctionMasterSearch represents the model behind the search form about `app\models\FunctionMaster`.
 */
class FunctionMasterSearch extends FunctionMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['function_id',  'created_by', 'modified_by'], 'integer'],
            [['function_code', 'bunit_id', 'function_name','company_id', 'desc', 'created_date', 'modified_date'], 'safe'],
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
        $query = FunctionMaster::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
       $query->joinwith('company');
	   $query->joinwith('bunit');
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'function_id' => $this->function_id,
           // 'company_id' => $this->company_id,
           // 'bunit_id' => $this->bunit_id,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
            'created_by' => $this->created_by,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'function_code', $this->function_code])
            ->andFilterWhere(['like', 'function_name', $this->function_name])
			->andFilterWhere(['like','u2.company_name',$this->company_id])
			->andFilterWhere(['like','u3.business_unit_name',$this->bunit_id])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
