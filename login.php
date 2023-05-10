<!DOCTYPE html>
<html lang="en">
<?php 
session_start(); 
include('./db_connect.php');
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  

  <title>Inicio | Sistema de encuestas en línea</title>
 	

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
	.divider:after,
	.divider:before {
		content: "";
		flex: 1;
		height: 1px;
		background: #eee;
	}
	.h-custom {
		height: calc(100% - 73px);
	}
	@media (max-width: 450px) {
		.h-custom {
		height: 100%;
	}
	}

</style>

<body>
	<main id="main" >
	<section class="vh-100">
	<div class="container-fluid h-custom">
		<div class="row d-flex justify-content-center align-items-center h-100">
		<div class="col-md-9 col-lg-6 col-xl-5">
			<img src="./encuesta5.gif" class="img-fluid" alt="Sample image">
		</div>
		<div id="login-center" class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
			<form id="login-form">
			<div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
				<p class="lead fw-normal mb-0 me-3"> Iniciar Sesion</p>
			</div>

			<div class="divider d-flex align-items-center my-4">
				<p class="text-center fw-bold mx-3 mb-0">Ir</p>
			</div>

			<!-- Email input -->
			<div class="form-outline mb-4">
				<input type="email" id="email" name="email" class="form-control form-control-lg"
				placeholder="Ingrese su Correo Electronico" />
				<label class="form-label" for="email">Correo Electronico</label>
			</div>

			<!-- Password input -->
			<div class="form-outline mb-3">
				<input type="password" id="password" name="password" class="form-control form-control-lg"
				placeholder="Ingrese su Contraseña" />
				<label class="form-label" for="password">Contraseña</label>
			</div>

			<div class="d-flex justify-content-between align-items-center">
			
			
			</div>

			<div class="text-center text-lg-start mt-4 pt-2">
				<button class="btn btn-primary btn-lg"
				style="padding-left: 2.5rem; padding-right: 2.5rem;">Entrar</button>
				
			</div>

			</form>
		</div>
		</div>
	</div>
	<div
		class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
		<!-- Copyright -->
		<div class="text-white mb-3 mb-md-0">
		Copyright © 2023. Grupo Administracion de Tecnologias
		</div>
		<!-- Copyright -->

		
	</div>
	</section>
	</main>

	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


	</body>
	<script>
		$('#login-form').submit(function(e){
			e.preventDefault()
			$('#login-form button[type="button"]').attr('disabled',true).html('Iniciando sesión...');
			if($(this).find('.alert-danger').length > 0 )
				$(this).find('.alert-danger').remove();
			$.ajax({
				url:'ajax.php?action=login',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
			$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

				},
				success:function(resp){
					if(resp == 1){
						location.href ='index.php?page=home';
					}else{
						$('#login-form').prepend('<div class="alert alert-danger">Nombre de usuario o contraseña incorrecta.</div>')
						$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
					}
				}
			})
		})
		$('.number').on('input',function(){
			var val = $(this).val()
			val = val.replace(/[^0-9 \,]/, '');
			$(this).val(val)
    })
</script>	
</html>