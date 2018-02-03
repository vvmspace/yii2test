<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 */
class m180203_163534_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'language_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
            'title' => $this->string(),
            'text' => $this->text(),
            'likes' => $this->integer()
        ]);

        $this->createIndex(
            'idx-post-author_id',
            'post',
            'author_id'
        );

        $this->addForeignKey(
            'fk-post-author_id',
            'post',
            'author_id',
            'author',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-post-language_id',
            'post',
            'language_id'
        );

        $this->addForeignKey(
            'fk-post-language_id',
            'post',
            'language_id',
            'language',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('post');
    }
}
