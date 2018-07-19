<?php
namespace frontend\services;
use common\essences\User;
use frontend\forms\SignupForm;


class SignupService
{
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public static function createUser(SignupForm $form){
        if (!$form->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $form->username;
        $user->email = $form->email;
        $user->setPassword($form->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}