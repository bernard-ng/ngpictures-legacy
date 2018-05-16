<?php require(SRC."/home.php"); ?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <?php require(SRC."/includes/header.php"); ?>
    <title>Ngpictures</title>

</head>
<body>
<section class="ng-bloc-principal">

<!-- menu -->
    <?php include SRC.'/includes/home/menu.php'; ?>
    <?php include SRC.'/includes/flash.php' ;?>
<!-- /menu  -->

<div class="jumbotron ng-margin-default">
    <div class="media">
        <div class="container">
            <div class="media-body" >
                <h2 class="media-heading" style="color:#428bca;"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Accueil</h2>
                Salut <b><?= getUserPseudo($_SESSION['id']) ?></b>, ici tu rétrouveras les nouvelles photos by Ngpictures, tu rétrouveras aussi les photos que je t'ai prises, fait une recherche...
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- verset -->
<?php include 'includes/verset.php'; ?>
<!-- verset -->

<div class="col-lg-3 col-md-3 col-xs-12 col-sm-3">
    <div class="row">
        <div class="container-fluide">
            <form class="input-group ng-panel-info " method="get" action="membres/recherche.php">
                <input name="q" type="text" class="form-control" placeholder="Rechercher un article...">
                    <span class="input-group-btn" >
                        <button  type="submit" value="Go" class="btn btn-primary ng-input" type="button">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                </span>
            </form>
            <!-- carousel -->
            <?php include 'includes/contact-carousel.php'; ?>
            <!-- carousel -->
        </div>
    </div>
</div>
</div>

<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
    <div class="row">

        <?php

        $verif = $db->query("SELECT * from ngarticle where confirme = 1 order by date_pub desc ");
        $verif = $verif->rowcount();
        if ($verif == 0) {
            ?>
        <div class="ng-panel panel panel-default ng-panel-active">
            <div class="ng-panel panel-heading ng-margin-default">
                <span class="glyphicon glyphicon-alert pull-right"></span>  AUCUNE PUBLICATION POUR L'INSTANT
            </div>
            <ul class="list-group">
                <li class="list-group-item ng-panel-img">
                    <div class="container-fluide">
                        <img src="article/miniature/640-640/rien.jpg" class="img-responsive" >
                    </div>
                </li>
            </ul>
        </div>

    </div>

<!-- affichage d'article -->
    <?php
} else {

    $news = $db->query("SELECT * from ngarticle where confirme = 1 order by date_pub desc ");
    while ($a = $news->fetch()) {
        ?>

    <div class="ng-panel panel panel-default ng-panel-active">
        <div class="ng-panel panel-heading ng-margin-default ng-padding-default">
            <img src="article/miniature/rien.jpg" width="40" height="40" class="img img-circle" />&nbsp;
            <a class="ng-user-name" href="membres/profil.php?id=<?= $a['posterID'] ?>">
                    <?= getUserPseudo($a['posterID']); ?>
            </a>

            <span class="pull-right ng-time">
                    <time><span class="glyphicon glyphicon-time"></span> <?= getRelativeTime($a['date_pub']) ?></time>
            </span>

        </div>
        <ul class="list-group">
            <li class="list-group-item ng-panel-img">
                <div class="container-fluide">
                    <center>
                        <a href="ngarticlepages/blog.php?id=<?= $a['id'] ?>"/>
                            <img src="ngarticle/miniature/640-640/<?= getBlogThumb($a['id']) ?>" class="img-responsive" >
                        </a>
                    </center>
                </div>
            </li>
        </ul>

        <div class="panel-body">
            <h4><strong><?= $a['titre'] ?></strong></h4>
            <p><?= nl2br(truncate(user_mention_verif(htag($a['contenu'])))); ?></p>
        </div>

        <li class="list-group-item ng-margin-default">
            <a class="btn btn-primary btn-xs ng-btn" href="/src/script/nglike.php?t=1&id=<?= $a['id'] ?>" role="button"><span class="glyphicon glyphicon-thumbs-up"></span></a>
            <?= check_nglike_statut($a['id'], $_SESSION['id']) ?> <?= KMF(getBlogInfo($a['id'], "like")) ?>
        </li>
    </div>


    <?php
} ?>
    <?php
} ?>
<!-- / affichage articles-->

<!-- pagination -->
<?php include 'includespages/blog/pagination.php'; ?>
<!-- / pagination -->

</div>
</div>

<div class="col-sm-3 col-md-3 col-xs-12 col-lg-3">
    <div class="row">

    <!-- NAV RAPIDE -->
    <nav>
        <div class="ng-panel panel-primary panel-heading">
            <span class="left">NAVIGATION RAPIDE</span><br>

            <a class="btn btn-primary btn-xs ng-btn" href="/index.php" >
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>

            <a class="btn btn-primary btn-xs ng-btn" href="/actualite" >
                <span class="glyphicon glyphicon-globe" aria-hidden="true"></span></a>

            <a class="btn btn-primary btn-xs ng-btn" href="/profil?id=<?= $_SESSION['id']?>" >
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>

            <a class="btn btn-primary btn-xs ng-btn" href="/envoie-photo" >
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

            <a class="btn btn-primary btn-xs ng-btn" href="/galerie?id=<?= $_SESSION['id'] ?>">
                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span></a>
        </div>
    </nav>
    <!-- /NAV RAPIDE -->

    <?php include 'includes/home/livre_dor.php'; ?>
    </div>
</div>
</div>

<div class="ng-espace-fantom"></div>
</section>

<?php include 'includes/footer.php'; ?>

<!--importation des script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="assets/js/js+/jquery.min.js"><\/script>')
    </script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/ng-alert-V2.js"></script>
<!-- /importation des script -->

</body>
</html>
