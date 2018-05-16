<?php


//connexion a la base de donnee
$get_database_connexion = function ($name, $host = 'localhost', $user = 'root', $password = '') {
    try {
        $bdd = new PDO("mysql:host={$host};dbname={$name};charset=utf8", "{$user}", "{$password}");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $bdd->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);

        return $bdd;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
};

$db = $get_database_connexion('oldversion');

//-------------------------------------------------------------------------------------
// les chaines de carateres et les nombres
//-------------------------------------------------------------------------------------


/**
 * obtenir une partie du text, et ajouter des points
 * juste apres.
 *
 * @param string $text
 * @param integer $maxchars
 * @param integer $points
 * @return string
 */
function truncate($text,$maxchars = 157, $points = 1)
{
        if(strlen($text)>$maxchars)
        {
            $text = substr($text,0,$maxchars); // on recupere le text jusqu'au max de chars
            $position_espace = strrpos($text," "); // on recupre le dernier espace pour ne pas tronquer un mot
            $text = substr($text, 0 , $position_espace); // on recupere le text jusqu'au dernier espace apr le max chars
            if($points == 1){$text = $text."..." ;}

        }
        return $text;
}


/**
 * fait un KM format sur les nombres cad  1000 = 1k
 *
 * @param string $nombre
 * @return string
 */
function KMF($nombre)
{
    $nbr = intval($nombre);

    if ($nbr >= 0 && $nbr < 1000) {
        $cal = $nbr;
        $formated = "$cal";
        return $formated;
    } else if ($nbr >= 1000 && $nbr < 100000) {
        $cal = round(($nbr / 1000), 1);
        $formated = "$cal" . "K";
        return $formated;
    } else if ($nbr >= 100000) {
        $cal = round(($nbr / 100000), 1);
        $formated = "$cal" . "M";
        return $formated;
    } else {
        return $nbr;
    }
}


/**
 * formatage du text, avec un system d'htag
 * et mention des users
 *
 * @param string $text
 * @return string
 */
function text($text){

    $text = nl2br(user_mention_verif(htag($text)));
    return $text;
}



//-------------------------------------------------------------------------------------
// gestion des dates
//-------------------------------------------------------------------------------------

/**
 * recupere la date du jour courant
 *
 * @return string
 */
function getTodayDate()
{
        setlocale(LC_TIME, 'fr');
        $date = date('Y-m-d' , time());
        $mois = substr(strftime('%d', strtotime($date)), 0,3);
        $dtt = ucfirst(strftime('%B-%Y' , strtotime($date)));
        $formated = "$mois $dtt";
        return $formated;
}


/**
 * recupere la date d'une maniere particuliere :)
 * juste le jour disons.
 *
 * @param string $date
 * @return string
 */
function getDay($date)
{
        setlocale(LC_TIME,'fr');
        $dtt = $date ;
        $jour =strftime('%d', strtotime($dtt));
        return $jour;
}


/**
 * recupere le mois
 *
 * @param string $date
 * @return string
 */
function getMonth($date){
        setlocale(LC_TIME,'fr');
        $dtt = $date ;
        $mois =substr(strftime('%B', strtotime($date)), 0,3);
        return $mois;
}


/**
 * recupere une date relative par rapport a celle passer en param
 *
 * @param string $temps_recu
 * @return string
 */
function getRelativeTime($temps_recu)
{
    setlocale(LC_TIME,'fr'); // on met en francais les mois et les jours
    $temps_actu = time();
    $temps_recu = strtotime($temps_recu);
    $temps = $temps_actu - $temps_recu ;  // on recupere le temp passer entr les deux dates

    if($temps >= 3600 && $temps <= 86400)  // si les secondes passee sont dans cett interval c'est les heures
    {
        $calcul = intval($temps / 3600);  // on divise sans restes les secondes par le nombre de secondes dans une heure
        $formated = "il y a $calcul"."h";
    }
    else if($temps >= 60 && $temps < 3600 ) // minutes
    {
        $calcul = intval(($temps % 3600) / 60);
        $formated = "il y a $calcul"."m";
    }
    else if($temps > 86400 &&  $temps <= 604800 ) // si les secondes passee sont dans cett interval c'est les jours
    {
        $calcul = intval($temps / 86400 ); // on divise sans restes les secondes par le nombre de secondes dans un jour
        $formated = "il y a $calcul"."j";
    }
    else if($temps > 604800) // au dela de 7 jour on affiche la date...
    {
        $dtt = $temps_recu ; // date recu en paremetre
        $jour = substr(strftime('%d', $dtt), 0,3); // on recupere les 3 premiere lettres pour le mois
        if(date("Y") == strftime("Y",$dtt)){
            $date = ucfirst(strftime('%B' , $dtt)); // on recupere le mois et l'annee
        }else{
            $date = ucfirst(strftime('%B' , $dtt)); // on recupere le mois et l'annee
        }

        $formated = "$jour $date";
    }
    else{

        $calcul = intval($temps % 60); // secondes
        $formated = "il y a $calcul"."s";
    }
    return $formated;
}



//-------------------------------------------------------------------------------------
// les informations sur les publications
//-------------------------------------------------------------------------------------

/**
 * recupere la miniature d'un post
 *
 * @param int $article
 * @return string
 */
function getPostThumb($article)
{
        global $db;
        $articleID = $article;
        $min= $db->prepare("SELECT * from article where id= ?");
        $min->execute(array($articleID));
        $min = $min->fetch();
        $min = $min['miniature'];
        $formated = $min;

        return $formated;
}


/**
 * recupere la miniature du blog
 *
 * @param int $article
 * @return string
 */
function getBlogThumb($article)
{
    global $db;
    $articleID = $article;

    $min= $db->prepare("SELECT * from ngarticle where id= ?");
    $min->execute(array($articleID));
    $min = $min->fetch();
    $min = $min['miniature'];
    $formated = $min;

    return $formated;
}


/**
 * @param int $article
 * @return void
 */
function getPicturesThumb($article)
{
    global $db;
    $articleID = $article;
    $min= $db->prepare("SELECT * from galerie where id= ?");
    $min->execute(array($articleID));
    $min = $min->fetch();
    $min = $min['nom'];
    $formated = $min;

    return $formated;
}


/**
 * @param string $article
 * @return void
 */
function getBlogPicturesThumb($article)
{
    global $db;
    $articleID = $article;
    $min= $db->prepare("SELECT * from nggalerie where id= ?");
    $min->execute(array($articleID));
    $min = $min->fetch();
    $min = $min['nom'];
    $formated = $min;

    return $formated;
}


/**
 *  recupere les info d'un post
 *
 * @param int $article
 * @param string $info
 * @return void
 */
function getArticleInfo($article,$info)
{
    global $db;
    $articleID = $article;

    if($info == "like"){

        $likes = $db -> prepare("select * from likes where articleID = ?");
        $likes -> execute(array($articleID));
        $likes = $likes->rowcount();

        $formated = $likes;

    }
    elseif($info == "dislike"){

        $dislikes = $db -> prepare("select * from dislikes where articleID = ?");
        $dislikes -> execute(array($articleID));
        $dislikes = $dislikes ->rowcount();

        $formated = $dislikes;
    }
    elseif($info == "love"){

        $love= $db->prepare("select * from love where articleID = ?");
        $love->execute(array($articleID));
        $love= $love->rowcount();

        $formated = $love;
    }
    else if($info == "commentaire"){

        $comment= $db->prepare("select * from commentaire where articleID = ?");
        $comment ->execute(array($articleID));
        $comment = $comment ->rowcount();

        $formated = $comment;
    }
    else if($info == "nombre"){

        $nombre= $db->prepare("select id from article where posterID = ?");
        $nombre ->execute(array($articleID));
        $nombre = $nombre ->rowcount();

        $formated = $nombre;
    }
    else if($info == "nb_article"){

        $nombre= $db->prepare("select id from article where id = ?");
        $nombre ->execute(array($articleID));
        $nombre = $nombre ->rowcount();

        $formated = $nombre;
    }
    else if($info == "posterID"){

        $nombre= $db->prepare("select posterID from article where id = ?");
        $nombre ->execute(array($articleID));
        $nombre = $nombre ->fetch()['posterID'];

        $formated = $nombre;
    }else{

        return false;
    }

    return $formated;
}


/**
 * @param int $article
 * @param string $info
 * @return void
 */
function getBlogInfo($article,$info)
{
    global $db;
        $articleID = $article;

        if($info == "like"){

            $likes = $db -> prepare("select id from nglikes where articleID = ?");
            $likes -> execute(array($articleID));
            $likes = $likes->rowcount();

            $formated = $likes;

        }
        elseif($info == "dislike"){

            $dislikes = $db -> prepare("select id from ngdislikess where articleID = ?");
            $dislikes -> execute(array($articleID));
            $dislikes = $dislikes ->rowcount();

            $formated = $dislikes;
        }
        elseif($info == "love"){

            $love= $db->prepare("select id from nglove where articleID = ?");
            $love->execute(array($articleID));
            $love= $love->rowcount();

            $formated = $love;
        }
        else if($info == "commentaire"){

            $comment= $db->prepare("SELECT id from ngcommentaire where articleID = ?");
            $comment ->execute(array($articleID));
            $comment = $comment ->rowcount();

            $formated = $comment;
        }
        else if($info == "nombre"){

            $nombre= $db->prepare("SELECT id from ngarticle where articleID = ?");
            $nombre ->execute(array($articleID));
            $nombre = $nombre ->rowcount();

            $formated = $nombre;

        }else if($info == "miniature"){
            $min = $db->prepare("SELECT miniature from ngarticle where id = ?");
            $min->execute(array($articleID));
            $min = $min->fetch();
            $min = $min['miniature'];

            $formated = $min;
        }
        else{

           return false;
        }

        return $formated;
}


function getPicturesInfo($photo,$info)
{
    global $db;
    $photoID = $photo;

    if($info == "like"){

        $likes = $db -> prepare("select * from likes where photoID = ?");
        $likes -> execute(array($photoID));
        $likes = $likes->rowcount();

        $formated = $likes;

    }
    elseif($info == "dislike"){

        $dislikes = $db -> prepare("select * from dislikes where photoID = ?");
        $dislikes -> execute(array($photoID));
        $dislikes = $dislikes ->rowcount();

        $formated = $dislikes;
    }
    elseif($info == "love"){

        $love= $db->prepare("select * from love where photoID = ?");
        $love->execute(array($photoID));
        $love= $love->rowcount();

        $formated = $love;
    }
    else if($info == "commentaire"){

        $comment= $db->prepare("select * from commentaire where photoID = ?");
        $comment ->execute(array($photoID));
        $comment = $comment ->rowcount();

        $formated = $comment;
    }
    else if($info == "nombre"){

        $nombre= $db->prepare("select id from galerie where userID = ?");
        $nombre ->execute(array($photoID));
        $nombre = $nombre ->rowcount();

        $formated = $nombre;


    }
    else if($info == "nb_photo"){

        $nombre= $db->prepare("select id from galerie where id = ?");
        $nombre ->execute(array($photoID));
        $nombre = $nombre ->rowcount();

        $formated = $nombre;


    }
    else if($info == "posterID"){

        $nombre= $db->prepare("select userID from photo where id = ?");
        $nombre ->execute(array($photoID));
        $nombre = $nombre ->fetch()['posterID'];

        $formated = $nombre;


    }else{

        return false;
    }

    return $formated;
}


/**
 * @param int $photo
 * @param string $info
 * @return void
 */
function getBlogPicturesInfo($photo,$info)
{
    global $db;
    $photoID = $photo;

    if($info == "like"){

        $likes = $db -> prepare("select id from nglikes where photoID = ?");
        $likes -> execute(array($photoID));
        $likes = $likes->rowcount();

        $formated = $likes;

    }
    elseif($info == "dislike"){

        $dislikes = $db -> prepare("select id from ngdislikess where photoID = ?");
        $dislikes -> execute(array($photoID));
        $dislikes = $dislikes ->rowcount();

        $formated = $dislikes;
    }
    elseif($info == "love"){

        $love= $db->prepare("select id from nglove where photoID = ?");
        $love->execute(array($photoID));
        $love= $love->rowcount();

        $formated = $love;
    }
    else if($info == "commentaire"){

        $comment= $db->prepare("SELECT id from ngcommentaire where photoID = ?");
        $comment ->execute(array($photoID));
        $comment = $comment ->rowcount();

        $formated = $comment;
    }
    else if($info == "nombre"){

        $nombre= $db->prepare("SELECT id from nggalarie where photoID = ?");
        $nombre ->execute(array($photoID));
        $nombre = $nombre ->rowcount();

        $formated = $nombre;

    }else if($info == "miniature"){
        $min = $db->prepare("SELECT miniature from nggalarie where id = ?");
        $min->execute(array($photoID));
        $min = $min->fetch();
        $min = $min['miniature'];

        $formated = $min;
    }
    else{

        return false;
    }

    return $formated;
}


//-----------------------------------------------------------------------------------------------
//  information sur les users
//-----------------------------------------------------------------------------------------------

/**
 * recupere le pseudo d'un user
 *
 * @param int $post_user_id
 * @return string
 */
function getUserPseudo($post_user_id)
{
    global $db;
    $posterID =$post_user_id;
    var_dump($db); die();
    $Posteur = $db->query("SELECT pseudo from membres where id=".$posterID." ");

    $pseudo = $Posteur->fetch();
    $formated = $pseudo['pseudo'];
    return $formated;
}


/**
 * @param int  $post_user_id
 * @return string
 */
function getUserName($post_user_id)
{
    global $db;
    $posterID =$post_user_id;
    $Posteur =$db->query("SELECT nom_complet from membres where id=".$posterID." ");
    $pseudo = $Posteur->fetch();
    $formated = $pseudo['nom_complet'];
    return $formated;
}


/**
 * @param int $post_user_id
 * @return string
 */
function getUserStatut($post_user_id)
{
    global $db;
    $posterID =$post_user_id;
    $Posteur =$db->query("SELECT statut from membres where id=".$posterID." ");
    $pseudo = $Posteur->fetch();
    $formated = $pseudo['statut'];
    return $formated;
}


/**
 * @param int $post_user_id
 * @return string
 */
function getUserProfil($post_user_id)
{
    global $db;
    $posterID =$post_user_id;
    $Posteur =$db->query("SELECT avatar from membres where id=".$posterID." ");
    $pseudo = $Posteur->fetch();
    $formated = $pseudo['avatar'];
    return $formated;
}


/**
 * @param int $post_user_id
 * @return string
 */
function getUserPhone($post_user_id)
{
    global $db;
    $posterID =$post_user_id;
    $Posteur =$db->query("SELECT num from membres where id=".$posterID." ");
    $pseudo = $Posteur->fetch();
    $formated = $pseudo['num'];
    return $formated;
}


/**
 * @param int $post_user_id
 * @return string
 */
function getUserEmail($post_user_id)
{
    global $db;
    $posterID =$post_user_id;
    $Posteur =$db->query("SELECT email from membres where id=".$posterID." ");
    $pseudo = $Posteur->fetch();
    $formated = $pseudo['email'];
    return $formated;
}




//-----------------------------------------------------------------------------------------------------------
// god first 1.0
//-----------------------------------------------------------------------------------------------------------

/**
 * recupere un verset, celui du jour
 * @return string
 */
function getTodayVerset()
{
    global $db;
    $vbj = $db->query('SELECT * from verset order by id desc limit 0,1');
    $V = $vbj->fetch();
    $verset = $V['contenu'] ;

    return $verset;
}


/**
 * recupere la reference d'un verset, celui du jour
 * @return string
 */
function getTodayVersetRef()
{
    global $db;
    $vbj = $db->query('SELECT * from verset order by id desc limit 0,1');
    $V = $vbj->fetch();
    $ref = $V['ref']  ;

    return $ref;
}


/**
 * recupere les nombres de versets
 * @return int
 */
function getVersetNumber()
{
    global $db;
    $vbj = $db->query('SELECT * from verset order by id desc limit 0,1');
    $V = $vbj->rowcount();
    return $V;
}


//---------------------------------------------------------------------------------------------------------------
// mention d'un user et system d'htag
//---------------------------------------------------------------------------------------------------------------


/**
 * mention d'un user  avec @... les deux fonctions vont de paires...
 * le lien vers le profil doit etre en absolue, vu que suis sur la machine sa sera different du server, pensez a changer sa... :)
 *
 * @param string $text
 * @return string
 */
function user_mention_verif($text)
{
    global $db;
    $text_format = strtolower($text);
    $text = $text_format;
    $text = preg_replace_callback("#@([a-zA-Z0-9_]+)#", function ($matches) use ($db) {
        $verif = $db->prepare("SELECT id  from membres where pseudo = ?");
        $verif->execute(array($matches[1]));

        if ($verif->rowcount() == 1) {
            $userID = $verif->fetch()['id'];
            return '<a style="color:#428bca; text-transform:none;" href="pages/membres/profil.php?id=' . $userID . '">' . $matches[0] . '</a>';
        }
        return $matches[0];
    }, $text);
    return $text;
}


/**
 * system htag
 *
 * @param string $text
 * @return void
 */
function htag($text)
{
        $text_format = strtolower($text);
        $text = $text_format;
        $text = preg_replace_callback("#\#([a-zA-Z0-9_]+)#", function($matches) {
            return '<a style="color:#428bca; text-transform:none;" href=/galerie?q=' . $matches[1] . '>' . $matches[0] . '</a>';
        }, $text);
        return $text;
}


//-------------------------------------------------------------------------------------
// les informations d'un like
//-------------------------------------------------------------------------------------

//pour voir si une personne aime dja un article...
function check_nglike_statut($article,$userID)
{
    global $db;
    $articleID = intval($article);
    $userID = intval($userID);
    $check = $db->prepare("SELECT * from nglikes where articleID = ? and userID = ?");
    $check->execute(array($articleID,$userID));
    $check = $check->rowcount();
    if($check == 0){$text = "j'aime";}
    elseif($check == 1){$text = "<span style='color:#428bca;'>"."J'AIME"."</span>";}
    else{ return false;}

    return $text;
}

function check_like_statut($article,$userID)
{
    global $db;
    $articleID = intval($article);
    $userID = intval($userID);
    $check = $db->prepare("SELECT * from likes where articleID = ? and userID = ?");
    $check->execute(array($articleID,$userID));
    $check = $check->rowcount();
    if($check == 0){$text = "j'aime";}
    elseif($check == 1){$text = "<span style='color:#428bca;'>"."J'AIME"."</span>";}
    else{ return false;}

    return $text;
}

function check_ngdislike_statut($article,$userID)
{
    global $db;
    $articleID = intval($article);
    $userID = intval($userID);
    $check = $db->prepare("SELECT * from ngdislikess where articleID = ? and userID = ?");
    $check->execute(array($articleID,$userID));
    $check = $check->rowcount();
    if($check == 0){$text = "j'aime pas";}
    elseif($check == 1){$text = "<span style='color:#428bca;'>"."J'AIME PAS"."</span>";}
    else{ return false;}

    return $text;
}

function check_dislike_statut($article,$userID)
{
    global $db;
    $articleID = intval($article);
    $userID = intval($userID);
    $check = $db->prepare("SELECT * from dislikes where articleID = ? and userID = ?");
    $check->execute(array($articleID,$userID));
    $check = $check->rowcount();
    if($check == 0){$text = "j'aime pas";}
    elseif($check == 1){$text = "<span style='color:#428bca;'>"."J'AIME PAS"."</span>";}
    else{ return false;}

    return $text;
}

function check_nglove_statut($article,$userID)
{
    global $db;
    $articleID = intval($article);
    $userID = intval($userID);
    $check = $db->prepare("SELECT * from nglove where articleID = ? and userID = ?");
    $check->execute(array($articleID,$userID));
    $check = $check->rowcount();
    if($check == 0){$text = "j'adore";}
    elseif($check == 1){$text = "<span style='color:#428bca;'>"."J'ADORE"."</span>";}
    else{ return false;}

    return $text;
}


function check_love_statut($article,$userID)
{
    global $db;
    $articleID = intval($article);
    $userID = intval($userID);
    $check = $db->prepare("SELECT * from love where articleID = ? and userID = ?");
    $check->execute(array($articleID,$userID));
    $check = $check->rowcount();
    if($check == 0){$text = "j'adore";}
    elseif($check == 1){$text = "<span style='color:#428bca;'>"."J'ADORE"."</span>";}
    else{ return false;}

    return $text;
}



//pour voir si une personne aime dja un article...
function check_nglikep_statut($photo,$userID)
{
    global $db;
    $photoID = intval($photo);
    $userID = intval($userID);
    $check = $db->prepare("SELECT * from nglikes where photoID = ? and userID = ?");
    $check->execute(array($photoID,$userID));
    $check = $check->rowcount();
    if($check == 0){$text = "j'aime";}
    elseif($check == 1){$text = "<span style='color:#428bca;'>"."J'AIME"."</span>";}
    else{ return false;}

    return $text;
}
function check_likep_statut($photo,$userID)
{
    global $db;
    $photoID = intval($photo);
    $userID = intval($userID);
    $check = $db->prepare("SELECT * from likes where photoID = ? and userID = ?");
    $check->execute(array($photoID,$userID));
    $check = $check->rowcount();
    if($check == 0){$text = "j'aime";}
    elseif($check == 1){$text = "<span style='color:#428bca;'>"."J'AIME"."</span>";}
    else{ return false;}

    return $text;
}


function check_ngdislikep_statut($photo,$userID)
{
    global $db;
    $photoID = intval($photo);
    $userID = intval($userID);
    $check = $db->prepare("SELECT * from ngdislikess where photoID = ? and userID = ?");
    $check->execute(array($photoID,$userID));
    $check = $check->rowcount();
    if($check == 0){$text = "j'aime pas";}
    elseif($check == 1){$text = "<span style='color:#428bca;'>"."J'AIME PAS"."</span>";}
    else{ return false;}

    return $text;
}


function check_dislikep_statut($photo,$userID)
{
    global $db;
    $photoID = intval($photo);
    $userID = intval($userID);
    $check = $db->prepare("SELECT * from dislikes where photoID = ? and userID = ?");
    $check->execute(array($photoID,$userID));
    $check = $check->rowcount();
    if($check == 0){$text = "j'aime pas";}
    elseif($check == 1){$text = "<span style='color:#428bca;'>"."J'AIME PAS"."</span>";}
    else{ return false;}

    return $text;
}

function check_nglovep_statut($photo,$userID)
{
    global $db;
    $photoID = intval($photo);
    $userID = intval($userID);
    $check = $db->prepare("SELECT * from nglove where photoID = ? and userID = ?");
    $check->execute(array($photoID,$userID));
    $check = $check->rowcount();
    if($check == 0){$text = "j'adore";}
    elseif($check == 1){$text = "<span style='color:#428bca;'>"."J'ADORE"."</span>";}
    else{ return false;}

    return $text;
}


function check_lovep_statut($photo,$userID)
{
    global $db;
    $photoID = intval($photo);
    $userID = intval($userID);
    $check = $db->prepare("SELECT * from love where photoID = ? and userID = ?");
    $check->execute(array($photoID,$userID));
    $check = $check->rowcount();
    if($check == 0){$text = "j'adore";}
    elseif($check == 1){$text = "<span style='color:#428bca;'>"."J'ADORE"."</span>";}
    else{ return false;}

    return $text;
}


//pour voir si on suis ou pas une personne...
 function check_following_statut($followerID,$followingID){
    global $db;
    $follower = intval($followerID);
    $following = intval($followingID);
    $check = $db->prepare("SELECT * from following where followerID= ? and followingID= ?");
    $check->execute(array($follower,$following));
    $check = $check->rowcount();

    if($check == 0){$text = "Follow";}
    else if($check == 1){$text = "Unfollow";}
    else{return false;}

    return $text;
 }

// les nombres de following...
function Check_following_num($follow){

    global $db;
    $me = intval($follow);
    $check = $db->prepare("SELECT id from following where followerID= ? ");
    $check->execute(array($me));
    $check = $check->rowcount();
    $number = $check;

    return $number;
}

// les nombres de followers
function check_follower_num($follow)
{
    global $db;
    $me = intval($follow);
    $check = $db->prepare("SELECT id from following where followingID= ? ");
    $check->execute(array($me));
    $check = $check->rowcount();
    $number = $check;

    return $number;
}


/// verifie si oui ou non un membre et en ligne...
function Check_user_online($userID)
{
    global $db;
    $time_actu = time();
    $userID = $userID;
    $online_users = $db ->query("SELECT * from online where userID =".$userID);
    $nb_online = $online_users->rowcount();

    if($nb_online == 0){ $statut = "Off";}
    else if($nb_online == 1){ $statut = "En ligne"; }

    return $statut;
}


function check_online_number()
{
    global $db;
    $time_actu = time();
    $userID =$_SESSION['id'];
    $verif = $db -> prepare('SELECT * from online where userID = ?');
    $verif->execute(array($userID));
    $user_online = $verif->rowcount();

        if($user_online == 0){

            $ins = $db ->prepare("INSERT into online(time_actu,userID) values(?,?) ");
            $ins->execute(array($time_actu,$userID));

        }else {

            $update = $db->prepare("UPDATE online set time_actu = ?  where userID = ?");
            $update->execute(array($time_actu,$userID));
        }

    $online_session = time() - 15;

    $del = $db->prepare("DELETE from online where time_actu < ?");
    $del ->execute(array($online_session));

    $online_users = $db ->query("SELECT * from online");
    $nb_online = $online_users->rowcount();

    $t = ($nb_online > 1) ? "s" : "" ;
    $num = "<div class='last'>".KMF($nb_online)." personne".$t." en ligne </div>";
    return $num;
}


?>
