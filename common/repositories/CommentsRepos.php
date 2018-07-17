<?php

namespace common\repositories;
use common\essences\Blog;
use common\essences\Comments;
use common\models\User;

class CommentsRepos
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getArcticle(Comments $essence)
    {
        return $essence->hasOne(Blog::className(), ['id' => 'arcticle_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getAuthor(Comments $essence)
    {
        return $essence->hasOne(User::className(), ['id' => 'author_id']);
    }

    public static function getUserName(Comments $essence){

        $creator = User::findOne($essence->author_id);
        return $creator->username;
    }
}