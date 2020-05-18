<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Controll-Allow-Methods: POST');
    header('Access-Controll-Allow-Headers: Access-Control-Allow-Headers, Access-Controll-Allow-Methods, Authorization, X-Requested-With');

    //Initializes Api
    include_once('../core/initialize.php');

    //Instantiate post
    $post = new Authenticate($db);

    //Get raw posted data
    $data = json_decode(file_get_contents('php://input'));

    $post->fname = $data->fname;
    $post->lname = $data->lname;
    $post->email = $data->email;
    $post->password = $data->password;

    //Create post
    if($post->register()) {
        echo json_encode(
            array('Message' => 'New User Created.')
        );
    }else {
        echo json_encode(
            array('Message' => 'User Not Created.')
        ); 
    }
?>
