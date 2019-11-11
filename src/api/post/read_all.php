<?php

require_once '../../../vendor/autoload.php';

use src\models\Post;

header('Access-Control-Allow-Methods: GET');

$post = new Post();
// Blog post query to read all posts
$result = $post->readAll();
// Get row count from query result
$num = $result->rowCount();
// Check if any posts
if ($num > 0) {
    // This will return all post properties inside "data" array
    $post_arr['data'] = [];

    while ($row = $result->fetch()) {
        extract($row);

        $post_item = [
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name,
        ];
        // Push all post properties inside "data" array
        array_push($post_arr['data'], $post_item);
    }
    echo json_encode($post_arr);
} else {
    // No Posts
    echo json_encode(['message' => 'No Posts found']);
}
