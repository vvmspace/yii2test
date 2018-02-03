<?php

use yii\db\Migration;

/**
 * Handles the creation of table `author`.
 */
class m180203_161159_create_author_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('author', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('author');
    }
}
