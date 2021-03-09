 <?php 
 require 'function.php';
 $barang = query("SELECT * FROM master_barang"); //cara2
  // $conn = mysqli_connect("localhost","root","","test");
  // IF(!$conn){
  //    echo("gagal");
  // };

  // $result = mysqli_query($conn,"SELECT * FROM master_barang");
//  $result = mysqli_fetch_array($data);
//     var_dump($result);  

  //get
  // $_GET ["nama"] = 'ridwan';
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
  
?>
<!DOCTYPE html>
<html>
<head>
    <title>daftar barang</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<h1></h1>
</head>
  <body>
  <div class="container">
  <h2>DATA BARANG</h2>
  <table class="table">
    <thead>
      <tr  class="warning">
        <th>No.</th>
        <th>Nama Barang</th>
        <th>Gambar</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php $no = 1 ?>
    <?php
    //  while($row = mysqli_fetch_assoc($result)):  cara 1
      foreach($barang as $row): //cara 2
     ?>

     <tr class="success">
        <td><?= $no ?></td>
        <td><?= $row["nama_barang"]?></td>
        <td><img src ="img/<?= $row["gambar_barang"] ?>"></td>
        <td>
            <a href = "">Tambah |</a>
            <a href = "">Ubah</a>
        </td>
      </tr>
      <?php $no++?>
    <?php 
      // endwhile; //cara 1
      endforeach;
    ?>
    </tbody>
  </table>
</div>


    
    


</body>

</html>
