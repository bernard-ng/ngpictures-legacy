<?php
/*

ceci est une pagination ordinaire, ce que je ne veux pas, mais faute de temps j'ai pas pu apprendre a faire une pagination
comme celle de facebook cad quand on scroll est que le nombre d'info queried arrive a la fin sa fait un chargement et le reste s'affiche
un peu comme aussi instagram dnc suremnt c'est ajax si possible update this... merci

*/
$articlesParPage =5;
$articlesTotalreq = $db->query('select id from ngarticle ');
$articleTotal= $articlesTotalreq ->rowcount();
$pagestotals=ceil($articleTotal/$articlesParPage);

if(isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $pagestotals)
	{
		$_GET['page'] = intval($_GET['page']);
		$pagecourante = $_GET['page'];
	}
	else{ $pagecourante= 1; }

		$depart = ($pagecourante-1)*$articlesParPage;
        $news=$db->query("SELECT * from ngarticle where confirme = 1 order by date_pub desc limit ".$depart.",".$articlesParPage);
?>
<center>
    <nav aria-label="Page navigation  pagination-sm ">
        <ul class="pagination pagination-sm">
            <?php for($i=1;$i<=$pagestotals;$i++){
                    if($i == $pagecourante){?>

                        <li class="active"><a><?php echo $i.' '; ?></a></li>

                <?php }else{ ?>

                    <li><a href="index.php?page=<?= $i ?>"><?php echo $i  ; ?></a></li>

                <?php }?>
            <?php }?>
        </ul>
    </nav>
</center>
