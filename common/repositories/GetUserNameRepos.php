<?php
namespace common\repositories;

use common\essences\Blog;
use common\models\User;
class GetUserNameRepos{
    public static function getUserName(Blog $blog){

            $creator = User::findOne($blog->author_id);
            return $creator->username;
    }
}