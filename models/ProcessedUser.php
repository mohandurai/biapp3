<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "processed_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $emp_code
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $status
 * @property string $role
 * @property string $dealer_designation
 * @property integer $dp
 * @property integer $reports_to
 * @property integer $employee_id
 * @property string $mobile
 * @property string $date_of_birth
 * @property string $qualification
 * @property integer $department
 * @property string $country
 * @property string $zone
 * @property string $state
 * @property string $city
 * @property string $area
 * @property string $territory
 * @property string $supervisor
 * @property string $reports_to_role
 * @property string $trainer
 * @property string $dealership
 * @property string $co_ordinator
 * @property integer $usergroup
 * @property integer $channel
 * @property integer $function
 * @property integer $company
 * @property integer $businessunit
 * @property integer $leader
 * @property string $color
 * @property string $pincode
 * @property string $date_of_joining
 * @property string $date_of_promotion
 * @property string $exp_current_job
 * @property string $exp_prevoius_job
 * @property string $total_exp
 * @property string $date_of_leaving
 * @property string $remarks
 * @property string $qualification_date
 * @property string $gender
 * @property string $street_name
 * @property integer $neev_designation
 * @property string $mobile_no
 * @property integer $contest_designation
 * @property string $segment
 * @property string $validator
 * @property integer $audiindiauser
 * @property string $processed_status
 * @property string $created_date
 * @property string $modified_date
 * @property string $created_by
 * @property string $modified_by
 */
class ProcessedUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'processed_user';
    }
    
    public $userid;
    public $userrerole;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'first_name', 'gender', 'businessunit', 'role', 'neev_designation', 'department', 'reports_to'], 'required'],
            //[['dp', 'reports_to', 'employee_id', 'department', 'usergroup', 'channel', 'function', 'company', 'businessunit', 'leader', 'neev_designation', 'contest_designation', 'audiindiauser'], 'integer'],
            [['date_of_birth', 'created_date', 'modified_date', 'processed_status_message', 'audiindiauser'], 'safe'],
            [['street_name'], 'string'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username', 'email'], 'unique'],
            [['emp_code', 'co_ordinator'], 'string', 'max' => 60],
            [['first_name', 'last_name', 'dealer_designation', 'qualification', 'country', 'zone', 'state', 'city', 'area', 'territory', 'supervisor', 'reports_to_role', 'trainer', 'color', 'pincode', 'exp_current_job', 'exp_prevoius_job', 'total_exp', 'date_of_leaving', 'remarks', 'qualification_date', 'segment', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['status'], 'string', 'max' => 10],
            [['role'], 'string', 'max' => 64],
            [['mobile', 'mobile_no'], 'string', 'max' => 15],
            [['dealership'], 'string', 'max' => 500],
            [['date_of_joining', 'date_of_promotion'], 'string', 'max' => 25],
            [['gender'], 'string', 'max' => 55],
            [['validator', 'processed_status'], 'string', 'max' => 150],
            [['businessunit'], 'validatebunit'],
            [['role'], 'validaterole'],
            [['neev_designation'], 'validatedesignation'],
            [['department'], 'validatedepartment'],
            [['dealership'], 'validatedealership']
        ];
    }

    public function validatedealership(){
        $model = DealershipMaster::find()->andWhere(['dealership_name'=>$this->dealership])->one();
        if(empty($model))
            $this->addError($attribute, 'Incorrect Dealership.');
    }

    public function validatedepartment(){
        $model = DepartmentMaster::find()->andWhere(['department_name'=>$this->department])->one();
        if(empty($model))
            $this->addError($attribute, 'Incorrect Department.');
    }

    public function validaterole(){
        $model = AudiNeevDesignation::find()->andWhere(['description'=>$this->role])->one();
        if(empty($model))
            $this->addError($attribute, 'Incorrect Role.');
    }

    public function validatedesignation(){
        $model = AudiNeevDesignation::find()->andWhere(['description'=>$this->neev_designation])->one();
        if(empty($model))
            $this->addError($attribute, 'Incorrect Neev Designation.');
    }

    public function validatebunit(){
        $model = BusinessUnitMaster::find()->andWhere(['business_unit_name'=>$this->businessunit])->one();
        if(empty($model))
            $this->addError('businessunit','Incorrect Business Unit.');
    }

    public function getBunitMaster(){
        return $this->hasOne(BusinessUnitMaster::className(), ['business_unit_name' => "businessunit"]);
    }

    public function getDepartmentMaster(){
        return $this->hasOne(DepartmentMaster::className(), ['department_name' => "department"]);
    }


    public function getRoleMaster(){
         return $this->hasOne(AudiNeevDesignation::className(), ['description' => "role"]);
    }

    public function getDesignationMaster(){
         return $this->hasOne(AudiNeevDesignation::className(), ['description' => "neev_designation"]);
    }

    public function getDealershipMaster(){
         return $this->hasOne(DealershipMaster::className(), ['dealership_name' => "dealership"]);
    }
    

    public function beforeSave($insert)
    {
        if($this->isNewRecord){
            $this->created_date=date('Y-m-d h:i:s');
            $this->modified_date=date('Y-m-d h:i:s');
            $this->created_by=Yii::$app->user->id;
            $this->modified_by=Yii::$app->user->id;
            $this->audiindiauser = '0';

            /*$department = DepartmentMaster::find()->andWhere(['department_name'=>$this->department])->one();
            $this->department = $department->department_id;

            $businessunit = BusinessUnitMaster::find()->andWhere(['business_unit_name'=>$this->businessunit])->one();
            $this->businessunit = $businessunit->bunit_id;*/


        }
        else{
            $this->modified_date=date('Y-m-d h:i:s');
            $this->modified_by=Yii::$app->user->id;
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            'username' => 'Username',
            'emp_code' => 'Emp Code',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            //'status' => 'Status',
            'role' => 'Role',
            //'dealer_designation' => 'Dealer Designation',
            'businessunit' => 'Businessunit',
            //'dp' => 'Dp',
            'reports_to' => 'Reports To',
            //'employee_id' => 'Employee ID',
            'mobile' => 'Mobile',
            'date_of_birth' => 'Date Of Birth',
            'qualification' => 'Qualification',
            'department' => 'Department',
            'country' => 'Country',
            'zone' => 'Zone',
            'state' => 'State',
            'city' => 'City',
            'area' => 'Area',
            'territory' => 'Territory',
            'supervisor' => 'Supervisor',
            'reports_to_role' => 'Reports To Role',
            'trainer' => 'Trainer',
            'dealership' => 'Dealership',
            'co_ordinator' => 'Co Ordinator',
            'usergroup' => 'Usergroup',
            'channel' => 'Channel',
            'function' => 'Function',
            'company' => 'Company',            
            'leader' => 'Leader',
            //'color' => 'Color',
            'pincode' => 'Pincode',
            'date_of_joining' => 'Date Of Joining',
            'date_of_promotion' => 'Date Of Promotion',
            'exp_current_job' => 'Exp Current Job',
            'exp_prevoius_job' => 'Exp Prevoius Job',
            'total_exp' => 'Total Exp',
            'date_of_leaving' => 'Date Of Leaving',
            'remarks' => 'Remarks',
            'qualification_date' => 'Qualification Date',
            'gender' => 'Gender',
            'street_name' => 'Street Name',
            'neev_designation' => 'Neev Designation',
            'mobile_no' => 'Mobile No',
            'contest_designation' => 'Contest Designation',
            //'segment' => 'Segment',
            'validator' => 'Validator',
            //'audiindiauser' => 'Is Audi India User (1 or 0)',
            //'processed_status' => 'Processed Status',
            /*'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',*/
        ];
    }
}
