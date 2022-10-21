<?php
    mysqli_report(MYSQLI_REPORT_OFF);
    $mysqli   =   new mysqli("localhost","root","","vue_crud");
    // Check connection
    if ($mysqli->connect_errno) {
        die ("Failed to connect to MySQL: ".$mysqli -> connect_error);
    }
    $response     =   ["error" => false];
    $action = 'read';
    if(isset($_GET['action'])){
        $action =   $_GET['action'];
    };

    if($action=="read"){
        $users=[];
        $result = $mysqli->query('SELECT * FROM `users`');
        while($row=$result->fetch_assoc()){
            array_push($users, $row);
        }
        $response["users"]     =  $users;
    }elseif($action=="create"){
        $name       =  $_POST['name'];
        $username   =  $_POST['username'];
        $email      =  $_POST['email'];
        
        $sql ="INSERT INTO users (name,username,email) VALUES ('$name','$username','$email')";
        $result = $mysqli->query($sql);
        if($result){
            $response["message"]    =  "Data save successfully";
        }else{
            $response["error"]      =   true;
            $response["message"]    =  "Data save failed";
        }

    }elseif($action=="update"){
        $id         =  $_POST['id'];
        $name       =  $_POST['name'];
        $username   =  $_POST['username'];
        $email      =  $_POST['email'];
        
        $sql =" UPDATE `users` SET `name`='$name',`username`='$username',`email`='$email' WHERE `id`='$id' ";
        $result = $mysqli->query($sql);
        if($result){
            $response["message"]    =  "Data update successfully";
        }else{
            $response["error"]      =   true;
            $response["message"]    =  "Data update failed";
        }
    }elseif($action=="delete"){
        $id       =  $_POST['id'];
        $sql ="DELETE FROM `users` WHERE id= '$id' ";
        $result = $mysqli->query($sql);
        if($result){
            $response["message"]    =  "Data delete successfully";
        }else{
            $response["error"]      =   true;
            $response["message"]    =  "Data delete failed";
        }
    }else{
        die("Invalid Action");
    }
    header("content-type: application/json");
    echo json_encode($response);

  ?>
  

