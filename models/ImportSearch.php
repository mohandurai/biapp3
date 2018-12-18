<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Import;
use yii\db\Query;
/**
 * CountryMasterSearch represents the model behind the search form about `app\models\Import`.
 */
class ImportSearch extends Import
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
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
        //$query = Import::find();
		
		$query = (new Query())->from('csv_import_log');


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		 $this->load($params);

         if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
			'created_by' => $this->created_by,
            'created_date' => $this->created_date,

        ]);
        return $dataProvider;
    }
}
