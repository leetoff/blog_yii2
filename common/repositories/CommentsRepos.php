<?php

use common\essences\Blog;
use common\essences\Comments;
use common\models\User;

class CommentsRepos
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArcticle(Comments $essence)
    {
        return $this->hasOne(Blog::className(), ['id' => 'arcticle_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor(Comments $essence)
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
}