<?php 
header("Content-Type: application/json");

if (isset($_POST['id_link'])){

    $id_link = $_POST['id_link'];
    
    $database = file_get_contents("database/data.txt");
    $json_obj = json_decode($database);
    if (isset($json_obj->$id_link)){
        $json_obj->$id_link->status = true;
        $data_pesan_fix = [];
        foreach($json_obj->$id_link->pesan as $data_pesan){
            $data_pesan_fix[] = $data_pesan;
        }
        $json_obj->$id_link->pesan = $data_pesan_fix;
        echo json_encode($json_obj->$id_link,JSON_PRETTY_PRINT);
    }else{
        echo json_encode(["status"=>false]);
    }
    
}else{
    echo json_encode(["status"=>false]);
}