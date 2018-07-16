<?php
namespace common\repositories;

use common\essences\Blog;
use common\essences\Comments;
use common\models\User;
use yii\data\ActiveDataProvider;

class BlogRepos
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getAuthor(Blog $essence)
    {
        return $essence->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getComments(Blog $essence)
    {
        return $essence->hasMany(Comments::className(), ['arcticle_id' => 'id']);
    }

    public static function getBlogs()
    {
        return new ActiveDataProvider([
            'query' => Blog::find()
        ]);
    }

    public static function getBlog($id)
    {
            $model = Blog::findOne($id);
            return $model;
    }
}