<?php 


if (isset($_GET['id'])){

    $id_link = $_GET['id'];

    $database = file_get_contents("./api/database/data.txt");
    $json_obj = json_decode($database);
    if (isset($json_obj->$id_link)){
        $json_obj->$id_link->status = true;
        $data_pesan_fix = [];
        if ($json_obj->$id_link->pesan == null){
            $json_obj->$id_link->pesan = [];
        }
        foreach($json_obj->$id_link->pesan as $data_pesan){
            $data_pesan_fix[] = $data_pesan;
        }
        $json_obj->$id_link->pesan = $data_pesan_fix;
        $json_data = $json_obj->$id_link;
    }else{
        die("Not found");
    }
    
}else{
    die("Not found");
}

?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="./css/boostrap.css" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">
    </head>
    <body>

    <nav class='dark navbar navbar-expand-lg zerif_theme' aria-label="breadcrumb">
        <div class="container-fluid ">
              <a class="navbar-brand text-white" href="./">ZerSec</a>
              <button class="navbar-toggler zerif_button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fa-solid fa-bars fa-fade"></i>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link  text-white" aria-current="page" href="./">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="contact.html">Contact</a>
                  </li>

                </ul>
              </div>
            </div>
</nav>

        <div class="container " style="max-width: 600px;">
            <br>
            <div class="card zerif_theme">
                <h3 class="card-header">Masukan komentar untuk <font color='red'><?php echo $json_data->nama?></font></h3>
                <div class="card-body">
                    <ul>
                        <li>Si <?php echo $json_data->nama?> tidak akan tau siapa pengirim nya</li>
                        <li>Kirim pesan mu ke <?php echo $json_data->nama?> dengan aman</li>
                        <li>Ayo bersenang senang dengan <?php echo $json_data->nama?></li>
                    </ul>
                    <input id="pesan" class="form-control" placeholder="Masukan apa yang kamu pikirkan tentang <?php echo $json_data->nama?>">
                    <br>
                    <button onclick="kirim_pesan()" class="btn btn-primary">Kirim Pesan</button>
                </div>
            </div>
        </div>





        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            function kirim_pesan(){

                const pesan = document.getElementById("pesan").value;
                $.post("api/komen.php",{id_link:"<?php echo $id_link?>",pesan:pesan},function(result,status){
                    if (result.status){
                        Swal.fire({text:"Berhasil kirim pesan",icon:"success"});
                        document.getElementById("pesan").value = "";
                    }else{
                        Swal.fire({text:"Gagal kirim pesan",icon:"error"});
                    }
                },"JSON");
            }
        </script>
    </body>
</html>