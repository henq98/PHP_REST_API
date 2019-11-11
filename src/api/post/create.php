<?php

require_once '../../../vendor/autoload.php';

use src\models\Post;

header('Access-Control-Allow-Methods: POST');

$post = new Post();
// Get raw posted data
$data = json_decode(file_get_contents('php://input'));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;
// Crate post
if ($post->create()) {
    echo json_encode(['message' => 'Post created']);
} else {
    echo json_encode(['message' => 'Post not created']);
}
