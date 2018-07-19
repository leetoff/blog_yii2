<?php
namespace frontend\services;

use frontend\forms\ContactForm;
use Yii;
class ContactService
{
    public static function sendEmail(ContactForm $form,$email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$form->email => $form->name])
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();
    }
}