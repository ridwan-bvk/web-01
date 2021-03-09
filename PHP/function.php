<?php
  $conn = mysqli_connect("localhost","root","","test");
  IF(!$conn){
     echo("gagal");
  };

//cara 1
//   $result = mysqli_query($conn,"SELECT * FROM master_barang"); //bisa dipindah ke function

//cara 2
//function menyederhanaka pemggilan
  function query($query){
      global $conn;
      $result =mysqli_query($conn,$query); 
      $row=[];//kosongkan array
    while ($data = mysqli_fetch_assoc($result)){
        $row[] = $data;        
    }
    return $row;
  }


  function tambah($data){
      global $conn;
      $nama_barang = $data["nama_barang"];
      $ket_barang = $data["keterangan"];
     
      IF (empty($data["aktif"])){
        $data["aktif"] ='0';

      }else{
        $data["aktif"]='1';
      }
      $aktif       =$data["aktif"];

      $query = "INSERT INTO master_barang
                 VALUES('','$nama_barang','','$aktif',' $ket_barang')";
    
     mysqli_query($conn,$query);
   
     IF (mysqli_affected_rows($conn)> 0){
       echo 'berhasil';
     }else{
      echo 'Gagal'. mysqli_error($conn);
     }

    //  return;


  }
?>

<!-- //   $result = mysqli_fetch_assoc($data);
  //  var_dump($result["id_barang"]);  
  //$data_barang = $result;
  //get
//   $_GET ["nama_barang"] = $data_barang['nama_barang'];
//   $_GET ["id_barang"] = $data_barang['id_barang'];
//$_GET [$result] = $result;
  // var_dump($_GET);

  // $data_barang = [
  //     ["id_barang"    => "01",
  //      "nama_barang"  =>"Baju muslim",
  //      "status_barang"  =>"aktif",
  //      "photo"  =>"aktif"
  //   ],
  //   ["id_barang"    => "02",
  //       "nama_barang"  =>"Baju muslim Perempuan",
  //       "status_barang"  =>"aktif",
  //       "photo"  =>"aktif"
  // ]
  // ];
  //fungsi get -->