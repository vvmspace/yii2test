<?php

use yii\db\Migration;
use app\models\Language;

/**
 * Class m180203_182359_languages
 */
class m180203_182359_languages extends Migration
{
    public function up()
    {
        $language_names = ["Русский", "English"];
        foreach ($language_names as $language_name){
            $language = new Language();
            $language->name = $language_name;
            $language->save();
        }
    }

    public function down()
    {
        echo "m180203_182359_languages cannot be reverted.\n";

        return false;
    }
}
