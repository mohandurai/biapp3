<?php
namespace app\models;

use Yii;
use app\models\User;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = ResetUser::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);
		

        if ($user) {

            if (!ResetUser::isPasswordResetTokenValid($user->password_reset_token)) {

                $user->generatePasswordResetToken();

            }
		
                
            if ($user->save()) {
						
			file_get_contents(Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl()."/email/email.php?url=".Yii::$app->request->hostInfo.Yii::$app->homeUrl."?r=site%2Freset-password&username=".$user->username."&email=".$user->email."&token=".$user->password_reset_token);

			
			
                return \Yii::$app->mailer->compose(['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Password reset for ' . \Yii::$app->name)
                    ->send();
            }
            {
                echo print_r($user->errors);die;
            }
        }

        return false;
    }
}
