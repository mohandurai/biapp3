<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'first_name', 'last_name', 'auth_key', 'password_hash', 'password_reset_token', 'email','reports_to','role'], 'safe'],
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
        $query = User::find();
	 
     //$this->role = substr($this->role, '_', );

	 $query=User::getsharing_access('User');
	
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
		
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
	//$query-> where('role'=>'admin');substring_index($this->role,'_',-1)
		
            return $dataProvider;
        }
	//$query->select = "substring_index('".$this->role."','_',-1) as role";
        
        if(Yii::$app->user->identity->dp!=1)
        {
            $query->andFilterWhere([
                'id' => $this->id,
                'status' => "Active",
                'dp' => Yii::$app->user->identity->dp,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
    	    'reports_to'=>$this->reports_to,
    		
            ]);
        } else {
            $query->andFilterWhere([
                'id' => $this->id,
                'status' => "Active",
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            'reports_to'=>$this->reports_to,
            
            ]);
        }
	

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
	 ->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
