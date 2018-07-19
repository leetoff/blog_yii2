<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model1 common\essences\Comments  */
/* @var $form yii\widgets\ActiveForm */
?>

<div  class="blog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeHiddenInput($model1, 'parent_id',['value' => 0]) ?>
    <?= Html::activeHiddenInput($model1, 'level',['value' => 0]) ?>

    <?= $form->field($model1, 'text')->textarea(['rows' => 2,'placeholder'=>"Введите комментарий..."]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
