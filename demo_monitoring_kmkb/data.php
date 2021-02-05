<?php
	if(!isset($_POST['func'])) {$_POST['func'] = "" ;}
	if(function_exists($_POST['func'])) {
		$_POST['func']();
	}
	
	function login() {
		session_start();
		require_once 'koneksi.php';
		
		
		
		$nama_user = $_POST['namauser'];
		$password = $_POST['password'];
		$tanggal	= date('Y-m-d H:i:s.B');
		$pesan = '';
		
		$sql_user = "SELECT USERID,
							KD_GRP,
							NAMA_LENGKAP,
							PASSWORD,
							convert(CHAR(10), TGL_EXPIRE, 23) + ' ' + convert(CHAR(8), TGL_EXPIRE, 20) AS TGL_EXPIRE
					   FROM USERDAT
					  WHERE NAMA_USER = '$nama_user'";
		
		$query_user = sybase_query($sql_user);
		
		if(sybase_num_rows($query_user)) {
			while($row = sybase_fetch_array($query_user)) {
				$userid = $row['USERID'];
				$kd_grup = $row['KD_GRP'];
				$nama_lengkap = $row['NAMA_LENGKAP'];
				$pass = $row['PASSWORD'];
				$tgl_expire = $row['TGL_EXPIRE'];
			}
		} else {
			$userid = '';
			$kd_grup = '';
			$nama_lengkap = '';
			$pass = '';
			$tgl_expire = '';
		}
		
		if($userid) {
			if( substr($kd_grup, 0, 3) == 'DOK' || substr($kd_grup, 0, 3) == 'KRU' || substr($kd_grup, 0, 3) == 'CSM' ) {
			// if(strpos($kd_grup, 'ADM') >= 0) {
				if($tgl_expire >= $tanggal) {
					$pass_encrypt = encrypt($userid, $nama_user, $password);
					//var_dump($pass_encrypt);
					if($pass == $pass_encrypt) {
						$_SESSION['userid'] = $userid;
						$_SESSION['kd_grup'] = $kd_grup;
						$_SESSION['nama_lengkap'] = $nama_lengkap;
						$_SESSION['tgl_login'] = $tanggal;
						
						$pesan = 'ok';
					} else {
						$pesan = 'Nama user atau password salah ';
					}
				} else {
					$pesan = 'User sudah tidak dapat digunakan';
				}
			} else {
				$pesan = 'User tidak memiliki hak akses';
			}
		} else {
			$pesan = 'Nama user atau password salah ';
		}
		
		echo $pesan;
	}
	
	function logout() {
		session_start();
		session_destroy();
	}
	
	
	function encrypt($userid, $username, $password) {
		$plain = substr($username, 0, 3) . substr($password, 0, 3) . substr($userid, 0, 3);
		
		if((intval($userid) % 2) > 0)
		{
		}elseif((intval($userid) % 4) > 0 || (intval($userid) % 6) > 0)
		{
			$plain = substr($userid, 0, 3) . substr($username, 0, 3) . substr($password, 0, 3);
		} else {
			$plain = substr($password, 0, 3) . substr($userid, 0, 3) . substr($username, 0, 3);
		}
		
		$pass = substr($username, 3, strlen($username) - 3) . substr($password, 3, strlen($password) - 3) . substr($userid, 3, 1);
		
		$idpass = $plain . $pass;
		$panjang = strlen($idpass);
		
		$char = array();
		$i_encrypt = array();
		$c_encrypt = array();
		
		$i = 0;
		
		While ($panjang-1 >= $i){
			
			 $char[$i]    = substr($idpass, $i, 1);
			 $i_encrypt[$i] = ord($char[$i]) + 128;
			 $c_encrypt[$i] = chr($i_encrypt[$i]);
			 
			 $i++;
		}
		$i = 0;
		$encrypt = "";
		While ($panjang-1 >= $i){
			$encrypt .= $c_encrypt[$i];
			$i++;
		}
		
		$res = $encrypt;
				
		return $res;
	}
	
?>