<?php

require_once '../../../vendor/autoload.php';

use src\models\Post;

header('Access-Control-Allow-Methods: GET');

$post = new Post();

$post->id = isset($_GET['id']) ? $_GET['id'] : die();
// Get post
$post->readOne();
// Create array
$post_arr = [
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name,
];

print_r(json_encode($post_arr));
