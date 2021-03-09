<?php
require "function.php";

IF (isset($_POST["simpan"])){
    IF (tambah($_POST) > 0){
        // echo "<script>alert ('data berhasil disimpan'); </script> ";
    }else{
        // echo "<script>alert ('data Gagal disimpan'); </script> ";

    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>form tambah</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Input Barang</h2>
  <form action="" method ="post">
    <div class="form-group">
      <label for="nama_barang">Nama Barang:</label>
      <input type="text" class="form-control" name = "nama_barang" id="nama_barang" placeholder="Tulis Nama Barang" name="name_barang">
    </div>
    <div class="form-group">
      <label for="Keterangan">Keterangan:</label>
      <textarea class="form-control"  id="keterangan" name="keterangan"></textarea>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="aktif" > Aktif</label>
    </div>
    <button type="submit" name ="simpan" class="btn btn-default">Simpan</button>
  </form>
</div>

</body>
</html>
