<?php

namespace common\services;
use common\forms\LoginForm;
use Yii;

class LoginService{
    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public static function login(LoginForm $form)
    {
        if ($form->validate()) {
            return Yii::$app->user->login($form->getUser(), $form->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }
}