<?php 
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
	<title>RS Pakubuwono</title>
	<link rel="stylesheet" href="css/bulma.css" type="text/css">
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="css/datatables.min.css" type="text/css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery-1.11.1.js"></script>
	<script src="js/apexcharts.min.js"></script>
	<script src="js/datatables.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {

			// Check for click events on the navbar burger icon
			$(".navbar-burger").click(function() {

				// Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
				$(".navbar-burger").toggleClass("is-active");
				$(".navbar-menu").toggleClass("is-active");
			});

			var dropdown = document.getElementsByClassName("treeview");
			var dropdown_menu = document.getElementsByClassName("treeview-menu");
			var i;

			for (i = 0; i < dropdown.length; i++) {
				var elem = dropdown[i];
				var elem_menu = dropdown_menu[i];
											
				elem.addEventListener('click', function(event) {   	
					for (var j = 0; j < dropdown.length; j++) { 
						dropdown[j].classList.remove("is-active");
						dropdown_menu[j].style.display = "none";  		
						
						this.classList.add("is-active");
						
						if(dropdown[j].classList.contains("is-active")) {
							dropdown_menu[j].style.display = "block";
						}else {
							dropdown_menu[j].style.display = "none";
						}
						
						event.preventDefault();
					}
				}, false);
			}	
		
		$('#logout, #home_index').on('click', function(e) {
			e.preventDefault();
			$.ajax({
				url : 'data.php',
				type: 'POST',
				data: { func : "logout"},
				success: function(data) {
					window.location = 'index.php';
				}
			});
		});
		
		});
	</script>
</head>
<body>
	<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
	  	<div class="navbar-brand">
		    <a class="navbar-item" id="home_index">
		      <img src="" width="50" height="77">
		    </a>

		    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasic">
		      <span aria-hidden="true"></span>
		      <span aria-hidden="true"></span>
		      <span aria-hidden="true"></span>
		    </a>
	  	</div>

		<div id="navbarBasic" class="navbar-menu">
		    <div class="navbar-start">
		      	<a href="" class="navbar-item">
		        	
		      	</a>
		    </div>
	    	<div class="navbar-end">
		      	<div class="navbar-item has-dropdown is-hoverable is-right">
			        <a class="navbar-link">
			         	<figure class="image is-32x32">
						  <img class="is-rounded" src="./image/avatar.png">
						</figure>&nbsp;<?php echo $_SESSION['nama_lengkap']?>
			        </a>
			        <div class="navbar-dropdown">
			          	<a id="logout" class="navbar-item">
			            	Logout
			          	</a>
		        	</div>
		      	</div>
		    </div>
  		</div>
	</nav>	

	

	