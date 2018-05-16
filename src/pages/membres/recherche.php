<?php require 'src/recherches.php'; ?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <?php require "../includes/favicon.php";?>
    <?php require '../includes/all-meta.php'; ?>
    <title>Recherches</title>

    <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <link href="/assets/css/ng.css" rel="stylesheet" type="text/css" >
</head>

<body>
<?php require "../includes/menu.php";?>
<?php require "../includes/flash.php";?>
<section class="ng-bloc-principal container">



<div class="jumbotron ng-margin-default">
    <div class="container">
        <div class="media">
            <div class="media-body" >
                <h2 class="media-heading" style="color:#428bca;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Recherches</h2>
                vous pouvez rechercher un article ou un membre...
            </div>
        </div>
    </div>
</div>

<?php require '../includes/verset.php'; ?>

<div class="col-xs-12 col-lg-3 col-md-3 col-sm-3">
    <div class="row">

        <form class="input-group ng-panel-info " method="get" action="">
            <input name="q" type="text" class="form-control" placeholder="Recherche...">
            <span class="input-group-btn" >
                <button  type="submit" value="Go" class="btn btn-primary ng-input" type="button">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </button>
            </span>
        </form>

        <div class="ng-panel panel panel-primary">
            <div class="ng-panel panel-heading"><span class="glyphicon glyphicon-user"></span>  MOI</div>
                <div class="panel-body">
                    <?php echo text(getUserStatut($_SESSION['id'])); ?>
                </div>

                <ul class="list-group">
                    <li class="list-group-item">
                    <span class="glyphicon glyphicon-user"></span>
                    <a>Follower</a>
                    <span class="ng-badge badge"><?php echo KMF(check_follower_num($_SESSION['id']))?></span>
                    </li>

                    <li class="list-group-item">
                    <span class="glyphicon glyphicon-user"></span>
                    <a>Following</a>
                    <span class="ng-badge badge"><?php echo KMF(check_following_num($_SESSION['id']))?></span>
                    </li>

                    <li class="list-group-item">
                    <span class="glyphicon glyphicon-user"></span>
                    <a href="profil.php?id=<?php echo $_SESSION['id']?>">Mon profil</a>
                    </li>

                </ul>
        </div>

        <div class="hidden-xs">
            <?php require "../includes/last-ngpictures.php"; ?>
        </div>
    </div>
</div>


<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
    <div class="row">
        <ul class="nav nav-tabs" id="myTabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#Article" id="Article-tab" role="tab" data-toggle="tab" aria-controls="Article" aria-expanded="true">
                    Article
                </a>
            </li>
            <li role="presentation" class=" ">
                <a href="#Ngpictures" id="Ngpictures-tab" role="tab" data-toggle="tab" aria-controls="Ngpictures" aria-expanded="true">
                    Ngpictures
                </a>
            </li>
        </ul>

        <br>
        <?php if(isset($q)) {?>
        <div class="ng-user-box">
                <div class="media">
                    <div class="media-left media-top">
                        <img class="media-object" src="pages/membres/Avatar/90-90/ng.png" width="90" height="90">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $q ?></h4>
                        recherches-tu un membre ?
                        <hr>
                        <span class="pull-right">
                        <button type="button" class="btn btn-default btn-sm ">
                        <a href="pages/membres/users.php?q=<?php echo $q ?>">
                        <span class="glyphicon glyphicon-search"></span> Rechercher
                        </a>
                        </button>
                    </span>
                    <time><?php echo getTodayDate() ?></time>
                </div>
            </div>
        </div>
        <?php }?>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade active in " role="tabpanel" id="Article" aria-labelle$dby="Article-tab">
    <!-- boucle article -->

        <?php $Na =$article->rowcount();  ?>
        <h2  id="articles">Article<?php echo $t = ($Na > 1) ? "s" : ""?> <span class="ng-badge badge"><?php echo $Na ?></span></h2>

        <?php if($article->rowcount() > 0 ) {?>
        <?php while ($a = $article->fetch()) { ?>

        <div class="ng-user-box">
            <div class="media">
                <div class="media-left media-top">
                    <a href="pages/articlepages/article.php?id=<?php echo $a['id'] ?>">
                    <img class="media-object" src="pages/article/miniature/90-90/<?php echo getPostThumb($a['id']) ?>">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo truncate($a['titre'], 20) ?></h4>
                    <?php echo nl2br(user_mention_verif(truncate($a['contenu']))) ?>
                    <hr>

                    <time><?php echo getRelativeTime($a['date_pub'])?></time>
                    <span class="pull-right">
                        <button type="button" class="btn btn-default btn-xs ng-btn">
                        <a href="pages/articlepages/article.php?id=<?php echo $a['id']; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                        </button>
                        <button type="button" class="btn btn-default btn-xs ng-btn">
                        <a href="pages/membres/profil.php?id=<?php echo $a['posterID']; ?>"><span class="glyphicon glyphicon-user"></span></a>
                        </button>
                    </span>
                </div>
            </div>
        </div>

        <?php }
        }else{?>

        <div class="ng-user-box">
            <div class="media">
                <div class="media-left media-top">
            <img class="media-object" src="pages/blog/miniature/90-90/rien.jpg" width="90" height="90">
                </div>
                <div class="media-body">
            <h4 class="media-heading"><?php if(isset($q)) { echo $q;
           }else{ echo "#Ngpictures ";
} ?></h4>
    <?php if(isset($q)) {echo "Aucun résultat pour cet article";
    }else{ echo "Aucun article pour l'instant";
}?>
    <hr>
    <time><?php echo getTodayDate() ?></time>
</div>
    </div>
</div>

<?php }?>
    <!-- / boucle article -->
    </div>

    <div class="tab-pane fade active in " role="tabpanel" id="Ngpictures" aria-labelle$dby="Ngpictures-tab">
    <!--boucle ngarticles-->

        <?php $Nga =$ngarticle->rowcount();  ?>
        <h2 id="ngarticles">#Article<?php echo $t = ($Nga > 1) ? "s" : ""?> <span class="ng-badge badge"><?php echo $Nga ?></span></h2>

        <?php if($ngarticle->rowcount() > 0 ) {?>
        <?php while ($a1 = $ngarticle->fetch()) { ?>

        <div class="ng-user-box">
            <div class="media">
                <div class="media-left media-top">
                    <a href="pages/blogpages/blog.php?id=<?php echo $a1['id'] ?>">
                        <img class="media-object" src="pages/blog/miniature/90-90/<?php echo getBlogThumb($a1['id']) ?>">
                    </a>
                </div>
            <div class="media-body">
                <h4 class="media-heading"><?php echo truncate($a1['titre'], 20) ?></h4>
                <?php echo truncate(user_mention_verif($a1['contenu']), 200) ?>
                <hr>
                <time><?php echo getRelativeTime($a1['date_pub'])?></time>
                <span class="pull-right">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default btn-xs ng-btn">
                        <a href="ngarticle.php?id=<?php echo $a1['id']; ?>"><span class="glyphicon glyphicon-eye-open"></a>
                        </button>
                    </div>
                </span>
            </div>
        </div>
    </div>

        <?php }
        }else{?>

        <div class="ng-user-box">
            <div class="media">
                <div class="media-left media-top">
            <img class="media-object" src="pages/blog/miniature/90-90/rien.jpg" width="90" height="90">
                </div>
                <div class="media-body">
            <h4 class="media-heading"><?php if(isset($q)) { echo $q;
           }else{ echo "#Ngpictures ";
} ?></h4>
    <?php if(isset($q)) {echo "Aucun résultat pour cet article";
    }else{ echo "Aucun article pour l'instant";
}?>
    <hr>
    <time><?php echo getTodayDate() ?></time>
</div>
    </div>
</div>

<?php }?>
        <!-- boucle ngarticle -->

    </div>
</div>

</div>
</div>

<div class="ng-espace-fantom"></div>
</section>

<?php require "../includes/footer.php"; ?>

<!-- script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="/assets/js/js+/jquery.min.js"><\/script>')</script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/ng-alert-V2.js"></script>
<!-- / script -->

</body>
</html>
