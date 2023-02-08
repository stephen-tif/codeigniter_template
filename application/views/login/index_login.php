<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="<?php echo base_url("resources/src/css/bootstrap.min.css");?>">
    <link rel="stylesheet" href="<?php echo base_url("resources/src/css/lobibox.css");?>">
    <link rel="stylesheet" href="<?php echo base_url("resources/css/login.css");?>">
    <link rel="stylesheet" href="<?php echo base_url("resources/css/formulario.css");?>">
    <link rel="stylesheet" href="<?php echo base_url("resources/src/fontawesome/css/all.min.css");?>">
    <!-- Google fonts -->
  <link href="https://fonts.googleapis.com/css?family=Muli:400,700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 login bg-light text-dark rounded">
                <div class="row">
                    <div class="col-md-12">
                        <p class="title text-center">Inicio de sesión</p>
                        <div class="mt-3" id="formLogin">
                            <div class="form-group">
                                <input name="username" type="text" id="username" class="form-control" autocomplete="off" placeholder="user">
                                <label for="username" class="text-secondary">
                                    <i class="fas fa-user mr-2"></i> Usuario
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="password">
                                <label for="password" class="text-secondary">
                                    <i class="fas fa-lock mr-2"></i> Contraseña
                                </label>
                            </div>
                            
                            <div class="form-group mt-4">
                                <button class="btn btn-primary btn-block btn-login mb-2" id="login" type="button">
                                    Iniciar sesión
                                </button>
                            </div>
                            <div class="form-group">
                                <div class="text-center">
                                    <a class="d-block small" href="#">Olvidaste tu contraseña?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

<script src="<?php echo base_url("resources/src/js/jquery.min.js");?>"></script>

<script src="<?php echo base_url("resources/src/js/bootstrap.min.js");?>"></script>
<script src="<?php echo base_url("resources/src/js/popper.min.js");?>"></script>
<script src="<?php echo base_url("resources/src/js/lobibox.js");?>"></script>
<script src="<?php echo base_url("resources/src/js/messageboxes.js");?>"></script>
<script src="<?php echo base_url("resources/src/js/notifications.js");?>"></script>
<script src="<?php echo base_url("resources/src/js/sweetAlert.min.js");?>"></script>
<script src="<?php echo base_url("resources/js/login.js");?>"></script>
</html>
