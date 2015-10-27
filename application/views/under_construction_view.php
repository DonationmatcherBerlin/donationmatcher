<!DOCTYPE html>
<html lang="en">
<!-- Make sure the <html> tag is set to the .full CSS class. Change the background image in the full.css file. -->

<head>

    <link href="<?= base_url('assets/css/bootstrap.min_v1.css') ?>" rel="stylesheet">
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

    a {
        color: #5cb85c;
    }

    a:hover {
        color: #398439;
    }
    </style>

</head>
<body class="full">

<!-- <div class="container">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-info" style="margin-top:100px; border-color: none;">
            <div class="panel-heading">
                <h3 class="text-center">Diese Seite ist demnächst für Sie verfügbar.</h3>
            </div>

            <div style="padding-top:30px" class="panel-body">
                <p>Freiwillige Programmierer die sich beim <a href="http://refugeehackathon.de">RefugeeHackathon</a> zusammengefunden haben sind gerade dabei diese Seite vollständig zu implementieren.<br> Bitte haben sie noch ein wenig Geduld.</p>
            </div>
    </div>
</div> -->

<div class="container">
    <div class="jumbotron" style="margin-top:150px; background-color: rgba(255,255,255,.7); color:#337ab7;">
        <div class="container text-center">
            <h1>Diese Seite ist demnächst für Sie verfügbar!</h1>
            <hr>
            <p style="color:#337ab7;">Freiwillige Programmierer, die sich beim <a href="http://refugeehackathon.de">RefugeeHackathon</a> zusammengefunden haben, sind gerade dabei diese Seite vollständig zu implementieren. Bitte haben Sie noch ein wenig Geduld.</p>
        </div>
    </div>
</div>
</body>

</html>