<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bedarfs-planner</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/landingpage/landingpage.css">


	<style type="text/css">

	.navbar {
		margin-top: 20px;
	}

	hr {
		margin: 50px 0px;
	}

	.headline {
		margin-bottom: 50px;
		text-align: center;
	}

	.doYouNeed {
		margin-top: 50px;
	}

	.topTentable {
		max-width: 500px;
		text-align: center;
		margin: 0 auto;
	}

	th {
		color: #468847;
    background-color: #dff0d8!important;
    text-align: center;
	}

	footer {
		margin-top: 100px;
		padding: 20px 0px;
		background-color: #e7e7e7;
	}


	</style>
</head>
<body>

<div class="container">

	<!-- Static navbar -->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">#Bedarf-planner <i class="fa fa-twitter"></i></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="#">Bedarfsplan Berlin</a></li>
					<li><a href="#">Login (Helfergruppe)</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
	</nav>

	<div class="row doYouNeed">
		<div class="col-sm-6 text-right">
			<h2>Braucht ihr eigentlich noch <h2>
		</div>
		<div class="col-sm-3 text-left">
			<div class="form-group">
			  <label for="sel1"></label>
			  <select class="form-control" id="sel1">
			  	<option>...?</option>
			    <option>Schuhe</option>
			    <option>Katzen</option>
			    <option>Oder</option>
			    <option>So</option>
			  </select>
			</div>
		</div>
	</div>

	<hr>

	<!-- TABLE -->
	<h2 class="headline">Das brauchen wir am meisten.</h2>
    <table class="table table-bordered table-striped responsive-utilities topTentable">
      <thead>
        <tr>
          <th>
            <i class="fa fa-trophy"></i> Top 10
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Kleidung</td>
        </tr>
        <tr>
          <td>Schuhe</td>
        </tr>
        <tr>
          <td>Katzen</td>
        </tr>
        <tr>
          <td>Katzen</td>
        </tr>
        <tr>
          <td>Katzen</td>
        </tr>
        <tr>
          <td>Katzen</td>
        </tr>
        <tr>
          <td>Katzen</td>
        </tr>
        <tr>
          <td>Katzen</td>
        </tr>
        <tr>
          <td>Katzen</td>
        </tr>
        <tr>
          <td>Katzen</td>
        </tr>
      </tbody>
    </table>



<hr>


<h2 class="headline">Hier der gesamte Bedarfsplan von Berlin</h2>
<div class="table-responsive">
    <table class="table table-bordered table-striped responsive-utilities">
      <thead>
        <tr>
          <th></th>
          <th>
            Extra small devices
            <small>Phones (&lt;768px)</small>
          </th>
          <th>
            Small devices
            <small>Tablets (≥768px)</small>
          </th>
          <th>
            Medium devices
            <small>Desktops (≥992px)</small>
          </th>
          <th>
            Large devices
            <small>Desktops (≥1200px)</small>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row"><code>.visible-xs-*</code></th>
          <td class="is-visible">Visible</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-hidden">Hidden</td>
        </tr>
        <tr>
          <th scope="row"><code>.visible-sm-*</code></th>
          <td class="is-hidden">Hidden</td>
          <td class="is-visible">Visible</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-hidden">Hidden</td>
        </tr>
        <tr>
          <th scope="row"><code>.visible-md-*</code></th>
          <td class="is-hidden">Hidden</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-visible">Visible</td>
          <td class="is-hidden">Hidden</td>
        </tr>
        <tr>
          <th scope="row"><code>.visible-lg-*</code></th>
          <td class="is-hidden">Hidden</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-visible">Visible</td>
        </tr>
      </tbody>
      <tbody>
        <tr>
          <th scope="row"><code>.hidden-xs</code></th>
          <td class="is-hidden">Hidden</td>
          <td class="is-visible">Visible</td>
          <td class="is-visible">Visible</td>
          <td class="is-visible">Visible</td>
        </tr>
        <tr>
          <th scope="row"><code>.hidden-sm</code></th>
          <td class="is-visible">Visible</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-visible">Visible</td>
          <td class="is-visible">Visible</td>
        </tr>
        <tr>
          <th scope="row"><code>.hidden-md</code></th>
          <td class="is-visible">Visible</td>
          <td class="is-visible">Visible</td>
          <td class="is-hidden">Hidden</td>
          <td class="is-visible">Visible</td>
        </tr>
        <tr>
          <th scope="row"><code>.hidden-lg</code></th>
          <td class="is-visible">Visible</td>
          <td class="is-visible">Visible</td>
          <td class="is-visible">Visible</td>
          <td class="is-hidden">Hidden</td>
        </tr>
      </tbody>
    </table>
  </div>



</div> <!-- container -->

<footer class="footer">
  <div class="container">
    <div class="row">
    	<div class="col-sm-1 pull-right">
    		<a href="#">Hilfe</a>
    	</div>
    	<div class="col-sm-1 pull-right">
    		<a href="#">Impressum</a>
    	</div>
    </div>
  </div>
</footer>

<script type="text/javascript" src="/assets/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
</body>
</html>