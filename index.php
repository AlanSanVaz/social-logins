<?php
	require_once 'config.php';
	require_once 'check-callback.php';
	
	if($_SESSION['user_logged_in'] == true){
		require_once 'get-user-data.php';
	}
	// imprimir datos de usuario
	if(!empty($_SESSION['userData'])){
		$userInfo = 
			'
				<p><b>Usuario:</b> '.$_SESSION['userData']['username'].'<p>
				<p><b>Nombre(s):</b> '.$_SESSION['userData']['names'].'<p>
				<p><b>Apellido(s):</b> '.['last_names'].'<p>
				<p><b>Email:</b> '.$_SESSION['userData']['email'].'</p>
				<p><b>Sesión con:</b> '.$_SESSION['userData']['oauth_provider'].'</p>
			';
		//echo $userInfo;
	}
	//var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Conoce Tu Pasión</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body style="background-color:#111b51;">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="assets/images/logo2.png">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<?php 
					if($_SESSION['user_logged_in'] == true){
						echo 
						'
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fa-solid fa-user"></i> '.$_SESSION['userData']['username'].'</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="close.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Salir</a>
						</li>
						';
					} else {
						echo 
						'
						<li class="nav-item">
							<a class="nav-link" href="#">Registrarse</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="modal" href="#exampleModal" role="button">Entrar</a>
						</li>
						';
						
					}
				?>
				</ul>
			</div>
		</div>
	</nav>
	<div class="d-lg-block line-header "></div>
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Entrar</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="l-form">
						<form action="" class="form">
							<!--<h1 class="form__title">Sign In</h1>-->
							<div class="form__div">
								<input type="text" class="form__input" placeholder=" ">
								<label for="" class="form__label">Email</label>
							</div>
							<div class="form__div">
								<input type="password" class="form__input" placeholder=" ">
								<label for="" class="form__label">Contraseña</label>
							</div>
							<input type="submit" class="form__button" value="Iniciar Sesión">
						</form>
					</div>
					<hr>
					<div class="text-center">
						<p class="lead">Iniciar sesión con red social</p>
					</div>
					<div class="row d-flex justify-content-evenly">
						<div class="col-auto">
							<a id="loginFacebook" class="btn" href="<?php echo $urlBtnLoginFacebook; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><span style="color:#3b5998;"><i class="fa-brands fa-facebook-square fa-5x"></i></span></a>
						</div>
						<div class="col-auto">
							<a id="loginGithub" class="btn" href="<?php echo $urlBtnLoginGithub; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Github"><i class="fa-brands fa-github-square fa-5x"></i></a>
						</div>
						<div class="col-auto">
							<a id="loginGoogle" class="btn" href="<?php echo $urlBtnLoginGoogle; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Google"><img src="assets/images/logoGoogle.png"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="d-flex flex-row-reverse pb-2">
		<div class="col-auto pt-2 me-2">
			<a class="btn btn-outline-light" href="#">EXPLORAR CURSOS</a>
			<?php
				if($_SESSION['user_logged_in'] == true){
					echo '<a class="btn btn-outline-primary me-1" href="#">MIS CURSOS</a>';
					echo '<a class="btn btn-outline-primary" href="#">SEGUIMIENTO</a>';
				}
			?>
			<a class="btn btn-outline-light" href="#">USUARIOS</a>
		</div>
	</div>
	
	<div class="container vh-100">
		<div class="row justify-content-center pt-5">
			<div class="col-12 col-sm-8 col-md-6 col-lg-4">
				<div class="card pt-5 border-0 shadow-sm">
					<div class="text-center mb-4">
						<a href="#" class="text-dark text-decoration-none">
							<img src="assets/images/conocetupasionLogo.png" class="img-responsive center-block" style="max-width:40%">
						</a>
					</div>
					<div class="card-body bg-light">
						<div>
						<?php //var_dump($_SESSION['sn_type']); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/brands.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/solid.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/regular.min.js"></script>
	<script>
		$('#loginFacebook').on("click", function(event){
			event.preventDefault();
			let link = $(this).attr('href');
			redirect({'sn_type':'facebook'}, link);
			return;
		});
		
		$('#loginGithub').on("click", function(event){
			event.preventDefault();
			let link = $(this).attr('href');
			redirect({'sn_type':'github'}, link);
			return;
		});
		
		$('#loginGoogle').on("click", function(event){
			event.preventDefault();
			let link = $(this).attr('href');
			redirect({'sn_type':'google'}, link);
		});
		
		function redirect(data, linkRedirect){
			$.ajax({
				type: 'POST',
				url: 'update-login.php',
				data: data,
				dataType: "json",
				async: false,
				success: function(response){
					window.location.href = linkRedirect;
					/*if(response.status == 'ok'){
						setTimeout(function () {
						}, 5000);
					}*/
				}
			});
			return;
		}
	
		$(function() {
			//console.log("ready!");
			var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl);
			});
		});
	</script>
</body>
</html>