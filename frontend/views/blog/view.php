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
    <p class="p_post">
        <?php echo $model->body; ?>
    </p>

    <p>
        <strong>Автор блога:</strong> <?= GetUserNameRepos::getUserName($model) ?>
    </p>
    <p>
        <strong>Дата публикации:</strong> <?= $model->datetime ?>
    </p>
    <a class="post_comment">Написать комментарий</a>
    <div id="parent_comment"></div>
    <?= $this->render('_commentform', [
        'model1' => $model1,
    ]) ?>
            <ul>
                <?php $comments = Comments::find()->where(['arcticle_id'=>$model->id])->with("author")->all();
                buildcomment($comments);?>
            </ul>
<!--            <!-- Подключаем jquery с сервера Яндекса -->
            <script type="text/javascript" src="http://yandex.st/jquery/1.7.1/jquery.min.js"></script>
<!--     Наш скрипт запроса и обработки-->
    <script type="text/javascript">
        $(document).ready(function() {
            // Вешаем обработчик события "клик" на все ссылки с классом ajax_link
            $('button.submit').click(function() {
                // Берем действие из атрибута data-action ссылки
                var parent = $(this).data('parent');
                var level = $(this).data('level');
                var str = '#div_hidden_input'+parent;
                // query append
                        $('#comments-parent_id').val(parent);
                        $('#comments-level').val(level);
                var div_input = $(str);
                div_input.append($( ".blog-form" ));
            });
            $('a.post_comment').click(function() {
                $('#parent_comment').append($( ".blog-form" ));
            });
        });
    </script>
<!--    <script type="text/javascript" src="../../web/js/answerButton.js"></script>-->
    <?php
    function buildcomment(&$comments,$current_id=0)
    {
        foreach ($comments as $comment){
            if ($comment->parent_id==$current_id)
            {?>
                <li class="comment" style="margin-left:<?=40*$comment->level?>px">
                    <b><?= Html::encode(CommentsRepos::getUserName($comment));?></b>
                <i>| <?= Html::encode($comment->datetime);?></i>
                <br>
                    <p class="commentText">
                <?= Html::encode($comment->text); ?>
                    </p>
                <br>
                <button class="submit" type="submit" id="<?= $comment->id?>"
                 data-parent="<?= $comment->id?>"
                    data-level="<?= $comment->level+1?>"><span>Ответить</span></button>
                    <div id="div_hidden_input<?= $comment->id?>">
                    </div>
                    <hr>
                </li>
                <?php buildcomment($comments,$comment->id);
            }
        }
    } ?>


</main>