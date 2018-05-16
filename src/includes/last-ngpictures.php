<?php
/*

  cette card doit etre vu sur le profil et uniquement la...
  le user peux close sa si il a deja vu l'article ou je voulais que si il a deja vu que sa n'apparaisse mm pas
  si non sa apparait.. mais comme j'ai pas le temps a reflechir a sa...

  sa peux rester comme sa mais si vous pouvez :) sa serai avec joie

*/
$ng_pic = $db ->query("SELECT * from ngarticle order by date_pub desc limit 0,1 ");
$newss = $ng_pic->fetch();

?>
<!-- latest ngpictures -->
<div class="ng-alert ng-panel panel-primary">
    <div class="ng-panel panel-heading"><span class="glyphicon glyphicon-camera"></span>  NGPICTURES</div>
    <div class="panel-body ">
            Salut <?php echo getUserPseudo($_SESSION['id']) ?> as-tu dejà lu mon dernier article ?
        <br><br>
        <article class= "card">
            <header class="card--thumb">
                <a href="\ngarticle\ngarticle.php?id=<?php echo $newss['id']?>"><img src="\ngarticle\miniature\640-640\<?php echo getBlogThumb($newss['id'])?>" /></a>
            </header>
            <div class="card--date">
                <span class="card--date--day"><?php echo date('d');?></span>
                <span class="card--date--month"><?php echo date('M');?></span>
            </div>
            <div class="card--body">
                <div class="card--category">actu</div>
                <div class="card--subtitle"><a href="\ngarticle\ngarticle.php?id=<?php echo $newss['id']?>"><?php echo truncate($newss['titre'], 20)?></a></div>

                <p class="card--desc">
                    <?php echo user_mention_verif(htag(truncate($newss['contenu'], 90)))?>
                    <br>
                    <button class="btn btn-primary btn-xs ng-btn"><a href="\ngarticle\ngarticle.php?id=<?php echo $newss['id']?>">
                    <span class="glyphicon glyphicon-chevron-right"></span></a>
                    </button>
                </p>
            </div>
            <footer class="card--footer">
                <span class="glyphicon glyphicon-time"></span> <?php echo getRelativeTime($newss['date_pub']);?>
            </footer>
        <pages/article>
    </div>
</div>
<!-- / latest ngpictures -->
