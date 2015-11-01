<!DOCTYPE html>
<html lang="en">
<!-- Make sure the <html> tag is set to the .full CSS class. Change the background image in the full.css file. -->

<head>

    <link href="<?= base_url('assets/css/bootstrap.min_v2.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/welcome/welcom_v5.css') ?>" rel="stylesheet">

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
    </style>

</head>

<body class="full">

<div class="container">
    <div class="jumbotron" style="margin-top:150px; background-color: rgba(255,255,255,.7); color:#337ab7;">
        <div class="container text-center">
            <h1 class="text-center" style="color:#337ab7;">Bedarfsplaner.org</h1>
            <h2 style="color:#337ab7; text-align:center;">Alle Bedarfslisten der Hilfsgruppen auf einen Blick</h2>
            <hr>
                        <div class="row">
                <div class="col-sm-6">
                    <a href="<?=site_url('/landingpage')?>" class="btn btn-primary btn-lg" style="width:100%; padding:30px 0px;"><p style="margin:0;">Ich möchte meine Sachen spenden</p></a>
                    <small style="color:#337ab7; margin-left:5%;">Wo werden meine Sachen benötigt?</small>
                </div>
                <div class="col-sm-6">
                    <a href="<?=site_url('/stocklist')?>" class="btn btn-success btn-lg" style="min-width:100%; padding:30px 0px;" ><p style="margin:0;">Ich bin Teil einer Hilfsgruppe</p></a>
                    <small style="color:#337ab7; margin-left:5%;">Bedarfslisten erstellen und mit anderen Hilfsgruppen vernetzen.</small>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- <nav class="navbar navbar-fixed-bottom" role="navigation">
        <div class="container">
            <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" style="color:white;">Hilfe</a>
                    </li>
                    <li>
                        <a href="#" style="color:white;">Impressum</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->

    <!-- js -->
    <script src="<?= base_url('assets/js/jquery-2.1.4.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>

</body>

</html>
