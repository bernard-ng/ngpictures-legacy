<?php require(SRC."/connexion.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <?php require(SRC."/includes/header.php"); ?>
</head>
<body class="chatboxx">

<div class="register-box ">
        <div class="register-logo">
            <a href="/about"><b>#Ng</b>pictures</a>
        </div>

    <div class="register-box-body ng-panel-active">

        <?php if(isset($msg)){ echo "<p style='color:red;'>".$msg."</p>"; }else{ echo "<p>Connectez-vous pour démarrer votre Session</p>";}?>

        <?php if(isset($_SESSION['msg']))
        { echo "<p style='color:red;'>".$_SESSION['msg']."</p>"; unset($_SESSION['msg']) ; unset($_SESSION['type']) ;
        }else{"<p>Connectez-vous pour démarrer votre Session</p>";}

        ?>


        <form action="" method="POST">
            <div class="form-group has-fee$dback">
                <input type="text" class="form-control" id="pseudoconnect" name="pseudoconnect" placeholder="ngandu">
                <span class="glyphicon glyphicon-user form-control-fee$dback"></span>
            </div>

            <div class="form-group has-fee$dback">
                <input type="password" class="form-control" placeholder="Password" name="mdpconnect" id="mdpconnect">
                <span class="glyphicon glyphicon-lock form-control-fee$dback"></span>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <label>
                        <input type="checkbox" name="stay_online" > Rester connecter
                    </label>
                </div>

                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="connexion">Connexion</button>
                </div>

            </div>
        </form>
        <br>

            <a href="signup.php" class="text-center">Créer un compte</a>
    </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="/assets/js/js+/jquery.min.js"><\/script>')
    </script>
    <script src="/assets/js/bootstrap.min.js"></script>




</body>
</html>
