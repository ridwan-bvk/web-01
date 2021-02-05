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
		<div>
			<a href="#" class="panel-left">Menu</a>
		</div>
	</div>
	
	<section class="hero is-bold">
		<div class="hero-body page-title">
		    <div class="container">
		      	<h1 class="title">
		        	GRAFIK DATA PASIEN
		      	</h1>
		    </div>
		</div>
	</section>
	<section class="section is-small" >
		<div class="columns">
		  <div class="column is-7">
				<div class="columns is-mobile">
				  <div class="column"></div>
				  <div class="column"><div class="label_safe"><span style="padding-left:30px;">Aman</span></div></div>
				  <div class="column"><div class="label_warning"><span style="padding-left:30px;">Waspada</span></div></div>
				  <div class="column"><div class="label_danger"><span style="padding-left:30px;">Perlu&nbsp;perhatian</span></div></div>
				</div>
		  </div>
		</div>
		
		<?php
				$kd_group 		= substr($_SESSION['kd_grup'], 0, 3);
				$userid 		= $_SESSION['userid'];
				//$tgl_login 		= $_SESSION['tgl_login'];
				$tgl_login 		= '2019-10-21 11:02:20.000';
				$add = '' ;
			
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
					
					$add = "AND PERSENTASE > 50 
							AND KD_RRAWAT = '$kd_rrawat'" ;
				}else if($kd_group == 'CSM'){
					$add = 'AND PERSENTASE > 80' ;
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
						$kd_icd_utama 	= $row['KD_ICD_UTAMA'];
						$data["y"] 		= $row['NAMA'];
						$data["x"]		= $row['PERSENTASE'];
						$i++;
						$labelnama[] 		= $data["y"];
						$labelpersentase[]	= $data["x"];
					}
				}
				
				$nama 			= json_encode($labelnama);
				$persentase 	= json_encode($labelpersentase);
				//var_dump($sql);
		?>
		
		<div id="chart"></div>
	</section>
	
</div>
</div>
<script>

var nama 		= <?php echo $nama;?>;
var persentase 	= <?php echo $persentase;?>;
var length_data = nama.length;

if(length_data <= 5){
	height = 300;
}else if (length_data > 5 && length_data <= 10){
	height = 400;
}else if(length_data > 10 ){
	height = 600;
}

var options = {	
		chart: {
			height: height,
			type: 'bar',
		},
		plotOptions: {
			bar: {
				horizontal: true,
				dataLabels: {
				  position: 'top',
				},
			}
		},
		dataLabels: {
			enabled: true,
			formatter: function(val) {
					return val + "%" 
				},
			style: {
				colors: ['#000']
			},
			offsetX:30
		},
		colors: [function({ value, seriesIndex, w }) {
			if(value <= 50) {
				return '#00e396'
			} else if (value >= 51 && value <= 80) {
				return '#feb019'
			} else {
				return '#ff4560'
			}
		}],
		stroke: {
			width: 1,
			colors: ['#fff']
		},
		series: [{
			name : '',
			// data: [85, 17, 66.55, 9, 95, 70, 20, 5, 5, 5]
			// data: [85, 17, 66, 9, 95, 70, 20, 5, 5, 5]
			data:  persentase 
		}],
		title: {
			text: ''
		},
		xaxis: {
			//categories: ['JEPA','FLORIDA PANJAITAN','TUTI','AENG','SUKATMA ( TN )','ASEP HUDIANA','MUHAMAD RAFI','JASI','NURLELA  NY','NURUSSYIPAH BY NY' ],
			categories: nama ,
			labels: {
				formatter: function(val) {
					return val 
				}
			},
			lines: {
				show: false,
			}
		},
		yaxis: {
			title: {
				text: undefined
			},
			lines: {
				show: false,
			}
		},
		tooltip: {
			y: {
				formatter: function(val) {
					return val + "%"
				},
			}
		},
		fill: {
			opacity: 1
		},
		
		legend: {
			position: 'top',
			horizontalAlign: 'left',
			offsetX: 40
		},
		
	}

   var chart = new ApexCharts(
		document.querySelector("#chart"),
		options
	);
	
	chart.render();
	
	$(document).ready(function() {
		$(".panel-left").click(function() {
			$(".sidebar-menu").css('display','block');
			$(".sidebar-menu").css('z-index','999');
		});
	});
	
</script>

<?php
// include 'footer.php';
?>