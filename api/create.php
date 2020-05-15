<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Controll-Allow-Methods: POST');
    header('Access-Controll-Allow-Headers: Access-Control-Allow-Headers, Access-Controll-Allow-Methods, Authorization, X-Requested-With');

    //initializes Api
    include_once('../core/initialize.php');

    //instantiate post
    $post = new Post($db);

    //get raw posted data
    $data = json_decode(file_get_contents('php://input'));

    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;

    //create post
    if($post->create()) {
        echo json_encode(
            array('Message' => 'Post Created.')
        );
    }else {
        echo json_encode(
            array('Message' => 'Post Was Not Created.')
        ); 
    }
?>