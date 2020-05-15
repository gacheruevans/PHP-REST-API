<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Controll-Allow-Methods: DELETE');
    header('Access-Controll-Allow-Headers: Access-Control-Allow-Headers, Access-Controll-Allow-Methods, Authorization, X-Requested-With');

    //Initializes Api
    include_once('../core/initialize.php');

    //Instantiate post
    $post = new Post($db);

    //Get raw posted data
    $data = json_decode(file_get_contents('php://input'));

    $post->id = $data->id;

    //Update post
    if($post->delete()) {
        echo json_encode(
            array('Message' => 'Post successfully deleted.')
        );
    }else {
        echo json_encode(
            array('Message' => 'Post Not deleted.')
        ); 
    }
?>
