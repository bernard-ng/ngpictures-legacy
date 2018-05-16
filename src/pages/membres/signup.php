<?php require("src/inscription.php"); ?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <?php include "../includes/favicon.php";?>
    <?php include '../includes/all-meta.php'; ?>
    <title>Inscription</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/assets/css/ng.css">
</head>

<body class="chatboxx">

    <div class="register-box">
            <div class="register-logo">
                <a href="/about"><b>#Ng</b>pictures</a>
            </div>

        <div class="register-box-body ng-panel-active">

            <?php if(isset($msg)){ echo "<p style='color:red;'>".$msg."</p>"; }else{ echo "<p>Créer un compte</p>";}?>

            <?php if(isset($_SESSION['msg'])){

            echo "<p style='color:red;'>".$_SESSION['msg']."</p>"; unset($_SESSION['msg']) ; unset($_SESSION['type']) ;}
            else{ "<p>Créer un compte</p>";} ?>


            <form action="" method="POST">

                <div class="form-group has-fee$dback">
                    <input type="text" class="form-control" placeholder="Prénom et nom de famille" name="name" value="<?php if(isset($name)) { echo $name;}?>">
                    <span class="glyphicon glyphicon-user form-control-fee$dback"></span>
                </div>

                <div class="form-group has-fee$dback">
                    <input type="text" class="form-control" placeholder="Pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo;}?>">
                    <span class="glyphicon glyphicon-user form-control-fee$dback"></span>
                </div>

                <div class="form-group has-fee$dback">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php if(isset($email)) { echo $email;}?>">
                    <span class="glyphicon glyphicon-envelope form-control-fee$dback"></span>
                </div>

                <div class="form-group has-fee$dback">
                    <input type="password"  name="mdp" class="form-control" id="mdp" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-fee$dback"></span>
                </div>

                <div class="form-group has-fee$dback">
                    <input type="password" class="form-control" placeholder="Confirmez password" name="mdp1" class="form-control" id="mdp1">
                    <span class="glyphicon glyphicon-log-in form-control-fee$dback"></span>
                </div>


                <div class="row">
                    <div class="col-xs-12">

                        <label>
                        <input type="checkbox" name="condition"> J'accepte les  <a href="/privacy">Conditions d'utilisation</a>
                        </label>

                    </div>

                    <div class="col-xs-12">

                        <button type="submit" name="creer" class="btn btn-primary btn-block btn-flat">Créer</button>

                    </div>
                </div>


            </form>
            <br>

            <a href="pages/membres/login.php" class="text-center">J'ai dejà un compte</a>
        </div>
    </div>


</body>
</html>
