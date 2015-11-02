<!DOCTYPE html>
<html lang="en">
<!-- Make sure the <html> tag is set to the .full CSS class. Change the background image in the full.css file. -->

<head>

    <link href="<?= base_url('assets/css/bootstrap.min_v2.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    .full {
      background: url('/assets/images/background.jpg') no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }

    body {
        background-color: transparent;
    }

    .panel {
        background-color: rgba(255,255,255,.8);
    }
    </style>

</head>
<body class="full">

<div class="container">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-primary" style="margin-top:100px; border-color: none;">
            <div class="panel-heading">
                <div class="panel-title text-center">Login</div>
            </div>

            <div style="padding-top:30px" class="panel-body">

                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors() ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <form id="loginform" class="form-horizontal" role="form" action="" method="POST">

					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Benutzername">
					</div>

					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="login-password" type="password" class="form-control" name="password" placeholder="Passwort">
					</div>



					<div style="margin-top:10px" class="form-group">
					<!-- Button -->

						<div class="col-sm-12 controls text-center">
							<input type="submit" id="btn-login" class="btn btn-success btn-lg" style="min-width:200px; margin:20px 0px;" value="Senden">
						</div>
					</div>


                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%;">
                                    Du hast noch keinen Account?
                                <a href="<?=site_url('/user/register')?>" onclick="$('#loginbox').hide(); $('#signupbox').show()">
                                    Registriere dich hier
                                </a>
                                </div>
<!--                                <div style="float:left; font-size: 80%; position: relative;"><a href="--><?//=site_url('/user/passwordreset')?><!--">Passwort vergessen?</a></div>-->
                            </div>
                        </div>
                    </form>



                </div>
            </div>
    </div>
</div>


</body>

</html>