<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\SharingRules;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $first_name
 * @property integer $last_name
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property Lead[] $leads
 */
class ResetUser extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 'InActive';
    const STATUS_ACTIVE = 'Active';
   public $file;
   public $upload_image;
   public $sharingmode;
public $mode;
public $password;
public $role_iddummy;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        [['first_name','reports_to','role','username','mobile'],'required'],
            
        [['emp_code','dealership','profile_image_url','emp_code','color','date_of_birth','country','zone','state','city','role_iddummy','area','territory','supervisor','trainer','qualification','co_ordinator','channel','usergroup','function','company','leader','last_name','department','validator_role','validator','dp'],'safe'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This Email has already been taken.'],
               ['file','file'],

 ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    public function getHrUser(){
        return User::find()->andWhere(['dealership'=>$this->dealership])->andWhere(['like','role','%HRManager',false]);
    }

  public function getCeo(){
        return User::find()->andWhere(['dealership'=>$this->dealership])->andWhere(['like','role','%CEO',false]);
    }

  public function getGeneralmanager(){
        return User::find()->andWhere(['dealership'=>$this->dealership])->andWhere(['like','role','%_GeneralManager',false]);
    }
    public function getReportstouser()
    {
        return $this->hasOne(User::className(), ['id' => 'reports_to']);
    }
    public function getRolediscription()
    {
        return $this->hasOne(AuthItem::className(),['name' => 'role']);
    }


 public function scenarios()
    {
    $scenarios = parent::scenarios();
        $scenarios['create'] = ['username','email','first_name','status','last_name','role','mobile','reports_to'];//Scenario Values Only Accepted
        return $scenarios;
    }
     static function relatedmodules()
    {

    return [
        'user'=>'userreportsto',
    ];


    }

    public function beforeValidate() 
{
 if($this->isNewRecord)
 {
 
 }
 else
 {
  //not a new record, so just set the last updated time and last updated user id
 //$this->password="dummy";
 }
  
 return parent::beforeValidate();
}

    public function beforeSave($insert)
    	{   

//echo "<pre>";
//print_r($_POST);
//exit;

		 if(isset($this->id))
		 {
		      $this->mode='update';
                      
		 }
		 else
		 {
	
		   $this->mode='create';
		    /// only for webservices ////
		   if(isset($_POST['password']))
		   {	

		   $this->password=$_POST['password'];		
                   $this->setPassword($this->password);
                   $this->generateAuthKey();
		   }
             
		   	
		 }
                  
		
        if($this->password != ''){
           $this->password;
            //die();
            $this->setPassword($this->password);
            $this->generateAuthKey();
       }


	//	$role_new = $_POST['businessunit'] . "_" . $_POST['role'];
	//	$this->role = $role_new;


		 if (parent::beforeSave($insert)) 
		 {
		   return true;
		  }
		  else
		  {
		      return false;
		  }
        
         }

 public function afterSave($insert, $changedAttributes)
      {
 	   parent::afterSave($insert, $changedAttributes);
           if($this->mode=='create')
     	    { 
                    
		$auth = Yii::$app->authManager;
		$authorRole = $auth->getRole($this->role);
		$auth->assign($authorRole, $this->id);
		$connection=Yii::$app->db;
                $connection ->createCommand()
		    ->update('user', ['emp_code' =>  "Emp".$this->id], 'id = '.$this->id )
		    ->execute();
            }   

            
//$connection=Yii::$app->db;
      //          $connection ->createCommand("call closure_table()")->execute();
      }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
		 return static::findOne(['auth_key' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
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

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public function getLeads()
    {
        return $this->hasMany(Lead::className(), ['assignedto' => 'id']);
    }
    public function getBunit()
    {
        return $this->hasOne(BusinessUnitMaster::className(), ['bunit_id' => 'dp']);
    }
    public function getReportuser()
    {
        return $this->hasOne(User::className(), ['id' => 'reports_to']);
    }
   public function getDepartmentname()
    {
        return $this->hasOne(DepartmentMaster::className(), ['department_id' => 'department']);
    }
    
   public function getDealername()
    {
        return $this->hasOne(DealershipMaster::className(), ['dealership_id' => 'dealership']);
    }
  public function getChannelname()
    {
        return $this->hasOne(ChannelMaster::className(), ['channel_id' => 'channel']);
    }

     public function getUserreportsto()
    {
        return $this->hasOne(User::className(), ['id' => 'reports_to']) ->from(User::tableName() . ' u2');
    }

      public function getclosure_table()
    {
     return $this->hasOne(ClosureTable::className(), ['uid' => 'id']);
    }
    static function getsharingrules()
    {
    return SharingRules::find()->where(['module'=>'User'])->one();
    }
    
    static function getsharing_access($query_obj)
    {
    
    
    
    switch(User::getsharingrules()->sharing_access)
    {
    case "PrivateEX":
    if(is_object($query_obj))
    {
 
    
        foreach (User::relatedmodules() as $obj=>$var)
    {
    $query_obj->joinWith($var);
    }
        $query_obj->joinWith('closure_table');
    $query_obj->andWhere(['rid' => Yii::$app->user->identity->id]);
    }
    else
    {
        $query= User::find();   
    
    
    $query->joinWith('closure_table');
    $query->andWhere(['rid' => Yii::$app->user->identity->id]);

    return $query;
    //return Leads::getclosure_leads();
    }
    break;


    case "Public":
    if(is_object($query_obj))
    {
    //$query_obj->joinWith('closure_table');
    //$query_obj->where(['rid' => Yii::$app->user->identity->id]);
    }
    else
    {
    return User::find();
    }
    break;
    
    
    }
    }

public function attributeLabels()
    {
        return [
            'usergroup' => 'User Group',
            'dp' => 'Business Unit',
             'supervisor' => 'Can Be Supervisor',
             'trainer'=> 'Can Be Trainer',
              'co_ordinator'=> 'Can Be Co Ordinator',
              'leader'=>'Can Be Leader',
     
        ];
    }

}
