<?php
  $conn = mysqli_connect("localhost","root","","test");
  IF(!$conn){
     echo("gagal");
  };

  $data = mysqli_query($conn,"SELECT * FROM master_barang");
  $result = mysqli_fetch_array($data);
   var_dump($result["id_barang"]);  

  //get
  $_GET ["nama"] = 'ridwan';
  // var_dump($_GET);

  $data_barang = [
      ["id_barang"    => "01",
       "nama_barang"  =>"Baju muslim",
       "status_barang"  =>"aktif",
       "photo"  =>"aktif"
    ],
    ["id_barang"    => "02",
        "nama_barang"  =>"Baju muslim Perempuan",
        "status_barang"  =>"aktif",
        "photo"  =>"aktif"
  ]
  ];
?>
<!DOCTYPE html>
<html>
<head>
<h1>daftar barang</h1>
</head>
  <body>
    
    <ul>
    <?php foreach($data_barang as $barang): ?>
      <li>  
       
        <a href="latihan_get.php?nama=<?=$barang["nama_barang"];?>&id=<?=$barang["id_barang"]; ?>"> <!-- cara peningriman get: ?nama= tag php  -->
          <?= $barang["nama_barang"]; ?>
        </a>
      </li>
     <?php endforeach; ?>
    </ul>
    


</body>

</html>
