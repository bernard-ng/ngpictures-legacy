<?php
session_start();
require '../src/helper/functions.php';
$db= base_connexion("ngbdd");

$all = $db->query("SELECT * from chat order by date_pub ");

while($msg = $all->fetch()){

    if($msg['userID'] != $_SESSION['id']) {?>

        <li class="other">
            <div class="avatar">
                <a href="pages/membres/profil.php?id=<?php echo $msg['userID'] ?>">
                    <img src="pages/membres/Avatar/40-40/<?php echo getUserProfil($msg['userID']) ?>" draggable="false"/>
                </a>
            </div>
                <div class="msg">
                    <p><?php echo text($msg['message'])?></p>
                    <time><?php echo getRelativeTime($msg['date_pub'])?></time>
            </div>
        </li>

    <?php }else if($msg['userID'] == $_SESSION['id']) {?>

        <li class="self">
            <div class="msg">
                <p><?php echo text($msg['message'])?></p>
                <time><?php echo getRelativeTime($msg['date_pub'])?></time>
            </div>
        </li>

    <?php }

}

?>
