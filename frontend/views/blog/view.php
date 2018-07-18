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
            <ul>
                <?php buildcomment($model->id);?>
            </ul>
            <!-- Подключаем jquery с сервера Яндекса -->
            <script type="text/javascript" src="http://yandex.st/jquery/1.7.1/jquery.min.js"></script>
    <!-- Наш скрипт запроса и обработки -->
    <script type="text/javascript">
        $(document).ready(function() {
            // Вешаем обработчик события "клик" на все ссылки с классом ajax_link
            $('button.ajax_link').click(function() {
                // Берем действие из атрибута data-action ссылки
                var parent = $(this).data('parent');
                var level = $(this).data('level');
                // query append
                        $('#comments-parent_id').val(parent);
                        $('#comments-level').val(level);
            })
        })
    </script>
    <?php
    function buildcomment($post_id,$current_id=0)
    {
        $comments = Comments::find()->where(['arcticle_id'=>$post_id])->all();
        foreach ($comments as $comment){
            if ($comment->parent_id==$current_id)
            {?>
                <li class="comment" style="margin-left:<?=40*$comment->level?>px">
                    <b><?= Html::encode(CommentsRepos::getUserName($comment));?></b>
                <i><?= Html::encode($comment->datetime);?></i>
                <br>
                <?= Html::encode($comment->text); ?>
                <br>
                <button class="ajax_link" id="<?= $comment->id?>"
                 data-parent="<?= $comment->id?>"
                    data-level="<?= $comment->level+1?>">Ответить</button>
                </li>
                <?php buildcomment($post_id,$comment->id);
            }
        }
    } ?>


</main>