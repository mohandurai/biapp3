<?php
    namespace app\models;
   
    use Yii;
    use yii\base\Model;
    use app\models\User;
   
    class PasswordForm extends Model{
        public $oldpass;
        public $newpass;
        public $repeatnewpass;
       
        public function rules(){
            return [
                [['oldpass','newpass','repeatnewpass'],'required'],
                ['oldpass','findPasswords'],
                ['repeatnewpass','compare','compareAttribute'=>'newpass'],
            ];
        }
       
        public function findPasswords($attribute, $params){

//username=$_GET['username'];
                    $username=!empty($_GET['username'])?$_GET['username']:Yii::$app->user->identity->username;
         /* $user = User::find()->where([
                'username'=>Yii::$app->user->identity->username
            ])->one(); */
            $user = User::findByUsername($username);

            if (!$user || !$user->validatePassword($this->oldpass)) {
                $this->addError($attribute,'Old password is incorrect');
            }
            /*echo $this->oldpass.'<br>';
            echo $password = $user->password_hash;
            echo '<br>';
            echo Yii::$app->security->generatePasswordHash($this->oldpass);
            die();
            if($password!=Yii::$app->security->generatePasswordHash($this->oldpass))
                $this->addError($attribute,'Old password is incorrect');*/
        }
       
        public function attributeLabels(){

            return [
                'oldpass'=>'Old Password',
                'newpass'=>'New Password',
                'repeatnewpass'=>'Repeat New Password',
            ];
        }
    } 