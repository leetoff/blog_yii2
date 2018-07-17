<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\repositories\GetUserNameRepos;
use common\essences\Comments;
use common\repositories\CommentsRepos;

/* @var $this yii\web\View */
/* @var $model common\essences\Blog */
/* @var $model1 common\essences\Comments*/

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="p_post">
    <?= $model->body ?>
    </div>
    <p>
        <strong>Автор блога:</strong> <?= GetUserNameRepos::getUserName($model) ?>
    </p>
    <p>
        <strong>Дата публикации:</strong> <?= $model->datetime ?>
    </p>
    <?= $this->render('_commentform', [
        'model1' => $model1,
    ]) ?>
        <?php $comments = Comments::find()->where(['arcticle_id'=>$model->id])->all();?>
        <ul>
            <?php foreach($comments as $comment){?>
            <li class="comment">
                <b><?= Html::encode(CommentsRepos::getUserName($comment));?></b>
                <i><?= Html::encode($comment->datetime);?></i>
            <br>
                <?= Html::encode($comment->text); ?>
                <a href="#"
                      id="<?= $comment->id?>"
                      data-parent="<?= $comment->id?>"
                      data-level="<?= $comment->level+1?>"
                >Ответить</a>
                <hr>
            </li>
            <?php } ?>
        </ul>

</main>
