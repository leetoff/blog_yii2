<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class AboutController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}