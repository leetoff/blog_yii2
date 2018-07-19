<?php
namespace frontend\services;

use Exception;
use Yii;
use common\essences\User;
use \frontend\forms\PasswordResetRequestForm;

class PassResetRequestService
{
    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
        public static function sendEmail(PasswordResetRequestForm $form)
    {
            /* @var $user User */
            $user = User::findOne([
                'status' => User::STATUS_ACTIVE,
                'email' => $form->email,
            ]);

            if (!$user) {
                throw new Exception('User does not exist');
            }

            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
                if (!$user->save()) {
                    throw new Exception('Save failed');
                }
            }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($form->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }
}