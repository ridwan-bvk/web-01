
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
	<title>RS Pakubuwono</title>
	<link rel="stylesheet" href="css/login.css" type="text/css">
	<link rel="stylesheet" href="css/font-awesome.min.css.css" type="text/css">
	<script src="js/jquery-1.11.1.js"></script>
</head>	
	<body>
		<div id="container">
			<div id="content_kiri">
				
			</div>
			<div id="content_kanan">
				<div class="kanan_atas">
				</div>
				<div class="kanan_tengah">
					<div class="bg_form">
						<div class="title_login">USER LOGIN</div>
						<div class="show_error"></div>
						<br>
						<form method="post" id="form_login" >
							<div>
								<div>
									<input type="text" id="username"  placeholder="Username">
								</div>
							</div>
							<div>
								<div>
									<input type="password" id="password"  placeholder="Password">
								</div>
							</div>
							<div >
								<input type="submit" value="LOGIN"/>
							</div>
						</form>
					</div>
				</div>
				<div class="kanan_bawah">
				</div>
			</div>
		</div>
        <script>
        	$(function(){
			  var body = $('#content_kiri');
			  var backgrounds = ['url(image/Slide-1.png)', 'url(image/Slide-2.png)', 'url(image/Slide-3.png)'];
			  var current = 0;

			function nextBackground() {
			  body.css(
			   'background',
				backgrounds[current = ++current % backgrounds.length]
				);
			
				setTimeout(nextBackground, 5000);
			}
			
			setTimeout(nextBackground, 5000);
			   body.css('background', backgrounds[0]);
			});

			$('#form_login').on('submit', function(e) {
				e.preventDefault();
				var namauser = $('#username').val();
				var password = $('#password').val();
				$.ajax({
					url : 'data.php',
					type: 'POST',
					data: { namauser : namauser, password : password, func : "login"},
					success: function(data) {
						
						if(data !== 'ok') {
							$('.show_error').empty();
							$('.show_error').append('<div class="alert_danger">'+ data +'</div>');
							$('.show_error').fadeIn();
							setTimeout(function() {
								$('.show_error').fadeOut();
							}, 2000);
						} else {
							window.location = 'list.php';
						}
					}
				});
			});
		</script>
	</body>
</html>		