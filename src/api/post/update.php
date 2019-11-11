<?php

require_once '../../../vendor/autoload.php';

use src\models\Post;

header('Access-Control-Allow-Methods: PUT');

$post = new Post();
// Get raw posted data
$data = json_decode(file_get_contents('php://input'));

$post->id = $data->id;
$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;
// Update post
if ($post->update()) {
    echo json_encode(['message' => 'Post Updated']);
} else {
    echo json_encode(['message' => 'Post not Updated']);
}
