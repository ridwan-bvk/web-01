<?php
$server = "SRV15";
$username = "sa";
$password = "starwars";
$database = "FO_BLJ_20191115";

$refresh = 60; //detik

sybase_min_server_severity(11);
sybase_min_client_severity(11);

//Koneksi server
$link = sybase_connect($server, $username, $password) or die ("Koneksi Gagal!");
if(@$_POST['restart']){
	sybase_close($link);
	$link = sybase_connect($server, $username, $password) or die ("Koneksi Gagal!");
}

if (!$link) {
	die('Koneksi Gagal');
}

//Pilih database
$db_selected = sybase_select_db($database, $link);
if (!$db_selected) {
    die ('Tidak bisa memilih database');
}
?>