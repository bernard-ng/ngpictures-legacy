<?php
session_start();
require "../src/helper/functions.php";
$db = base_connexion("ngbdd");
include_once("../src/script/cookie.php");

?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <?php include '../includes/favicon.php';?>
    <?php include '../includes/all-meta.php'; ?>
    <title>Idees</title>

  <title>Aide</title>
  <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
  <link href="/assets/css/ng.css" rel="stylesheet" type="text/css" >

</head>
<body>

<body>
<section class="ng-bloc-principal">

<?php include "../includespages/plus/menu.php"; ?>
<?php include "../includes/flash.php"; ?>

<div class="jumbotron ng-margin-default">
    <div class="container">
        <div class="media">
            <div class="media-body" >
                <h2 class="media-heading" style="color:#428bca;"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Aide</h2>
                Besion d'aide ?, vous êtes au bon endroit...<br>
                Vous trouverez ici, les eventuelles réponses aux questions que vous pourriez vous poser, en cas d'une instatisfaction, Veuillez nous <a href="contact.php">écrire</a> ou poser la question de le <a href="pages/membres/chat.php">Chat</a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/verset.php'; ?>

<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
<div class="row">

<div class="ng-panel panel panel-default ng-panel-active">
<div class="ng-panel panel-heading"><span class="glyphicon glyphicon-pushpin pull-right"></span> GENERAL </div>
<div class="panel-body">



<div class="media">
<div class="media-left media-top">
<span class="glyphicon glyphicon-home" style="font-size: 25px;margin-right: 5px;text-align: center;"></span>
</div>
<div class="media-body" >
<h4 class="media-heading" style="color:#428bca">Home</h4>
<p>le fil d'actualités du site et toutes les publications de ce dernier se retrouvent dans cette rubrique,</p>
<dl>
    <dt>Comment voir une publication ?</dt>
    <dd>c'est simple, il suffit de cliquer sur la photo , ou sur l'icon <span class="glyphicon glyphicon-eye-open"></span>.</dd>
    <br>

    <dt>Comment retrouver un article ?</dt>
    <dd> vous pouvez utiliser la barre de recherche, saisissez le nom de l'article si vous l'avez et cliquez sur <span class="glyphicon glyphicon-search"></span> ; si vous ne connaissez pas le nom de l'article cliquez simple sur <span class="glyphicon glyphicon-search"></span>, vous verrez la liste de nos dernier articles et vous pourrez facilement retrouver ce que vous cherchez.</dd>
    <br>

    <dt>Comment écrire de le livre d'or ?</dt>
    <dd>
        à noter que la fonctionnalité du livre d'or n'est pas disponible pour les mobiles. Pour écrire de le livre d'or il suffit de saisir votre commentaire dans l'espace prévu et de cliquez sur <span class="btn btn-xs btn-primary">Commenter</span>, votre commentaire sera visible sur notre site pendans un certain temps, nous n'affichons que les quatres dernier commentaires.
    </dd>
    <br>

    <dt>GOD FRIST qu'est-ce que c'est ?</dt>
    <dd> <span class="glyphicon glyphicon-book"></span> GOD FRIST, est un service réligieux que le site vous offre en vous proposant plus de 500 versets bibliques, à noter que le site est <b>Chrétien</b>.</dd>
    <br>

    <dt>La notation "En ligne"</dt>
    <dd>
        cette notation vous indique si vous êtes connecté ou pas, si vous êtes sur le profil de quelqu'un d'autre , elle vous indique si il est <span class="glyphicon glyphicon-record"></span> en ligne ou pas
    </dd>

</dl>

</div>
</div>


<div class="media">
<div class="media-left media-top">
<span class="glyphicon glyphicon-globe" style="font-size: 25px;margin-right: 5px;text-align: center;"></span>
</div>
<div class="media-body" >
<h4 class="media-heading" style="color:#428bca;">Actualités</h4>
<p>cette icon vous permet de voir le fil d'actualite des vos amis de voir les articles et les lires,</p>


<dl>

<dt>Comment lire un article ?</dt>
<dd>

</dd>
c'est simple, il suffit de cliquer sur la photo , ou sur l'icon <span class="glyphicon glyphicon-eye-open"></span>.


<dt>Comment retrouver un article ?</dt>
    <dd> vous pouvez utiliser la barre de recherche, saisissez le nom de l'article si vous l'avez et cliquez sur <span class="glyphicon glyphicon-search"></span> ; si vous ne connaissez pas le nom de l'article cliquez simple sur <span class="glyphicon glyphicon-search"></span>, vous verrez la liste de nos dernier articles et vous pourrez facilement retrouver ce que vous cherchez.</dd>
    <br>

<dt>Comment "aimer" un article ?</dt>
<dd> Pour "aimer" un article, deux choix s'offrent à vous: vous pouvez directement cliquez sur "<span class="glyphicon glyphicon-thumbs-up"></span> j'aime " ou acceder à l'article pour plus de fonctionnalité telles que : " <span class="glyphicon glyphicon-thumbs-down"></span> je n'aime pas" ou encore "<span class="glyphicon glyphicon-heart" ></span> j'adore" , par la même occasion vous pourrez laissez un commentaire, en remplissant le champs prévu  puis confirmer en cliquant sur <span class="btn btn-xs btn-primary">Commenter</span></dd>
<br>

<dt>Comment voir le profil d'un membre ?</dt>
<dd>Dans la rubrique "Actualité" pour voir le profil d'un membre, deux choix s'offre à vous , vous pouvez cliquez sur son "pseudo" ou acceder à sa publication puis son profil.</dd>

</dl>

</div>

<div class="media">
<div class="media-left media-top">
<span class="glyphicon glyphicon-user" style="font-size: 25px;margin-right: 5px;text-align: center;"></span>
</div>
<div class="media-body" >
<h4 class="media-heading" style="color:#428bca;">Profil</h4>
<p >Retrouvez toutes les informations concernant votre compte ou celui d'un membre.</p>

<dl>


<dt>Comment acceder au profil ?</dt>
<dd>Vous pouvez y acceder en cliquant sur "<span class="glyphicon glyphicon-user"></span> Profil" dans le menu du site ou en cliquant sur votre pseudo dans une publication</dd>
<br>

<dt>Comment Modifier mon profil ?</dt>
<dd>Pour modifier son profil, vous devez cliquez sur "<span class="glyphicon glyphicon-user"></span> Editer mon profil" puis choisir l'infomration à modifier

<ul>
    <li>
    <dt><span class="glyphicon glyphicon-user"></span> le pseudo :</dt> <dd>il vous suffira de saisir dans la zone de text prévu le pseudo que vous désirez avoir, cependant si ce pseudo est dejà pris , vous serrez informer avec un message d'erreur disant "ce pseudo est dejà pris"</dd></li><br>

    <li>
    <dt><span class="glyphicon glyphicon-picture"></span> le Profil :</dt><dd> il vous suffira de cliquez sur <span class="btn btn-xs btn-primary">Photo de profil</span> , choisir une photo puis valider en cliquant sur <span class="btn btn-xs btn-primary">Modifier</span> </dd>
    </li><br>


    <li>
    <dt><span class="glyphicon glyphicon-lock"></span> le Mot de passe :</dt><dd> Vous devrez d'abord saisir votre ancien mot de passe puis en choisir un nouveau, si l'operation ne s'est pas déroulé comme prévu, un message d'erreur vous l'informera, à noter que votre mot de passe doit faire au moins 8 caratères.</dd></li><br>

</ul>

</dd>
<br>

<dt>Comment mettre à jour mon statut ?</dt>
<dd>il vous suffit de cliquez une fois de plus sur "<span class="glyphicon glyphicon-user"></span> Editer mon profil" puis remplir le champ prévu pour le statut en suite valide en cliquant sur <span class="btn btn-xs btn-primary">Modifier</span> </dd><br>


<dt>Comment mentionner un Membre ?</dt>
<dd>Pour mentionner un membres veuillez tout simplement saisir un " @ " devant son pseudo,<br>
ex: <span style="color:#428bca;">@Bernard_ng</span> , <span style="color:#428bca;">@the_queen</span>. si le pseudo que vous avez saisie n'appartient à aucun membre ce dernier restera en noir et ne pourras aucunement vous diriger vers son profil. <br>
ex: @je_nexiste_pas

</dd><br>


</dl>





</div>
</div>



<div class="media">
<div class="media-left media-top">
<span class="glyphicon glyphicon-pencil" style="font-size: 25px;margin-right: 5px;text-align: center;"></span>
</div>
<div class="media-body" >
<h4 class="media-heading" style="color:#428bca;">Publications</h4>
<p >Exprimez-vous, en publiant vos photos ou vos articles.</p>


<dt>Comment acceder aux publication ?</dt>
<dd>il suffira de cliquer sur "<span class="glyphicon glyphicon-pencil"></span> Publications " sur le menu du site.</dd><br>

<dt>Comment publier un article ?</dt>
<dd>il suffira tout simplement de remplir les champs prévus à cet effet, un Titre et du contenu plus une photo de couverture. en suite validez en cliquant sur <span class="btn btn-primary btn-xs">Publier</span></dd><br>

<dt>Comment publier une photo ?</dt>
<dd>il suffira tout simplement de cliquez sur <span class="btn btn-primary btn-xs">Publier une photo</span> , remplir le champ si vous voulais donner une description ou des htags à votre photo puis valider en cliquant sur <span class="btn btn-primary btn-xs">Poster</span></dd><br>

<dt>Comment Modifier un article ?</dt>
<dd>il suffira tout simplement de choisir l'article a Modifier dans votre profil, puis remplir les champs en suite valider en cliquant <span class="btn btn-primary btn-xs">Modifier</span>, cependant la photo de couverture d'un article ne pas encore modifiable avec la version actuelle de Ngpictures.</dd><br>

<dt>Comment crée un Htag ?</dt>
<dd>en effet un htag vous permettra de relier un article à des photos  dans votre galerie, il vous permettra et permettra aussi aux autres membres de retrouver facilement et rapidement vos photos. pour ce faire: il suffit de mettre un <span style="color:#428bca">#Htags</span> dans un article et le même lorsque vous publierez une photo en rapport avec l'article, ainsi les photos et les articles seront liés.</dd><br>


</div>
<div class="media">
<div class="media-left media-top">
<span class="glyphicon glyphicon-camera" style="font-size: 25px;margin-right: 5px;text-align: center;"></span>
</div>
<div class="media-body" >
<h4 class="media-heading" style="color:#428bca;">Galerie</h4>
<p >retrouvez nos photos et celles de vos amis, ici...></z></p>


</div>
</div>
</div>
</div>
</div>
</div>


</div>

</div>

<div class="ng-espace-fantom"></div>
</section>
<?php include "../includes/footer.php"; ?>

<!-- script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="/assets/js/js+/jquery.min.js"><\/script>')
    </script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/ng-alert.js"></script>
<!-- / script -->

</body>
</html>
