<?php 
header("Content-Type: application/json");

if (isset($_POST['id_link'],$_POST['pesan'])){

    $id_link = $_POST['id_link'];
    $pesan = strip_tags($_POST['pesan']);
    $database = file_get_contents("database/data.txt");
    $json_obj = json_decode($database);
    if (isset($json_obj->$id_link)){
        $waktu = date("h:i:sa");
        $id_pesan = "idpesan".uniqid();
        if (!($json_obj->$id_link->pesan == null)){
            echo json_encode(["status"=>true]);

            $json_obj->$id_link->pesan->$id_pesan = ["pesan"=>"$pesan","waktu"=>"$waktu"];


        }else{
            echo json_encode(["status"=>true]);

            $json_obj->$id_link->pesan = ["$id_pesan"=>["pesan"=>"$pesan","waktu"=>"$waktu"]];

            
        }
        file_put_contents("database/data.txt",json_encode($json_obj,JSON_PRETTY_PRINT));




    }else{
        echo json_encode(["status"=>false]);
    }
    
}else{
    echo json_encode(["status"=>false]);
}