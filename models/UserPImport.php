<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $emp_code
 * @property string $first_name
 * @property string $last_name
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $role
 * @property string $dealer_designation
 * @property integer $dp
 * @property string $role_id
 * @property integer $reports_to
 * @property integer $employee_id
 * @property string $mobile
 * @property integer $last_updated_by
 * @property string $sms_status
 * @property string $login_status
 * @property string $loginLastLock
 * @property string $loginAttempt
 * @property string $email_id
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
 * @property string $competency
 * @property string $subcompetency
 * @property string $device_key
 * @property string $imei
 * @property string $version
 * @property string $group_id
 * @property string $supervisor_id
 * @property string $mentor_id
 * @property string $trainer
 * @property string $profile_image_url
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
 * @property string $created_by
 * @property string $modified_by
 * @property string $qualification_date
 * @property string $gender
 * @property string $street_name
 * @property integer $neev_designation
 * @property string $mobile_no
 * @property integer $contest_designation
 * @property string $segment
 * @property string $validator_role
 * @property string $validator
 * @property integer $audiindiauser
 * @property string $created_date
 * @property string $modified_date
 */
class UserPImport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'first_name', 'gender', 'businessunit', 'role', 'neev_designation', 'department', 'reports_to'], 'required'],
            [['created_at', 'updated_at', 'dp', 'reports_to', 'employee_id', 'last_updated_by', 'department', 'usergroup', 'channel', 'function', 'company', 'businessunit', 'leader', 'neev_designation', 'contest_designation', 'audiindiauser'], 'integer'],
            [['date_of_birth', 'created_date', 'modified_date'], 'safe'],
            [['profile_image_url', 'street_name'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['emp_code', 'co_ordinator'], 'string', 'max' => 60],
            [['first_name', 'last_name', 'dealer_designation', 'sms_status', 'login_status', 'loginLastLock', 'loginAttempt', 'email_id', 'qualification', 'country', 'zone', 'state', 'city', 'area', 'territory', 'supervisor', 'reports_to_role', 'competency', 'subcompetency', 'device_key', 'imei', 'version', 'group_id', 'supervisor_id', 'mentor_id', 'trainer', 'color', 'pincode', 'exp_current_job', 'exp_prevoius_job', 'total_exp', 'date_of_leaving', 'remarks', 'created_by', 'modified_by', 'qualification_date', 'segment'], 'string', 'max' => 45],
            [['auth_key'], 'string', 'max' => 32],
            [['status'], 'string', 'max' => 10],
            [['role'], 'string', 'max' => 64],
            [['role_id'], 'string', 'max' => 50],
            [['mobile', 'mobile_no'], 'string', 'max' => 15],
            [['dealership'], 'string', 'max' => 500],
            [['date_of_joining', 'date_of_promotion'], 'string', 'max' => 25],
            [['gender'], 'string', 'max' => 55],
            [['validator_role', 'validator'], 'string', 'max' => 150],
            ['username', 'unique', 'message' => 'This username has already been taken.'],
            ['email', 'unique', 'message' => 'This Email has already been taken.']
        ];
    }


    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function beforeSave($insert){   
        if ($this->isNewRecord){
            $this->created_date =  date('Y-m-d h:i:s');
        }
        else{
        
            $this->modified_date =  date('Y-m-d h:i:s');
        }         
        
        $this->setPassword('pass@123');
        $this->generateAuthKey();
        return true;
        
    }

    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);
                
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole($this->role);
        $auth->assign($authorRole, $this->id);
        $connection=Yii::$app->db;
        $connection ->createCommand()
            ->update('user', ['emp_code' =>  "Emp".$this->id], 'id = '.$this->id )
            ->execute();
            
        $connection=Yii::$app->db;
        $connection ->createCommand("call closure_table()")->execute();
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'emp_code' => 'Emp Code',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'role' => 'Role',
            'dealer_designation' => 'Dealer Designation',
            'dp' => 'Dp',
            'role_id' => 'Role ID',
            'reports_to' => 'Reports To',
            'employee_id' => 'Employee ID',
            'mobile' => 'Mobile',
            'last_updated_by' => 'Last Updated By',
            'sms_status' => 'Sms Status',
            'login_status' => 'Login Status',
            'loginLastLock' => 'Login Last Lock',
            'loginAttempt' => 'Login Attempt',
            'email_id' => 'Email ID',
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
            'competency' => 'Competency',
            'subcompetency' => 'Subcompetency',
            'device_key' => 'Device Key',
            'imei' => 'Imei',
            'version' => 'Version',
            'group_id' => 'Group ID',
            'supervisor_id' => 'Supervisor ID',
            'mentor_id' => 'Mentor ID',
            'trainer' => 'Trainer',
            'profile_image_url' => 'Profile Image Url',
            'dealership' => 'Dealership',
            'co_ordinator' => 'Co Ordinator',
            'usergroup' => 'Usergroup',
            'channel' => 'Channel',
            'function' => 'Function',
            'company' => 'Company',
            'businessunit' => 'Businessunit',
            'leader' => 'Leader',
            'color' => 'Color',
            'pincode' => 'Pincode',
            'date_of_joining' => 'Date Of Joining',
            'date_of_promotion' => 'Date Of Promotion',
            'exp_current_job' => 'Exp Current Job',
            'exp_prevoius_job' => 'Exp Prevoius Job',
            'total_exp' => 'Total Exp',
            'date_of_leaving' => 'Date Of Leaving',
            'remarks' => 'Remarks',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
            'qualification_date' => 'Qualification Date',
            'gender' => 'Gender',
            'street_name' => 'Street Name',
            'neev_designation' => 'Neev Designation',
            'mobile_no' => 'Mobile No',
            'contest_designation' => 'Contest Designation',
            'segment' => 'Segment',
            'validator_role' => 'Validator Role',
            'validator' => 'Validator',
            'audiindiauser' => 'is audi india user for senrt mail Rewards & recognition',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
        ];
    }
}
