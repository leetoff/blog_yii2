<?php
namespace frontend\services;
use frontend\forms\ResetPasswordForm;
class ResetPassService
{
    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public static function resetPassword(ResetPasswordForm $form)
{
    $user = $form->get_user();
    $user->setPassword($form->password);
    $user->removePasswordResetToken();
    return $user->save(false);
}

}