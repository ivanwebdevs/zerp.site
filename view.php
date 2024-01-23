<?php 
$server = $_SERVER['HTTP_HOST'];
if (isset($_GET['id'])){

    function zerif_encode($string){
        ini_set('display_errors', 0);
    
        $pass = '1020';
        $method = 'aes128';
        $data = openssl_encrypt($string, $method, $pass);
        ini_set('display_errors', 1);
        return $data;

    }
    function zerif_decode($string){
        ini_set('display_errors', 0);
        $pass = '1020';
        $method = 'aes128';
        $data = openssl_decrypt($string, $method, $pass);
        ini_set('display_errors', 1);
        return $data;
    }
   
    $id_link = zerif_decode($_GET['id']);
}else{
    die("error not found");
}

?>


<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="./css/boostrap.css" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">

    </head>
    <body>

       
        <nav class='dark navbar navbar-expand-lg zerif_theme' aria-label="breadcrumb">
        <div class="container-fluid ">
              <a class="navbar-brand text-white" href="./">ZerSec</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
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
       

        <div class="container" style="max-width: 600px;">
            <br>
            <div class="card zerif_theme">
                <h2 class="card-header">Pesan masuk kamu</h2>
                <div class="card-body" >
                    <label>Silahkan bagikan link kamu di bawah</label>
                    <div class="input-group mb-3">
  <input id='input_link' disabled class="form-control" value='<?php echo "https://$server/comment.php?id=$id_link"?>' aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button  onclick='copy_link()' class="btn btn-outline-secondary" type="button">Copy</button>
  </div>
</div>



                    
                    <div id='pesan_masuk'  style="overflow-y: scroll; max-height:350px;  "></div>
                    <!--<div class="alert alert-primary" role="alert">
                        This is example
                      </div>
                      
-->
                  
                </div>
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $.post("api/get_info.php",{id_link:"<?php echo $id_link?>"},function(result,status){
                const div_pesan = document.getElementById("pesan_masuk");
                if (result.status){
                    div_pesan.innerHTML = "<h2>data ada</h2>";

                    var proses_update = "";
                    const pesan =result.pesan;

                  
                    pesan.forEach((data_for) => {
                   
                        proses_update = `<div class="alert alert-primary" role="alert">
                        ${data_for.pesan}</div>${proses_update} `;
                    });

                    div_pesan.innerHTML = proses_update;
                }else{
                    div_pesan.innerHTML = "<h2>Error Account tidak di temukan</h2>";
                }
            },"JSON");
            function logout() {   
    document.cookie = "my_url"+'=; Max-Age=-99999999;';  
}



function copy_link() {
  // Get the text field
  var copyText = document.getElementById("input_link");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);

  // Alert the copied text
  Swal.fire({text:"Link berhasil di copy",icon:"success"});
}
        </script>
    </body>
</html>