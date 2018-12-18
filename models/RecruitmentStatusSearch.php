<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RecruitmentStatus;
/**
 * RecruitmentStatusSearch represents the model behind the search form about `app\models\RecruitmentStatus`.
 */
class RecruitmentStatusSearch extends RecruitmentStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Ja_id', 'oacdesignation_id'], 'integer'],
            [['FirstName', 'LastName', 'Email', 'mobileno', 'DateofBirth', 'Gender', 'LanguageCode', 'JobID', 'PartnerIDs', 'City', 'State', 'PostalCode', 'Country', 'CoverLetter', 'Conertempname', 'Resume', 'Resumetempname', 'status', 'status1', 'oacstatus', 'status2', 'score', 'address', 'Street', 'update_at', 'phone_number', 'createddatetime', 'date_of_joining'], 'safe'],
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
        $query = RecruitmentStatus::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
$sql1 = Yii::$app->db->createCommand('SELECT dealership FROM user WHERE username="'.$_SESSION['login_id'].'" ')->queryAll();
       if($_SESSION['login_id']=="admin")
          {
             $query->andFilterWhere([ 
             ]);    
          }
          else 
          {
           $query->andFilterWhere([
            'PartnerIDs' => $sql1[0]['dealership_id'],
             ]);  
          }

        $query->andFilterWhere([
            'Ja_id' => $this->Ja_id,
            'oacdesignation_id' => $this->oacdesignation_id,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'FirstName', $this->FirstName])
            ->andFilterWhere(['like', 'LastName', $this->LastName])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'mobileno', $this->mobileno])
            ->andFilterWhere(['like', 'DateofBirth', $this->DateofBirth])
            ->andFilterWhere(['like', 'Gender', $this->Gender])
            ->andFilterWhere(['like', 'LanguageCode', $this->LanguageCode])
            ->andFilterWhere(['like', 'JobID', $this->JobID])
            ->andFilterWhere(['like', 'PartnerIDs', $this->PartnerIDs])
            ->andFilterWhere(['like', 'City', $this->City])
            ->andFilterWhere(['like', 'State', $this->State])
            ->andFilterWhere(['like', 'PostalCode', $this->PostalCode])
            ->andFilterWhere(['like', 'Country', $this->Country])
            ->andFilterWhere(['like', 'CoverLetter', $this->CoverLetter])
            ->andFilterWhere(['like', 'Conertempname', $this->Conertempname])
            ->andFilterWhere(['like', 'Resume', $this->Resume])
            ->andFilterWhere(['like', 'Resumetempname', $this->Resumetempname])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'status1', $this->status1])
            ->andFilterWhere(['like', 'oacstatus', $this->oacstatus])
            ->andFilterWhere(['like', 'status2', $this->status2])
            ->andFilterWhere(['like', 'score', $this->score])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'Street', $this->Street])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'createddatetime', $this->createddatetime])
            ->andFilterWhere(['like', 'date_of_joining', $this->date_of_joining]);

        return $dataProvider;
    }
}
