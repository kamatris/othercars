<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>OtherCars</title>
    <link rel="stylesheet" href="../web/css/bootstrap.min.css">
    <link rel="stylesheet" href="../web/css/font-awesome.css">
    <link rel="stylesheet" href="../web/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../web/css/style.css">
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index_dash.php">OtherCars</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="vehicule.php">Vehicule</a></li>
                <li><a href="reservation.php">Reservation</a></li>
                <li><a href="client.php">Client</a></li>
                <li><a href="tarif.php">Tarif</a></li>
                <li><a href="direction.php">Direction</a></li>
                <li><a href="utilisateur.php">Utilisateur</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span> Profil
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="glyphicon glyphicon-cog"></span>Setting</a></li>
                        <li><a href="../config/logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>