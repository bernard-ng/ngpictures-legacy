    <div class="hidden-xs">
        <div class="box-body">
            <form method="post" action="/src/script/livre_dor.php">
                <label for="commentaire">Un commentaire ?</label>
                <textarea type="text" class="textarea-default" name="commentaire" placeholder="Ecrivez dans notre livre d'or..."><?php if(isset($_POST['commentaire'])) { echo $_POST['commentaire'];
               }?></textarea>

                <div class="box-footer clearfix">
                <button  type="submit"  name="commenter" class="pull-right btn btn-primary btn-sm" role="button">commenter</button>
                <button  type="reset"  name="reset" class="pull-right btn btn-default btn-sm" role="button">Annuler</button>
                </div>
            </form>
        </div>

        <?php

            $commentaire = $db->query('SELECT * from livre_dor order by date_pub desc limit 0,5');
            $commentaires = $db ->query('SELECT * from livre_dor order by date_pub desc');
            $Nc = $commentaires ->rowcount();
        ?>

        <div class="ng-panel panel panel-primary">
            <div class="ng-panel panel-heading ng-margin-default" role="tab" >
                <span class="glyphicon glyphicon-chevron-right"></span>  COMMENTAIRES
                <span class="ng-badge badge"><?php echo KMF($Nc)?></span>
            </div>


            <?php if($Nc >= 1) {

                while($c = $commentaire->fetch()){ ?>

                <ul class="list-group">

                    <li class="list-group-item ng-border">
                        <div class="media">
                            <div class="media-left media-top">
                                <a href="pages/membres/profil.php?id=<?php echo $c['userID']?>">
                                <img class="media-object img img-circle" src="pages/membres/Avatar/40-40/<?php echo getUserProfil($c['userID'])?>" width="40" height="40"></a>
                            </div>
                            <div class="media-body">
                                <a href="pages/membres/profil.php?id=<?php echo $c['userID']?>">
                                <h5 class="ng-user-name"><?php echo getUserPseudo($c['userID'])?></h5></a>
                            </div>
                                <h6><?php echo text($c ['commentaire']) ?></h6>
                                <span class="pull-right">
                                <time><span class="glyphicon glyphicon-time"></span> <?php echo getRelativeTime($c['date_pub'])?></time></span>

                        </div>
                    </li>

                <?php }?>
                <?php if($Nc > 5) {?>

                    <li class="list-group-item ng-margin-default">
                        <center>Merci pour vos commentaires</center>
                    </li>

                </ul>
                <?php }

            }else{?>

            <ul class="list-group">
                <li class="list-group-item ng-border">
                    <div class="media">
            <div class="media-left media-top">
                <img class="media-object img img-circle" src="pages/article/miniature/rien.jpg" width="40" height="40">
            </div>
            <div class="media-body">
                <h5 class="media-heading">aucun commentaire</h5>
                <h6>Soyez la première personne à reagir...</h6>
                <time><h6><span class="pull-right"><?php echo getTodayDate()?></span></h6></time>
            </div>
                    </div>
                </li>
            </ul>

<?php } ?>


        </div>
    </div>
