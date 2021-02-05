<?php
session_start();
if(!$_SESSION['userid']){
	header("Location: index.php");
}
include 'header.php';
include 'sidebar.php';
?>
<div class="page-content">
	<div class="container">
		<div>
			<a href="#" class="panel-left">Menu</a>
		</div>
		
		<section class="hero is-bold">
			<div class="hero-body page-title">
				<div class="container">
					<h1 class="title">
						LIST DATA PASIEN
					</h1>
				</div>
			</div>
		</section>
		
		
		<section class="section is-small">
			<table id="list_pasien" class="display" style="width:100%">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>No. RM</th>
					<th>Tgl Masuk</th>
					<th>Ruang Rawat</th>
					<th>Diagnosa</th>
					<th>Lama Dirawat</th>
					<th>Prosentase</th>
				</tr>
			</thead>
			<tbody>
			
			<?php
				
				$kd_group 		= substr($_SESSION['kd_grup'], 0, 3);
				$userid 		= $_SESSION['userid'];
				//$tgl_login 		= $_SESSION['tgl_login'];
				$tgl_login 		= '2019-10-21 11:02:20.000';
				$add = '';
				
				if($kd_group == 'DOK'){
					$sql = "SELECT TOP 1 KD_DOKTER_RSF 
					            FROM TDOKTER_RSF
							 WHERE USERID = '$userid' ";
				
					$query 	= sybase_query($sql);
					$row	= sybase_fetch_array($query);
					$kd_dokter_rsf = $row['KD_DOKTER_RSF'];
					
					$add = "AND KD_DOKTER_DPJP = '$kd_dokter_rsf'" ;
				}else if($kd_group == 'KRU'){
					$sql = "SELECT KD_RRAWAT  
								FROM MAP_KMKB_RRAWAT_PC
							WHERE USERID = '$userid'";
				
					$query 	= sybase_query($sql);
					$row	= sybase_fetch_array($query);
					$kd_rrawat = $row['KD_RRAWAT'];
					$add = "AND KD_RRAWAT = '$kd_rrawat'" ;
					
				}
				
				
				$sql = "SELECT 	TGL_LOGIN,   	TGL_REG,         NORM,     		  NAMA,           
								LAMA_DIRAWAT,   PERSENTASE,      DOKTER_DPJP,     KD_ICD_UTAMA,    
								ICD_UTAMA,      KD_ICD_1,        ICD_1,           KD_ICD_2,        
								ICD_2,          KD_ICD_3,        ICD_3,           KD_ICD_4,        
								ICD_4,          KD_ICD_5,        ICD_5,           KD_ICD_6,        
								ICD_6,          KD_ICD_7,        ICD_7,           KD_DOKTER_DPJP,  
								KD_RRAWAT,      KET_RRAWAT      
							FROM STAT_PASIEN_KMKB
						WHERE TGL_LOGIN = '$tgl_login'
							  AND NAMA_HOST = 'DEMO'
							  $add
						  ";
			
				$query = sybase_query($sql);
				$i = 1;
				if(sybase_num_rows($query)) {
					while($row = sybase_fetch_array($query)) {
						$tgl_masuk = date("d-m-Y H:i", strtotime($row['TGL_REG']));
						$kd_icd_utama = $row['KD_ICD_UTAMA'];
						$kd_icd_1 = $row['KD_ICD_1'];
						$kd_icd_2 = $row['KD_ICD_2'];
						$kd_icd_3 = $row['KD_ICD_3'];
						$kd_icd_4 = $row['KD_ICD_4'];
						$kd_icd_5 = $row['KD_ICD_5'];
						$kd_icd_6 = $row['KD_ICD_6'];
						$kd_icd_7 = $row['KD_ICD_7'];
						
						$icd_utama = $row['ICD_UTAMA'];
						$icd_1 = $row['ICD_1'];
						$icd_2 = $row['ICD_2'];
						$icd_3 = $row['ICD_3'];
						$icd_4 = $row['ICD_4'];
						$icd_5 = $row['ICD_5'];
						$icd_6 = $row['ICD_6'];
						$icd_7 = $row['ICD_7'];
						
						if($kd_icd_utama == '-'){
							$kd_icd_utama = '';
						}
						
						if($kd_icd_utama && !$kd_icd_1 && !$kd_icd_2 && !$kd_icd_3 && !$kd_icd_4 && !$kd_icd_5 && !$kd_icd_6 && !$kd_icd_7){
						   $diagnosa = '('.$kd_icd_utama.')'.$icd_utama;
						}else if($kd_icd_utama && $kd_icd_1 && !$kd_icd_2 && !$kd_icd_3 && !$kd_icd_4 && !$kd_icd_5 && !$kd_icd_6 && !$kd_icd_7){
						   $diagnosa = '('.$kd_icd_utama.')'.$icd_utama.',<br>('.$kd_icd_1.')'.$icd_1;
						}else if($kd_icd_utama && $kd_icd_1 && $kd_icd_2 && !$kd_icd_3 && !$kd_icd_4 && !$kd_icd_5 && !$kd_icd_6 && !$kd_icd_7){
						   $diagnosa = '('.$kd_icd_utama.')'.$icd_utama.',<br>('.$kd_icd_1.')'.$icd_1.',<br>('.$kd_icd_2.')'.$icd_2;
						}else if($kd_icd_utama && $kd_icd_1 && $kd_icd_2 && $kd_icd_3 && !$kd_icd_4 && !$kd_icd_5 && !$kd_icd_6 && !$kd_icd_7){
						   $diagnosa = '('.$kd_icd_utama.')'.$icd_utama.',<br>('.$kd_icd_1.')'.$icd_1.',<br>('.$kd_icd_2.')'.$icd_2.',<br>('.$kd_icd_3.')'.$icd_3;
						}else if($kd_icd_utama && $kd_icd_1 && $kd_icd_2 && $kd_icd_3 && $kd_icd_4 && !$kd_icd_5 && !$kd_icd_6 && !$kd_icd_7){
						   $diagnosa = '('.$kd_icd_utama.')'.$icd_utama.',<br>('.$kd_icd_1.')'.$icd_1.',<br>('.$kd_icd_2.')'.$icd_2.',<br>('.$kd_icd_3.')'.$icd_3.',<br>('.$kd_icd_4.')'.$icd_4;
						}else if($kd_icd_utama && $kd_icd_1 && $kd_icd_2 && $kd_icd_3 && $kd_icd_4 && $kd_icd_5 && !$kd_icd_6 && !$kd_icd_7){
						   $diagnosa = '('.$kd_icd_utama.')'.$icd_utama.',<br>('.$kd_icd_1.')'.$icd_1.',<br>('.$kd_icd_2.')'.$icd_2.',<br>('.$kd_icd_3.')'.$icd_3.',<br>('.$kd_icd_4.')'.$icd_4.',<br>('.$kd_icd_5.')'.$icd_5;
						}else if($kd_icd_utama && $kd_icd_1 && $kd_icd_2 && $kd_icd_3 && $kd_icd_4 && $kd_icd_5 && $kd_icd_6 && !$kd_icd_7){
						   $diagnosa = '('.$kd_icd_utama.')'.$icd_utama.',<br>('.$kd_icd_1.')'.$icd_1.',<br>('.$kd_icd_2.')'.$icd_2.',<br>('.$kd_icd_3.')'.$icd_3.',<br>('.$kd_icd_4.')'.$icd_4.',<br>('.$kd_icd_5.')'.$icd_5.',<br>('.$kd_icd_6.')'.$icd_6;
						}else if($kd_icd_utama && $kd_icd_1 && $kd_icd_2 && $kd_icd_3 && $kd_icd_4 && $kd_icd_5 && $kd_icd_6 && $kd_icd_7){
						   $diagnosa = '('.$kd_icd_utama.')'.$icd_utama.',<br>('.$kd_icd_1.')'.$icd_1.',<br>('.$kd_icd_2.')'.$icd_2.',<br>('.$kd_icd_3.')'.$icd_3.',<br>('.$kd_icd_4.')'.$icd_4.',<br>('.$kd_icd_5.')'.$icd_5.',<br>('.$kd_icd_6.')'.$icd_6.',<br>('.$kd_icd_7.')'.$icd_7;
						}else{
						   $diagnosa = '-';
						}
							
					
						echo '<tr>';
						echo '<td>'.$i.'</td>';
						echo '<td>'.$row['NAMA'].'</td>';
						echo '<td>'.$row['NORM'].'</td>';
						echo '<td>'.$tgl_masuk.'</td>';
						echo '<td>'.$row['KET_RRAWAT'].'</td>';
						echo '<td>'.$diagnosa.'</td>';
						echo '<td>'.$row['LAMA_DIRAWAT'].'</td>';
						echo '<td>'.$row['PERSENTASE'].'%</td>';
						echo '</tr>';
						$i++;
					}
				}
			?>
			
			</tbody>
		</table>
		</section>
		
	</div>
</div>

<script>
$(document).ready(function() {
    $('#list_pasien').DataTable( {
		scrollY: true,
        scrollX: true,
		
        columnDefs: [ {
            targets: [ 0 ],
			width	: '1%',
			className : 'dt-body-center dt-head-left'
        }, {
            targets: [ 1 ],
			width	: '15%',
			className : 'dt-head-left'
        }, {
            targets: [ 2 ],
			width	: '10%',
			className : 'dt-head-left'
        }, {
            targets: [ 3 ],
			width	: '10%',
			className : 'dt-head-left'
        }, {
            targets: [ 4 ],
			width	: '14%',
			className : 'dt-head-left'
        }, {
            targets: [ 5 ],
			width	: '40%',
			className :'dt-head-left'
        }, {
            targets: [ 6 ],
			width	: '5%',
			className : 'dt-body-right dt-head-right'
        }, {
            targets: [ 7 ],
			width	: '5%',
			className :'dt-body-right dt-head-right'
        }
		]
    } );
	
	$(".panel-left").click(function() {
		$(".sidebar-menu").css('display','block');
		$(".sidebar-menu").css('z-index','999');
	});
} );


</script>

<?php
// include 'footer.php';
?>
















