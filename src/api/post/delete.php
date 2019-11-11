<?php

require_once '../../../vendor/autoload.php';

use src\models\Post;

header('Access-Control-Allow-Methods: DELETE');

$post = new Post();
// Get raw posted data
$data = json_decode(file_get_contents('php://input'));
// Set ID to delete
$post->id = $data->id;
// Delete post
if ($post->delete()) {
    echo json_encode(['message' => 'Post Deleted']);
} else {
    echo json_encode(['message' => 'Post not Deleted']);
}
