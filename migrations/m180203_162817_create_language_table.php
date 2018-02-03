<?php

use yii\db\Migration;

/**
 * Handles the creation of table `language`.
 */
class m180203_162817_create_language_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('language', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('language');
    }
}
