<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 */
class m180203_163534_create_posts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'language_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
            'title' => $this->string(),
            'text' => $this->text(),
            'likes' => $this->integer()
        ]);

        $this->createIndex(
            'idx-posts-author_id',
            'posts',
            'author_id'
        );

        $this->addForeignKey(
            'fk-posts-author_id',
            'posts',
            'author_id',
            'authors',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-posts-language_id',
            'posts',
            'language_id'
        );

        $this->addForeignKey(
            'fk-posts-language_id',
            'posts',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('posts');
    }
}
