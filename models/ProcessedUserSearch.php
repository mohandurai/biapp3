<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProcessedUser;

/**
 * ProcessedUserSearch represents the model behind the search form about `app\models\ProcessedUser`.
 */
class ProcessedUserSearch extends ProcessedUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dp', 'reports_to', 'employee_id', 'department', 'usergroup', 'channel', 'function', 'company', 'businessunit', 'leader', 'neev_designation', 'contest_designation', 'audiindiauser'], 'integer'],
            [['username', 'emp_code', 'first_name', 'last_name', 'email', 'status', 'role', 'dealer_designation', 'mobile', 'date_of_birth', 'qualification', 'country', 'zone', 'state', 'city', 'area', 'territory', 'supervisor', 'reports_to_role', 'trainer', 'dealership', 'co_ordinator', 'color', 'pincode', 'date_of_joining', 'date_of_promotion', 'exp_current_job', 'exp_prevoius_job', 'total_exp', 'date_of_leaving', 'remarks', 'qualification_date', 'gender', 'street_name', 'mobile_no', 'segment', 'validator', 'processed_status', 'created_date', 'modified_date', 'created_by', 'modified_by'], 'safe'],
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
        $query = ProcessedUser::find();

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
            'dp' => $this->dp,
            'reports_to' => $this->reports_to,
            'employee_id' => $this->employee_id,
            'date_of_birth' => $this->date_of_birth,
            'department' => $this->department,
            'usergroup' => $this->usergroup,
            'channel' => $this->channel,
            'function' => $this->function,
            'company' => $this->company,
            'businessunit' => $this->businessunit,
            'leader' => $this->leader,
            'neev_designation' => $this->neev_designation,
            'contest_designation' => $this->contest_designation,
            'audiindiauser' => $this->audiindiauser,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'emp_code', $this->emp_code])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'dealer_designation', $this->dealer_designation])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'qualification', $this->qualification])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'zone', $this->zone])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'territory', $this->territory])
            ->andFilterWhere(['like', 'supervisor', $this->supervisor])
            ->andFilterWhere(['like', 'reports_to_role', $this->reports_to_role])
            ->andFilterWhere(['like', 'trainer', $this->trainer])
            ->andFilterWhere(['like', 'dealership', $this->dealership])
            ->andFilterWhere(['like', 'co_ordinator', $this->co_ordinator])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'pincode', $this->pincode])
            ->andFilterWhere(['like', 'date_of_joining', $this->date_of_joining])
            ->andFilterWhere(['like', 'date_of_promotion', $this->date_of_promotion])
            ->andFilterWhere(['like', 'exp_current_job', $this->exp_current_job])
            ->andFilterWhere(['like', 'exp_prevoius_job', $this->exp_prevoius_job])
            ->andFilterWhere(['like', 'total_exp', $this->total_exp])
            ->andFilterWhere(['like', 'date_of_leaving', $this->date_of_leaving])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'qualification_date', $this->qualification_date])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'street_name', $this->street_name])
            ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
            ->andFilterWhere(['like', 'segment', $this->segment])
            ->andFilterWhere(['like', 'validator', $this->validator])
            ->andFilterWhere(['like', 'processed_status', $this->processed_status])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
