<?php
/**
 * Created by PhpStorm.
 * User: vvm
 * Date: 04.02.18
 * Time: 3:46
 */

namespace app\controllers;
use app\models\Post;
use yii\web\Controller;


class PostController extends Controller
{
    function actionIndex(){
        $posts = Post::find()->orderBy(['likes' => SORT_DESC])->limit(1000)->all();
        foreach ($posts as $post){
            echo "{$post->title}<br />{$post->text}<br />{$post->author->name}<br />{$post->language->name}<br />{$post->likes}<br /><br />";
        }
    }
}