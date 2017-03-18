<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>OtherCars</title>
    <link rel="stylesheet" href="web/css/bootstrap.min.css">
    <link rel="stylesheet" href="web/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="web/css/style.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <section class="col-md-12 text-center">
            <h3><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></h3>
            <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="loginmodal-container">
                        <h1>Login to OtherCars</h1><br>
                        <form action="config/login.php" method="POST">
                            <input type="text" name="login" placeholder="Username">
                            <input type="password" name="p_word" placeholder="Password">
                            <input type="submit" name="login_button" class="login loginmodal-submit" value="Login">
                        </form>
                        <div class="login-help">
                            <a href="#">Forgot Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script src="web/lib/jquery.min.js"></script>
<script src="web/lib/bootstrap.min.js"></script>
</body>
</html>