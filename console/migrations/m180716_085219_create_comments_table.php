<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `blog`
 */
class m180716_085219_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'arcticle_id' => $this->integer()->notNull(),
            'level' => $this->integer()->defaultValue(0),
            'parent_id' => $this->integer()->defaultValue(0),
            'datetime' => $this->datetime(),
            'text' => $this->text(),
        ], "CHARACTER SET utf8 COLLATE utf8_general_ci");

        // creates index for column `author_id`
        $this->createIndex(
            'idx-comments-author_id',
            'comments',
            'author_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-comments-author_id',
            'comments',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `arcticle_id`
        $this->createIndex(
            'idx-comments-arcticle_id',
            'comments',
            'arcticle_id'
        );

        // add foreign key for table `blog`
        $this->addForeignKey(
            'fk-comments-arcticle_id',
            'comments',
            'arcticle_id',
            'blog',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-comments-author_id',
            'comments'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-comments-author_id',
            'comments'
        );

        // drops foreign key for table `blog`
        $this->dropForeignKey(
            'fk-comments-arcticle_id',
            'comments'
        );

        // drops index for column `arcticle_id`
        $this->dropIndex(
            'idx-comments-arcticle_id',
            'comments'
        );

        $this->dropTable('comments');
    }
}
