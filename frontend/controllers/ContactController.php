<?php
namespace frontend\controllers;

use frontend\services\ContactService;
use Yii;
use yii\web\Controller;
use frontend\forms\ContactForm;

class ContactController extends Controller
{
    /**
     * {@inheritdoc}
     */


    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (ContactService::sendEmail($model,Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
}