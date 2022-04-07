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
<body style="background-color: white;">
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
							<a class="nav-link" href="#"><i class="fa-solid fa-user"></i> '.$userData['username'].'</a>
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
			<a class="btn btn-outline-dark" href="#">EXPLORAR CURSOS</a>
			<?php
				if($_SESSION['user_logged_in'] == true){
					echo '<a class="btn btn-outline-primary me-1" href="#">MIS CURSOS</a>';
					echo '<a class="btn btn-outline-primary" href="#">SEGUIMIENTO</a>';
				}
			?>
			<a class="btn btn-outline-dark" href="#">USUARIOS</a>
		</div>
	</div>
	
	<div class="container vh-100">
		<div class="row justify-content-center pt-5">
			<?php
				if($_SESSION['user_logged_in'] == true){
					echo 
					'
					<div class="col-12 col-sm-8 col-md-6 col-lg-4">
						<div class="card pt-5 border-0 shadow-sm">
							<div class="text-center mb-4">
								<img src="'.$userData['picture'].'" class="rounded-circle container img-fluid"/>
							</div>
							<div class="card-body bg-light">
								<div>
									'.$userInfo.'
								</div>
							</div>
						</div>
					</div>
					';
				} 
			?>
			<?php
				if($_SESSION['user_logged_in'] == true){
					echo '<div class="col-12 col-md-6 col-lg-8">';
				} else {
					echo '<div class="col-auto">';
				}
			?>
				<h5>title 1</h5>
				<p>Vestibulum sodales felis imperdiet neque pulvinar, ut faucibus arcu dapibus. Ut et luctus mauris. Proin ipsum mi, dignissim eu felis nec, faucibus bibendum est. Curabitur hendrerit imperdiet nibh, a suscipit nunc rutrum vel. Quisque aliquam orci ac est pulvinar lacinia. Sed ac eros elementum, mollis nunc nec, blandit sem. Quisque commodo diam pellentesque purus elementum, eget mollis nulla sodales. Ut nec mauris quam. Phasellus eget nulla nec metus feugiat pellentesque volutpat ac nisi. Nam eleifend non tellus quis pretium. In vel ultricies metus, et auctor justo.</p>
				<h5>title 2</h5>
				<p>Nulla gravida quis velit sed tempor. Donec imperdiet lacus et est tincidunt mattis. Pellentesque auctor augue placerat dictum condimentum. Quisque sagittis tellus non ex elementum ornare. Proin interdum mollis interdum. Morbi ut sodales eros. Nam a venenatis risus. Sed a erat ornare, dapibus odio nec, lacinia lorem. Maecenas malesuada orci egestas, sodales tortor interdum, tincidunt elit. Proin vehicula, turpis ut faucibus aliquet, sem est viverra massa, sed rutrum odio nibh sit amet sapien.</p>
				<h5>title 3</h5>
				<p>Donec vitae erat massa. Maecenas volutpat lacus et lectus porta, sit amet porta sapien euismod. Curabitur luctus, neque ac rutrum sagittis, neque nunc mollis odio, ac aliquam nulla purus non turpis. Aenean ornare lectus sed lacus ullamcorper, id scelerisque sem laoreet. Nulla fringilla pulvinar elit, quis molestie turpis ornare et. Duis bibendum vehicula est, ac cursus ex interdum non. Cras viverra, ipsum id volutpat vestibulum, dui odio elementum arcu, vitae consequat dolor nulla non velit.</p>
				<h5>title 4</h5>
				<p>Praesent a tortor non magna consequat dictum. Maecenas eu ipsum eget metus auctor auctor a nec magna. Nam venenatis, diam pulvinar commodo rutrum, augue tellus pellentesque eros, sit amet posuere nisl tellus at quam. Vestibulum aliquet bibendum fringilla. Suspendisse ligula leo, commodo at odio ac, rutrum consectetur purus. Nullam venenatis eros non arcu euismod venenatis. Mauris congue erat eros. Ut eu nibh lectus. In a leo facilisis, fermentum diam quis, efficitur nunc.</p>
				<h5>title 5</h5>
				<p>Aenean mattis ex et viverra convallis. Phasellus sapien lorem, condimentum et nulla ut, vehicula blandit ligula. Curabitur dui tellus, finibus ut malesuada ut, ullamcorper at dolor. Maecenas non luctus odio. Sed eu fringilla turpis. Aliquam tempus magna sed nunc mattis volutpat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus pulvinar faucibus felis, vitae gravida lorem porta at. Maecenas sit amet libero ligula. Pellentesque facilisis mauris sit amet urna ullamcorper accumsan. Nulla et velit vulputate, convallis enim id, ornare turpis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam non tortor ullamcorper, hendrerit nunc vel, ullamcorper mi.</p>
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
			console.log("ready!");
			var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl);
			});
		});
	</script>
</body>
</html>