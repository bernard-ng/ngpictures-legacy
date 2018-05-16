<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index.php"><b>#Ng</b>pictures</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li ><a href="/index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>

                <li><a href="/actualite"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Actualités</a></li>
                 <li class="active"><a href="/profil?id=<?php echo $_SESSION['id']?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profil</a></li>

                <li><a href="/envoie-photo"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Publications</a></li>

                <li><a href="/galerie"><span class="glyphicon glyphicon-camera" aria-hidden="true"></span> Galerie</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Plus <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/aide"><span class="glyphicon glyphicon-question-sign"></span> Aide</a></li>
                        <li><a href="/about"><span class="glyphicon glyphicon-info-sign"></span> A propos de nous</a></li>
                        <li><a href="/contact"><span class="glyphicon glyphicon-phone"></span> Contactez-nous</a></li>
                        <li><a href="/idees"><span class="glyphicon glyphicon-flash"></span> Donner une idée</a></li>
                        <li><a href="/problemes"><span class="glyphicon glyphicon-exclamation-sign"></span> Signaler un problème</a></li>
                        <li><a href="/privacy"><span class="glyphicon glyphicon-file"></span> C.G.U</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/logout" ><span class="glyphicon glyphicon-off"></span> Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<br>
<br>
<!-- /.nav bar -->
