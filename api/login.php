<?php
   //Headers
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   header('Access-Controll-Allow-Methods: POST');
   header('Access-Controll-Allow-Headers: Access-Control-Allow-Headers, Access-Controll-Allow-Methods, Authorization, X-Requested-With');

    //Initialize API
    include_once('../core/initialize.php');

    //Instantiate post
    $post = new Authenticate($db);

     //Get raw posted data
     $data = json_decode(file_get_contents('php://input'));

     $post->email = $data->email;
     $post->password = $data->password;

    //Get record
    $post->login();
?>
