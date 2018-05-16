<?php require "src/users.php"; ?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width" />
        <?php require "../includes/favicon.php";?>
        <?php require '../includes/all-meta.php'; ?>
        <title>Membres</title>

        <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
        <link href="/assets/css/ng.css" rel="stylesheet" type="text/css" >

    </head>
<body>
<?php require "../includes/profil/menu.php"; ?>
<?php require "../includes/flash.php";?>
<div class="jumbotron ng-margin-default">
    <div class="media">
        <div class="container">
            <div class="media-body" >
                <h2 class="media-heading" style="color:#428bca;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Les membres</h2>
                Retrouve tout les nouveaux membres, vois tes followers et tes following...
            </div>
        </div>
    </div>
    <br>
</div>
<section class="ng-bloc-principal container">
<?php require '../includes/verset.php'; ?>


<div class="col-xs-12 col-lg-3 col-md-3 col-sm-3">
    <div class="row">

        <form class="input-group ng-panel-info" method="GET" action="">
            <input name="q" type="text" class="form-control" placeholder="Rechercher une personne... ">
            <span class="input-group-btn" >
            <button  type="submit" value="Go" class="btn btn-primary ng-input" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </span>
        </form>


        <div class="ng-panel panel panel-primary">
            <div class="ng-panel panel-heading">MOI</div>
            <div class="panel-body">
                <?php echo nl2br(user_mention_verif(truncate(getUserStatut($_SESSION['id'])))); ?>
            </div>

            <ul class="list-group">
            <li class="list-group-item">
                <span class="glyphicon glyphicon-user"></span>
                Follower
                <span class="ng-badge badge"><?php echo KMF(check_follower_num($_SESSION['id']))?></span>
                </li>
                <li class="list-group-item">
                <span class="glyphicon glyphicon-user"></span>
                Following
                <span class="ng-badge badge"><?php echo KMF(check_following_num($_SESSION['id']))?></span>
                </li>
                <li class="list-group-item">
                <span class="glyphicon glyphicon-user"></span>
                <a href="pages/membres/profil.php?id=<?php echo $_SESSION['id']?>">Mon profil</a>
            </li>
            </ul>
        </div>

    </div>
</div>


<div class="col-xs-12 col-lg-9 col-md-9 col-sm-9">
<div class="row">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#membres" id="membres-tab" role="tab" data-toggle="tab" aria-controls="membres" aria-expanded="true">
                Membres
            </a>
        </li>

        <li role="presentation" class="">
            <a  href="#followers" role="tab" id="followers-tab" data-toggle="tab" aria-controls="followers" aria-expanded="false">
                Followers
            </a>
        </li>
        <li role="presentation" class="">
            <a  href="#following" role="tab" id="following-tab" data-toggle="tab" aria-controls="following" aria-expanded="false">
                Following
            </a>
        </li>
    </ul>

<!-- Tab panes -->
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade active in " role="tabpanel" id="membres" aria-labelle$dby="membres-tab">

    <?php $Nm = $users->rowcount(); ?>
    <h2>Résultat<?php echo $t = ($Nm > 1) ? "s" : "" ;?> <span class="ng-badge badge"><?php echo KMF($Nm) ?></span></h2>

    <?php if($users->rowcount() > 0 ) {?>
        <?php while ($m = $users->fetch()){?>

            <div class="col-xs-12 col-md-12 col-sm-12">
                <div class="row">
                    <div class="ng-user-box">
                        <img src="pages/membres/Avatar/40-40/<?php echo getUserProfil($m['id'])?>" width="40px" height="40px" class="img img-circle"/>
                        <?php echo getUserPseudo($m['id']) ?>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class=" glyphicon glyphicon-option-vertical pull-right"></span></a>
                            <span class="pull-right"><?php echo Check_user_online($m['id'])?></span>

                            <ul class="dropdown-menu panel-heading">
                                <li><a>Follower<?php echo $t=(Check_follower_num($m['id']) > 1) ? "s" : ""?>:
                                <?php echo KMF(Check_follower_num($m['id']))?></a></li>

                                <li role="separator" class="divider"></li>

                                <li><a>Following: <?php echo KMF(Check_following_num($m['id']))?></a></li>
                                <li role="separator" class="divider"></li>

                                    <?php $poste = getPicturesInfo($m['id'], "nombre") + getArticleInfo($m['id'], "nombre") ?>
                                <li><a>Poste<?php echo $test = ($poste > 1) ? "s" : "" ;?>: <?php echo KMF($poste); ?> </a></li>

                            </ul>
                        </li>

                        <?php if(empty($m['statut'])) {?><h5>Hey tout le monde, suis sur #Ngpictures...</h5><?php 
                        }?>
                        <h5><?php echo text($m['statut'])?></h5>


                        <?php if($_SESSION['id'] != $m['id']) {?>

                        <?php $photo= $db->prepare("SELECT * from galerie where userID = ? order by date_pub desc limit 0,3");
                        $photo->execute(array($m['id']));?>


                        <?php while($p = $photo->fetch()){ ?>

                            <?php
                            // les photo doit fit avec la taille d l'ecran c prkoi y a toute ces class la...
                            if($photo ->rowcount() >= 3) { $class ="col-lg-4 col-sm-4 col-md-4 col-xs-4 pull-left";
                            }elseif($photo ->rowcount() == 2) {  $class="col-lg-6 col-sm-6 col-md-6 col-xs-6 pull-left";
                            }else{ $class="hidden-lg hidden-xs hidden-sm hidden-md";
                            }
                            ?>

                            <div class="<?php echo $class ?>">
                                <div class="row">
                                    <div class="ng-img-default">
                                        <a href="pages/galerie/photo.php?type=user&id=<?php echo $p['id']; ?>">
                                            <img class="img img-responsive" src="pages/galerie/images/640-640/<?php echo $p['nom'] ?>">
                                        </a>
                                    </div>
                                </div>
                            </div>

                        <?php } // fin while ?>

                        <div class="btn-group btn-sm " role="group">
                            <button type="button" class="btn btn-default btn-sm">
                                <a href="pages/membres/profil.php?id=<?php echo $m['id']; ?>">Profil</a>
                            </button>

                            <button type="button" class="btn btn-default btn-sm">
                                <a href="/src/script/following.php?followingID=<?php echo $m['id'] ?>">
                                <?php echo check_following_statut($_SESSION['id'], $m['id']) ?></a>
                            </button>

                            <button type="button" class="btn btn-default btn-sm">
                                <a href="/galerie?id=<?php echo $m['id']; ?>"">Galerie</a>
                            </button>
                        </div>

                        <?php } // fin du if ?>
                    </div>
                </div>
            </div>

        <?php } // fin if rowcount... ?>
    <?php }else{?>

        <div class="ng-user-box">
            <div class="media">
                <div class="media-left media-top">
                    <img class="media-object" src="pages/membres/Avatar/90-90/ng.png" width="90" height="90">
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?php if(isset($q)) { echo $q;
                   }else{ echo "#Ngpictures ";
} ?></h4>
                    <?php if(isset($q)) {echo "Aucun résultat pour ce membre";
                    }else{ echo "Aucun membre";
}?>
                    <hr>
                    <time><?php echo getTodayDate() ?></time>
                </div>
            </div>
        </div>

    <?php }?>

    </div><!-- pages/membres -->

    <div class="tab-pane fade " role="tabpanel" id="followers" aria-labelle$dby="followers-tab">
    <h2>Follower<?php echo $t = ($fn > 1) ? "s" : "" ;?> <span class="ng-badge badge"><?php echo KMF($fn) ?></span></h2>
    <?php if($follower->rowcount() > 0 ) {?>

        <?php while ($f = $follower->fetch()){?>

            <div class="col-xs-12 col-md-12 col-sm-12">
                <div class="row">
                    <div class="ng-user-box">
                        <img src="pages/membres/Avatar/40-40/<?php echo getUserProfil($f['followerID'])?>" width="40px" height="40px" class="img img-circle"/>
                        <?php echo getUserPseudo($f['followerID']) ?>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class=" glyphicon glyphicon-option-vertical pull-right"></span></a>

                            <span class="pull-right"><?php echo Check_user_online($f['followerID'])?></span>

                            <ul class="dropdown-menu panel-heading">
                                <li><a>Follower<?php echo $t=(Check_follower_num($f['followerID']) > 1) ? "s" : ""?>: <?php echo KMF(Check_follower_num($f['followerID']))?></a></li>

                                <li role="separator" class="divider"></li>
                                <li><a>Following: <?php echo KMF(Check_following_num($f['followerID']))?></a></li>
                                <li role="separator" class="divider"></li>


                                <?php $poste = getPicturesInfo($f['followerID'], "nombre") + getArticleInfo($f['followerID'], "nombre") ?>
                                <li><a>Poste<?php echo $test = ($poste > 1) ? "s" : "" ;?>: <?php echo KMF($poste); ?> </a></li>
                            </ul>
                        </li>

                        <?php if(getUserStatut($f['followerID']) == " ") {?><h5>Hey tout le monde, suis sur #Ngpictures...</h5><?php 
                        }?>

                        <h5><?php echo nl2br(user_mention_verif(getUserStatut($f['followerID']))) ?></h5>

                        <?php if($_SESSION['id'] != $f['followerID']) {?>

                        <?php $photo= $db->prepare("SELECT * from galerie where userID = ? order by date_pub desc limit 0,3");
                        $photo->execute(array($f['followerID']));?>

                        <?php while($p = $photo->fetch()){ ?>

                        <?php
                            // les photo doit fit avec la taille d l'ecran c prkoi y a toute ces class la...
                        if($photo ->rowcount() >= 3) { $class ="col-lg-4 col-sm-4 col-md-4 col-xs-4 pull-left";
                        }elseif($photo ->rowcount() == 2) {  $class="col-lg-6 col-sm-6 col-md-6 col-xs-6 pull-left";
                        }else{ $class="hidden-lg hidden-xs hidden-sm hidden-md";
                        }
                        ?>

                        <div class="<?php echo $class ?>">
                            <div class="row">
                                <div class="ng-img-default">
                                    <a href="pages/galerie/photo.php?type=user&id=<?php echo $p['id']; ?>">
                                        <img class="img img-responsive" src="pages/galerie/images/640-640/<?php echo $p['nom'] ?>" alt="...">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php } // fin while ?>

                        <div class="btn-group btn-sm " role="group">
                            <button type="button" class="btn btn-default btn-sm">
                                <a href="profil.php?id=<?php echo $f['followerID']; ?>">Profil</a>
                            </button>

                            <button type="button" class="btn btn-default btn-sm">
                                <a href="/src/script/following.php?followingID=<?php echo $f['followerID'] ?>">
                                <?php echo check_following_statut($_SESSION['id'], $f['followerID']) ?></a>
                            </button>

                            <button type="button" class="btn btn-default btn-sm">
                                <a href="/galerie?id=<?php echo $f['followerID']; ?>">Galerie</a>
                            </button>

                        </div>

                        <?php } // fin if...?>
                    </div>
                </div>
            </div>

        <?php }?>
    <?php }else{?>

        <div class="ng-user-box">
        <div class="media">
            <div class="media-left media-top">
                <img class="media-object" src="pages/membres/Avatar/90-90/ng.png" width="90" height="90">
            </div>
            <div class="media-body">
                <h4 class="media-heading"><?php if(isset($q)) { echo $q;
               }else{ echo "#Ngpictures ";
} ?></h4>
                <?php if(isset($q)) {echo "Aucun résultat pour ce membre";
                }else{ echo "Aucun membre";
}?>
                <hr>
                <time><?php echo getTodayDate() ?></time>
            </div>
        </div>
        </div>

    <?php }?>

    </div><!-- /followers -->


    <div class="tab-pane fade " role="tabpanel" id="following" aria-labelle$dby="following-tab">
        <?php $fwn = $following->rowcount(); ?>
        <h2>Following <span class="ng-badge badge"><?php echo KMF($fwn) ?></span></h2>


        <?php if($following->rowcount() > 0 ) {?>
            <?php while ($fw = $following->fetch()){?>

                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="ng-user-box">
                            <img src="pages/membres/Avatar/40-40/<?php echo getUserProfil($fw['followingID'])?>" width="40px" height="40px" class="img img-circle"/>
                                <?php echo getUserPseudo($fw['followingID']) ?>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                                <span class=" glyphicon glyphicon-option-vertical pull-right"></span></a>
                                <span class="pull-right"><?php echo Check_user_online($fw['followingID'])?></span>

                                <ul class="dropdown-menu panel-heading">

                                    <li><a>Follower<?php echo $t=(Check_follower_num($fw['followingID']) > 1) ? "s" : ""?>: <?php echo KMF(Check_follower_num($fw['followingID']))?></a></li>

                                    <li role="separator" class="divider"></li>
                                    <li><a>Following: <?php echo KMF(Check_following_num($fw['followingID']))?></a></li>
                                    <li role="separator" class="divider"></li>


                                    <?php $poste = getPicturesInfo($fw['followingID'], "nombre") + getArticleInfo($fw['followingID'], "nombre") ?>
                                    <li><a>Poste<?php echo $test = ($poste > 1) ? "s" : "" ;?>: <?php echo KMF($poste); ?> </a></li>

                                </ul>
                            </li>

                            <?php if(getUserStatut($fw['followingID']) == " ") {?><h5>Hey tout le monde, suis sur #Ngpictures...</h5><?php 
                            }?>

                            <h5><?php echo text(getUserStatut($fw['followingID'])) ?></h5>

                            <?php if($_SESSION['id'] != $fw['followingID']) {?>

                            <?php $photo= $db->prepare("SELECT * from galerie where userID = ? order by date_pub desc limit 0,3");
                            $photo->execute(array($fw['followingID']));?>

                            <?php while($p = $photo->fetch()){ ?>

                            <?php

                                // les photo doit fit avec la taille d l'ecran c prkoi y a toute ces class la...
                            if($photo ->rowcount() >= 3) { $class ="col-lg-4 col-sm-4 col-md-4 col-xs-4 pull-left";
                            }elseif($photo ->rowcount() == 2) {  $class="col-lg-6 col-sm-6 col-md-6 col-xs-6 pull-left";
                            }else{ $class="hidden-lg hidden-xs hidden-sm hidden-md";
                            }
                            ?>

                            <div class="<?php echo $class ?>">
                                <div class="row">
                                    <div class="ng-img-default">
                                        <a href="pages/galerie/photo.php?type=user&id=<?php echo $p['id']; ?>">
                                            <img class="img img-responsive" src="pages/galerie/images/640-640/<?php echo $p['nom'] ?>" alt="...">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <?php } //fin while ?>

                            <div class="btn-group btn-sm " role="group">
                                <button type="button" class="btn btn-default btn-sm">
                                    <a href="profil.php?id=<?php echo $fw['followingID']; ?>">Profil</a>
                                </button>

                                <button type="button" class="btn btn-default btn-sm">
                                    <a href="/src/script/following.php?followingID=<?php echo $fw['followingID'] ?>">
                                    <?php echo check_following_statut($_SESSION['id'], $fw['followingID']) ?></a>
                                </button>

                                <button type="button" class="btn btn-default btn-sm">
                                    <a href="/galerie?id=<?php echo $fw['followingID']; ?>"">Galerie</a>
                                </button>
                            </div>

                            <?php } //fin if... ?>
                        </div>
                    </div>
                </div>
            <?php }?>
        <?php }else{?>

        <div class="ng-user-box">
            <div class="media">
                <div class="media-left media-top">
                    <img class="media-object" src="pages/membres/Avatar/90-90/ng.png" width="90" height="90">
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?php if(isset($q)) { echo $q;
                   }else{ echo "#Ngpictures ";
} ?></h4>
                    <?php if(isset($q)) {echo "Aucun résultat pour ce membre";
                    }else{ echo "Aucun membre";
}?>
                    <hr>
                    <time><?php echo getTodayDate() ?></time>
                </div>
            </div>
        </div>

        <?php }?>

    </div><!-- /following -->
</div><!-- tab-content-->

</div><!-- row -->
</div><!-- container -->

<div class="ng-espace-fantom"></div>
</section>

<?php require '../includes/footer.php'; ?>

<!-- script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="/assets/js/js+/jquery.min.js"><\/script>')
    </script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/ng-alert-V2.js"></script>
<!-- / script -->

</body>
</html>
