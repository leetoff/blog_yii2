<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m180716_083954_create_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('blog', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'datetime' => $this->datetime(),
            'title' => $this->string(),
            'body' => $this->text(),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-blog-author_id',
            'blog',
            'author_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-blog-author_id',
            'blog',
            'author_id',
            'user',
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
            'fk-blog-author_id',
            'blog'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-blog-author_id',
            'blog'
        );

        $this->dropTable('blog');
    }
}
