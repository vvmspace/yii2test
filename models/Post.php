<?php

namespace app\models;
use yii\db\ActiveRecord;


class Post extends ActiveRecord
{
    public function getAuthor(){
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }
    public function getLanguage(){
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }
}