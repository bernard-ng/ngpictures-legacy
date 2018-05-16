<?php
session_start();
require "../src/helper/functions.php";
$db = base_connexion("ngbdd");
require "../src/script/cookie.php";
?>


<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <?php require '../includes/favicon.php';?>
    <?php require '../includes/all-meta.php'; ?>
    <title>A propos de nous</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <link href="../assets/css/ng.css" rel="stylesheet" type="text/css" >

</head>
<body >
<section class="ng-main-contain">
<?php require "../includespages/plus/menu.php"; ?>
<?php require "../includes/flash.php"; ?>


<!--banner -->
      <div class="jumbotron">
            <div class="container">
                  <div class="media">
                        <div class="media-body">
                        <h2 class="media-heading" style="color:#428bca;"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> A propos de nous</h2>
                        Retrouvez toutes les photos par Bernard ng, postez vos plus belles photos, publiez vos articles, exprimez vous en long et en large, partagez des sentiments avec vos amis, profitez de la première galerie d'art photographique de la RD congo.
                        </div>
                  </div>
                  <br>
                  <p>
                        <a href="..pages/membres/signup.php" class="btn btn-primary btn-sm" role="button">Inscription</a>
                        <a href="..pages/membres/login.php" class="btn btn-default btn-sm" role="button">Connexion</a>
                  </p>
            </div>
      </div>
<!-- /banner -->

<!-- real body-->
<div class=" container ">
    <!-- about me -->
    <div class="row" >
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
          <div class="media">
                <div class="media-body">
                        <legend class="ng-legend"><h1><small>Moi</small></h1></legend>
                       <p class="text-justify">
                       <br>
                       Salut, c'est Bernard ng, j'ai toujours voulu partager ma passion pour la photographie avec le reste du monde, voilà qu'aujourd'hui cela est possible grâce au site <b>#Ngpictures</b>, je me suis intéressé à la photographie car elle m'a permis de m'exprimer sans l'usage des mots.
                       <br>
                       sa fait presqu'une année que je me suis lancé dans cet aventure, "la photographie" et une année et demi pour la programmation web.
                       <br>
                       vous verrez plus bas qui nous sommes et ce que nous vous proposons comme services.
                       </p>
                 </div>
          </div>
        </div>
    <!-- / about me -->

          <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <img class="img-responsive " src="../assets/imgs/moi.jpg"  alt="...">
          </div>

    </div>

                  <div class="row" id="us">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                              <legend class="ng-legend"><h1><small>Qui nous sommes ?</small></h1></legend>
                              <p>
                              Nous sommes une galerie d'art photographique, nous nous intéressons à tous les meilleurs instants de la vie.
                              <br>
                              la photographie est une technique qui permet de créer des images sans l'action de la main, par l'action de la lumière, ce terme désigne également une branche d'arts graphiques qui utilise cette technique, dont le nom signifie étymologiquement "écriture de la lumière"
                              </p>
                        </div>
                  <!-- / who are we -->
            <br>
      </div>
      <!-- / our team -->

<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="media">
  <div class="media-left media-top">
    <a href="#">
      <img class="media-object" src="..pages/membres/team/bernard (1).jpg" width="64" height="64">
    </a>
  </div>
  <div class="media-body text-justify">
    <h4 class="media-heading">Bernard Ng <br><small>ngandubernard@gmail.com</small></h4>
    vous en savez dejà beaucoups sur moi, je vous propose comme vous le savez sûrement, un service de shooting photo, et programmation de site web, en collaboration avec mon frère et mon ami joseph tshishi.
  </div>
</div>
<br>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="media">
  <div class="media-left media-top">
    <a href="#">
      <img class="media-object" src="..pages/membres/team/balloy (2).jpg" width="64" height="64">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">Naomi Balloy Fane <br><small>naomiballoy0041@gmail.com</small> </h4>
    je suis rédactrice en chef des articles publier sur ngpictures, en outre j'offre le même service, c'est à dire la rédaction de vos différent annonce et article
  </div>
</div>
<br>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="media">
  <div class="media-left media-top">
    <a href="#">
      <img class="media-object text-justify" src="..pages/membres/team/Precylia (2).jpg" width="64" height="64">
    </a>
  </div>
  <div class="media-body text-justify">
    <h4 class="media-heading">Precylia Felo <br><small>alvinsjeymine70@gmail.com</small></h4>
    je suis sociale, amusante, photogénique, je suis un model, vous pouvez faire appel à mes services en me contactant sur l'adresse email ci-dessus...
  </div>
</div>
<br>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="media">
  <div class="media-left media-top">
    <a href="#">
      <img class="media-object" src="..pages/membres/team/sabin (1).jpg" alt="..." width="64" height="64">
    </a>
  </div>
  <div class="media-body text-justify">
    <h4 class="media-heading">Joseph Tshishi <br><small>...</small></h4>
    je suis un web programmeur , je travaille avec bernard ng pour ses différents projet, je vous offre aussi un service de prograamation de site web...
  </div>
</div>
<br>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="media">
  <div class="media-left media-top">
    <a href="#">
      <img class="media-object" src="..pages/membres/team/prisca.jpg" alt="..." width="64" height="64">
    </a>
  </div>
  <div class="media-body text-justify">
    <h4 class="media-heading">Prisca Felo <br><small>...</small></h4>
    je suis amusante, gentille, j'aime la photographie et les arts graphiques, je vous propose un service de modification de photo avec applications mobiles.
  </div>
</div>
<br>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="media">
  <div class="media-left media-top">
    <a href="#">
      <img class="media-object" src="..pages/membres/team/gretta (1).jpg" alt="..." width="64" height="64">
    </a>
  </div>
  <div class="media-body text-justify">
    <h4 class="media-heading">Gretta mpunga <br><small>...</small></h4>
    je suis sociale, amusante, photogénique, je suis un model, vous pouvez faire appel à mes services en me contactant sur l'adresse email ci-dessus...
  </div>
</div>
<br>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="media">
  <div class="media-left media-top">
    <a href="#">
      <img class="media-object" src="..pages/membres/team/joelle.jpg" alt="..." width="64" height="64">
    </a>
  </div>
  <div class="media-body text-justify">
    <h4 class="media-heading">Joelle Kitume <br><small>joellekitumenyota@gmail.com</small></h4>
    je suis une fille ambitieuse et qui veut atteindre tout ses objectifs. En soutenant l'organisation Ngpictures qui est constitué des jeunes ambitieux comme moi, je vous propose tous les versets bibliques sur le site...
  </div>
</div>
<br>
</div>
</div>



      <!-- nos services -->
                  <div class="row" id="ser">
                        <div class="col-lg-8">
                              <legend class="ng-legend"><h1><small>Nos services</small></h1></legend>
                        </div>
                  </div>

                  <div class="row">
                        <div class="container">
                              <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                                    <article>
                                          <div class="media-body">
                                                <h4 class="media-heading"><span class="glyphicon glyphicon-camera"></span> SHOOTING</h4>

                                                <p class="text-left"> Nous sommes disponbile à immortaliser vos instants magiques à moindre coût: $25 pour les manifestations et $15 pour 50photos shooting. </p>

                                                <!-- petite information -->
                                                <div class="container-viewport">
                                                      <button type="button" class="btn btn-default btn-xs tooltip-viewport-bottom" title="Bernard Ng &nbsp; Contact : +243973141132">
                                                      Info
                                                      <span class="glyphicon glyphicon-exclamation-sign"></span>
                                                      </button>
                                                </div>
                                                <!-- petite information -->
                                          </div>
                                    <pages/article>
                                    <br>
                              </div>

                              <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                                    <article>
                                          <div class="media-body">
                                                <h4 class="media-heading"><span class="glyphicon glyphicon-edit"></span> ART-MODIFICATION</h4>

                                                <p class="text-left"> Salut c'est Prisca felo, je vous fournie un service de Modification et amélioration de vos photos avec applications mobile  à moindre coût...
                                                </p>

                                                <!-- petite information -->
                                                <div class="container-viewport">
                                                      <button type="button" class="btn btn-default btn-xs tooltip-viewport-bottom" title="Prisca felo &nbsp; Contact : +243994398276">
                                                      Info
                                                      <span class="glyphicon glyphicon-exclamation-sign"></span>
                                                      </button>
                                                </div>
                                              <!-- / petite information -->
                                          </div>
                                    <pages/article>
                                    <br>
                              </div>

                              <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                                    <article>
                                          <div class="media-body">
                                                <h4 class="media-heading"><span class="glyphicon glyphicon-user"></span> SHOOTING MODEL </h4>

                                                <p class="justify"> Ngpictures vous fournie aussi des models pour vos séances shooting et publicités , vous pouvez aussi vous enregistré en tant que model... </p>

                                                <!-- petite information -->
                                                <div class="container-viewport">
                                                      <button type="button" class="btn btn-default btn-xs tooltip-viewport-bottom" title="Veuillez créer un compte pour en savoir plus">
                                                      Info
                                                      <span class="glyphicon glyphicon-exclamation-sign"></span>
                                                      </button>
                                                </div>
                                                <!-- / petite information -->
                                          </div>
                                    <pages/article>
                                    <br>
                              </div>
                        </div>


                              <div class="col-lg-12">
                                    <div class="well well-xs">
                                          NB: Les services proposés sont disponibles que pour la ville de lubumbashi, RD congo.
                                    </div>
                              </div>
                  </div>

      <!-- / nos services -->


<!-- nos photos -->
      <div class="container" id="pic">
            <legend class="ng-legend"><h1><small>Nos photos</small></h1></legend>

            <p>
                   l'ombre et la lumière sont à la fois l’angélisme et le démoniaque, mutuellement elles révèlent et cachent les choses. Elles sont tour a tour voilées dans l'ombre et étincelantes avec la grâce de la lumière.même si la réalité n'est pas seulement faite de noir et blanc, ces deux opposes cohabitent souvent dans une même image. Les contrastes qui en émanent par leur conformation aboutissent à une force expressive.
            </p>
            <p>
                  l'ombre et la lumière surgissent de presque nul part, évanescentes elles apparaissent et disparaissent au gré du temps, elles sont par définition insaisissables et impalpables. seule la prise de vue photographique permet de monter la magie de cette dualité fraternelle. En effet l’ombre et la lumière sont les deux faces déterminantes de la photographie, souvent elles se font un face à face perpétuel dans des compositions surprenantes. Elles ne sont jamais neutres. Ainsi elle peuvent être une forme autonome se superposant à une réalité déjà présente. Nos  photos sont l'expression même de l'ombre sinueuse d'une personne.
            </p>

            <?php $photo = $db->query("SELECT nom from nggalerie order by rand() limit 0,8");
            while($p = $photo->fetch()){ ?>

                  <div class="col-sm-3 col-md-3 col-lg-3 col-xs-4">
                        <div class="row">
                              <div class="img img-thumbnail">
                                    <img class="img img-responsive" src="..pages/galerie/ngimages/640-640/<?php echo $p['nom'] ?>" alt="...">
                              </div>
                        </div>
                  </div>
            <?php } ?>
    </div>
<!-- /nos photos -->


<div class="col-xs-12 col-lg-8 col-md-8 col-sm-8">
<div class="row">


                        <div class="container">
                        <h1><small>Contactez-nous</small></h1>
                        </div>

                  <ul class=" nav nav-tabs navbar-inverse ">

                        <li role="presentation"><img src="../assets/icons/face.png" width="21px"/></li>
                        <li role="presentation"><img src="../assets/icons/phone.png" width="21px"/></li>
                        <li role="presentation"><img src="../assets/icons/twitter.png" width="21px"/></li>
                        <li role="presentation"><img src="../assets/icons/insta.png" width="21px"/></li>
                        <li role="presentation"><img src="../assets/icons/youtube.png" width="21px"/></li>
                        <li role="presentation"><img src="../assets/icons/messenger.png" width="21px"/></li>
                        <li role="presentation"><img src="../assets/icons/1487339227_Skype_icon.png" width="21px"/></li>
                        <li role="presentation"><img src="../assets/icons/chat.png" width="21px"/></li>
                        <li role="presentation"><img src="../assets/icons/user.png" width="21px"/></li>

                  </ul>

                  <blockquote>
                        <p class="small">facebook: Bernard Ng</p>
                        <p class="small">whatsapp: +243973141132</p>
                        <p class="small">insta: Ngpicture_23</p>
                        <p class="small">ngandubernard@gmail.com</p>
                  </blockquote>

                  <div class="container-fluide">
                      <p class="text-justify">
                              Hey tout le monde c'est encore Bernard ng, président fondateur de Ngpictures, j'espère que vous vous plaisez ici et que vous aimez nos photos, mon equipe et moi nous nous donnons à fond pour fournir un travail bien fait...<br>
                              ♥la capture du sentiment♥<br>
                              ♥Deep sooting♥<br><br>
                      </p>
                  </div>

            </div>
</div>
            <div class="hidden-xs col-lg-4 col-md-4 col-sm-4">
            <div class="row">

                  <div class="container-fluide" id="pic">
                        <h1><small>Navigation</small></h1>
                  </div>
                  <div class="navbar navbar-default">
                        <ul class="nav ">
                              <li><a href="#me">A propos de moi</a></li>
                              <li><a href="#us">qui nous sommes?</a></li>
                              <li><a href="#ser">Nos services</a></li>
                              <li><a href="#pic">Nos photos</a></li>
                        </ul>
                  </div>
            </div>
</div>


</div><!-- / fin Du container -->

<div class="ng-espace-fantom"></div>
</section>
<?php require "../includes/footer.php"; ?>


</section>

<!-- importation Des script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="../assets/js/js+/jquery.min.js"><\/script>')
    </script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/tooltip-viewport.js"></script>
<!-- / importation Des script -->

</body>
</html>
