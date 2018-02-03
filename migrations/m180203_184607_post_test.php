<?php

use yii\db\Migration;
use app\models\Post;
use app\models\Language;
use app\models\Author;

/**
 * Class m180203_184607_post_test
 */
class m180203_184607_post_test extends Migration
{

    // Вынужденный хардкод, только из-за специфичности задачи

    private $title_words = [
        "Русский" => [
            "жесть", "удивительно", "снова", "совсем", "шок", "случай", "сразу", "событие", "начало", "вирус"
        ],
        "English" => [
            "currency", "amazing", "again", "absolutely", "shocking", "case", "immediately", "event", "beginning", "virus"
        ]
    ];

    private $text_words = [
        "Русский" => [
            "один", "еще", "бы", "такой", "только", "себя", "свое", "какой", "когда", "уже", "для", "вот", "кто", "да", "говорить", "год", "знать", "мой", "до", "или", "если", "время", "рука", "нет", "самый", "ни", "стать", "большой", "даже", "другой", "наш", "свой", "ну", "под", "где", "дело", "есть", "сам", "раз", "чтобы", "два", "там", "чем", "глаз", "жизнь", "первый", "день", "тута", "во", "ничто", "потом", "очень", "со", "хотеть", "ли", "при", "голова", "надо", "без", "видеть", "идти", "теперь", "тоже", "стоять", "друг", "дом", "сейчас", "можно", "после", "слово", "здесь", "думать", "место", "спросить", "через", "лицо", "что", "тогда", "ведь", "хороший", "каждый", "новый", "жить", "должный", "смотреть", "почему", "потому", "сторона", "просто", "нога", "сидеть", "понять", "иметь", "конечный", "делать", "вдруг", "над", "взять", "никто", "сделать"
        ],
        "English" => [
            "one", "yet", "would", "such", "only", "yourself", "his", "what", "when", "already", "for", "behold", "Who", "yes", "speak", "year", "know", "my", "before", "or", "if", "time", "arm", "no", "most", "nor", "become", "big", "even", "other", "our", "his", "well", "under", "where", "a business", "there is", "himself", "time", "that", "two", "there", "than", "eye", "a life", "first", "day", "mulberry", "in", "nothing", "later", "highly", "with", "to want", "whether", "at", "head", "need", "without", "see", "go", "now", "also", "stand", "friend", "house", "now", "can", "after", "word", "here", "think", "a place", "ask", "across", "face", "what", "then", "after all", "good", "each", "new", "live", "due", "look", "why", "because", "side", "just", "leg", "sit", "understand", "have", "finite", "do", "all of a sudden", "above", "to take", "no one", "make"
        ]
    ];

    private $languages = [];
    private $authors = [];

    public function up()
    {
        $this->loadAuthors();
        $this->loadLanguages();
        for($i = 1; $i <= 10000; $i++){
            $post = new Post();
            $post->author_id = array_rand($this->authors);
            $post->language_id = array_rand($this->languages);
            $post->title = $this->generateRandomTitle($post->language_id);
            $post->text = $this->generateRandomText($post->language_id);
            $post->created_at = $this->randomDate('2017-07-01 00:00:00', '2017-08-08 23:59:59');
            $post->likes = rand(1, rand(1,100));
            $post->save();
        }
    }

    public function down()
    {
        echo "m180203_184607_post_test cannot be reverted.\n";

        return false;
    }

    function randomDate($start_date, $end_date)
    {
        $min = strtotime($start_date);
        $max = strtotime($end_date);
        $val = rand($min, $max);
        return date('Y-m-d H:i:s', $val);
    }

    function loadAuthors(){
        $authors = Author::find()->all();
        foreach ($authors as $author){
            $this->authors[$author->id] = $author->name;
        }
    }

    function loadLanguages(){
        $languages = Language::find()->all();
        foreach ($languages as $language){
            $this->languages[$language->id] = $language->name;
        }
    }

    function generateRandomString($language_id, $words_source, $words_count){
        $string = '';
        $words = $words_source[$this->languages[$language_id]];
        for($i = 1; $i <= $words_count; $i++){
            $key = array_rand($words);
            $word = $words[$key];
            if ($i == 1){
                $word = mb_convert_case($word, MB_CASE_TITLE, "UTF-8"); // Возникла проблека с кодировкой
            }
            $string .= $word;
            if ($i < $words_count){
                $string .= ' ';
            }
        }
        return $string;
    }

    function generateRandomTitle($language_id){
        $title = $this->generateRandomString($language_id, $this->title_words, rand(4,6));
        return $title;
    }

    function generateRandomText($language_id){
        $text = '';
        $sentences_count = rand(3,4);
        for($i = 1; $i <= $sentences_count; $i++){
            $sentence = $this->generateRandomString($language_id, $this->text_words, rand(5,8)) . '.';
            $text .= $sentence;
            if($i < $sentences_count){
                $text .= ' ';
            }
        }
        return $text;
    }

}
