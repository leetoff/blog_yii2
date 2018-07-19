<?php
use frontend\forms\SettingsUpdateForm;
use Exception;
class SettingsUpdateService
{
    public static function update(SettingsUpdateForm $form)
    {
        if ($form->validate()) {
            $user = $form->get_user();
            $user->email = $form->email;
            return $user->save();
        } else {
            throw new Exception('Save failed');
        }
    }
}

