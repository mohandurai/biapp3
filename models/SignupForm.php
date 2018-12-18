<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\web\UploadedFile;
require_once "db.php";
/**
 * Signup form
 */
class SignupForm extends Model
{
	public $username;
    	public $email;
    	public $password;
    	public $repeat_password;
   	public $first_name;
    	public $last_name;
    	public $status;
    	public $role;
    	public $reports_to;
    	public $date_of_birth;
	public $mobile;
 	public $qualification;
 	public $department;
 	public $country;
 	public $zone;
 	public $state;
 	public $city;
 	public $area; 
	public $territory;
 	public $supervisor;
 	public $competency; 
	public $subcompetency;
 	public $dealership;
 	public $trainer;
  	public $co_ordinator;
  	public $function;
  	public $businessunit;
  	public $dp;
  	public $company;
  	public $id;
	public $channel;
    	public $usergroup;
  	public $file;
   	public $upload_image;
   	public $sharingmode;
 	public $emp_code;
 	public $isNewRecord;
 	public $profile_image_url;
 	public $leader;
 	public $pincode;
 	public $reports_to_role;
 	//public $emp_coded;
 	public $validator_role;
 	public $validator;
 	public $audiindiauser;

	//$model->formName();
    	/**
     	* @inheritdoc
id, username, emp_code, first_name, last_name, auth_key, password_hash, password_reset_token, email, status, created_at, updated_at, role, dealer_designation, dp, role_id, reports_to, employee_id, mobile, last_updated_by, sms_status, login_status, loginLastLock, loginAttempt, email_id, date_of_birth, qualification, department, country, zone, state, city, area, territory, supervisor, reports_to_role, competency, subcompetency, device_key, imei, version, group_id, supervisor_id, mentor_id, trainer, profile_image_url, dealership, co_ordinator, usergroup, channel, function, company, businessunit, leader, color, pincode, date_of_joining, date_of_promotion, exp_current_job, exp_prevoius_job, total_exp, date_of_leaving, remarks, created_by, modified_by, qualification_date, gender, street_name, neev_designation, mobile_no, contest_designation, segment, validator_role, validator, audiindiauser, created_date, modified_date
     	*/
    	public function rules()
    	{
        	return [
       			[['first_name', 'role','mobile','dealership','dp'], 'required'],
      			['mobile','integer'],
            		//['username', 'filter', 'filter' => 'trim', 'unique' ],
            		//['username', 'required'],
            		['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            		//['username', 'unique', 'min' => 2, 'max' => 255],
			//['username', 'unique'],
			[['emp_code','profile_image_url','last_name','date_of_birth','qualification','department','country','zone','state','city','area','territory',
'supervisor','trainer','co_ordinator','channel','usergroup','function','company','businessunit','leader','dp','reports_to_role','audiindiauser','validator_role','reports_to','pincode'],'safe'],

            		['file','file'],

            		['email', 'filter', 'filter' => 'trim'],
            		['email', 'required'],
            		['email', 'email'],
            		['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            		['password', 'required'],
            		['password', 'string', 'min' => 6],
      			['repeat_password', 'required'],
            		['repeat_password', 'string', 'min' => 6],
      			['repeat_password','compare','compareAttribute'=>'password','message' => 'Password and Confirm password should be Same.'],
      
        	];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */

	public static function getInputName($model, $attribute)
    	{
        	$formName = $model->formName();

      	}
              
    	public function signup()
    	{
        	if ($this->validate())
		{
            		$user = new User();
            		$user->username = $this->username;
            		$user->email = $this->email;
      			$user->first_name = $this->first_name;
		      	$user->last_name = $this->last_name;
		      	$user->role = $this->role;
		      	$user->reports_to = $this->reports_to;

		      	$user->validator = $this->validator;
		      	$user->validator_role = $this->validator_role;

 			$user->date_of_birth = $this->date_of_birth;
 			$user->qualification = $this->qualification;
 			$user->department = $this->department;
 			$user->country = $this->country;
 			$user->zone = $this->zone;
 			$user->state = $this->state;
 			$user->city = $this->city; 
 			$user->area = $this->area;
 			$user->territory = $this->territory;
 			$user->supervisor = $this->supervisor;
 			$user->trainer = $this->trainer;
 			$user->reports_to_role = $this->reports_to_role;
 			$user->competency = $this->competency;
 			$user->subcompetency = $this->subcompetency;
			if(is_array($this->dealership))
			{
 				$user->dealership = implode(",",$this->dealership);
			}
			else
			{
				$user->dealership = $this->dealership;
			}
			$user->mobile = $this->mobile;
 			$user->co_ordinator = $this->co_ordinator;
 			$user->channel = $this->channel; 
 			//$user->usergroup = $this->usergroup;   
  			$user->company = $this->company; 
			$user->dp = $this->dp; 
   			$user->businessunit = $this->dp; 
			$user->reports_to_role = $this->role;
			// $user->dp = $this->businessunit; 
			//user group set
			$role = $this->role;
			if($role[0]==6)
			{
				$user->usergroup=1;
			}
			else
			{
				$user->usergroup=$this->usergroup;
			}
			//user group 
     			$user->leader = $this->leader; 
    			$user->function = $this->function;  
    			$sql = 'SELECT max(id) as mm FROM user';
			$res2 = mysql_query($sql);
    			$nrw = mysql_num_rows($res2);
    			while($row2 = mysql_fetch_assoc($res2))
    			{
        			$id1 = $row2['mm']+1;
    			}  
     			$emp_code='Emp'.$id1; 
			$user->emp_code =  $emp_code;  

			$this->file =UploadedFile::getInstances($this,'upload_image');

   			foreach ($this->file as $file)
			{
               			$file1 ='profile/'.$file->name;              
 				$file->saveAs('profile/'.$file->name);
                	} 

			if(!isset($file1)) { $file1="aaa.jpg"; }
			$user->profile_image_url = $file1;
  			$user->created_date =  date('Y-m-d h:i:s');
            		$user->password=$this->password;
            		$user->setPassword($this->password);
            		$user->generateAuthKey();
            		if ($user->save())
			{
			       /* $auth = Yii::$app->authManager;
				$authorRole = $auth->getRole($this->role);
				$auth->assign($authorRole, $user->getId()); */
                		return $user;
            		} 
	    		else
	    		{
				print_r($user->getErrors());
				echo "<pre>";
				print_r($user);
				echo "</pre>";
				exit;
		
	     		}

        	}
		else
		{
			print_r($this->getErrors());		
		}
        	return null;
    	}
    
    	public function attributeLabels()
    	{
        	return [
            		'usergroup' => 'User Group',
            		'businessunit' => 'Business Unit',
             		'supervisor' => 'Can Be Supervisor',
             		'trainer'=> 'Can Be Trainer',
              		'co_ordinator'=> 'Can Be Co Ordinator',
               		'leader'=>'Can Be Leader',
               		'reports_to_role'=>'Reporting Manager Role',
               		'reports_to'=>'Reporting Manager',
             		'emp_code'=>'Dealer Employee Code',
			'dp' => 'Bussiness Unit',
    			'audiindiauser'=>'Audi India User'
     
        	];
    	}
}
