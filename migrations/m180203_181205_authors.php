<?php

use yii\db\Migration;
use app\models\Author;

/**
 * Class m180203_181205_authors
 */
class m180203_181205_authors extends Migration
{

    public function up()
    {
        $authors_names = ["CrazyNews", "Чук и Гек", "CatFuns", "CarDriver", "BestPics", "ЗОЖ", "Вася Пупкин", "Готовим со вкусом", "Шахтёрская Правда", "FunScience"];
        foreach ($authors_names as $author_name){
            $author = new Author();
            $author->name = $author_name;
            $author->save();
        }
    }

    public function down()
    {
        echo "m180203_181205_authors cannot be reverted.\n";

        return false;
    }
}
