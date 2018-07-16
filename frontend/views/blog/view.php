<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\repositories\GetUserNameRepos;

/* @var $this yii\web\View */
/* @var $model common\essences\Blog */
/* @var $model1 common\essences\Comments*/

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
    <?= $model->body ?>
    <p>
    <p>
        <strong>Автор блога:</strong> <?= GetUserNameRepos::getUserName($model) ?>
    </p>
    <p>
        <strong>Дата публикации:</strong> <?= $model->datetime ?>
    </p>
    <?= $this->render('_commentform', [
        'model1' => $model1,
    ]) ?>

    <?= ?>

</main>
