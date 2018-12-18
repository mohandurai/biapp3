<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

/**
 * ProfileSearch represents the model behind the search form about `app\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'roles'], 'integer'],
            [['filetype', 'created_by', 'created_date', 'modified_by', 'modified_date'], 'safe'],
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
      //  $query = Profile::find();
	 if(preg_match('/NationalAdmin/',Yii::$app->user->identity->role))
	{
		  $query = Profile::find();
	}
	elseif(preg_match('/HRManager/',Yii::$app->user->identity->role) || preg_match('/DealerAdmin/',Yii::$app->user->identity->role))
	{
		 $query = Profile::find()->where(['like','roles',Yii::$app->user->identity->dealership.'_%',false]);

	}
	else
	{
	$query = Profile::find()->where(['roles'=>Yii::$app->user->identity->dealership.'_'.Yii::$app->user->identity->role]);
	 //$query = Profile::find()->where(['roles'=>Yii::$app->user->identity->role]);
	}
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
            'roles' => $this->roles,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'filetype', $this->filetype])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
