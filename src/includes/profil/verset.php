<!-- verset biblique du jour -->
<?php

    $id = mt_rand(1,500);
    $verset = $db->query('SELECT * from verset');
    $nb = $verset->rowcount();
    $vbj = $db->prepare("SELECT * from verset  where id = ? ");
    $vbj ->execute(array($id));
    $V = $vbj->fetch()

?>
<div class="modal fade verset" tabindex="-1" role="dialog" aria-labelle$dby="mySmallModalLabel">
     <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Verset Biblique</h4>
            </div>

            <div class="modal-body">
                <?php if($vbj->rowcount() == 0){ echo "aucun verset... <br><br> <b>Actualisez la page</b>"; }?>
                <p><?= $V['contenu'] ?></p>
                <br><br>
                <b><?= $V['ref'] ?></b>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<div class="col-xs-12">
    <div class="row">
        <ul class="nav nav-tabs ng-margin-default">
            <li role="presentation">
                <a  data-toggle="modal" data-target=".verset">
                    <span class="glyphicon glyphicon-book" aria-hidden="true"></span> GOD FRIST
                </a>
            </li>

            <?php if(isset($_SESSION['id']) and !empty($_SESSION['id'])){ ?>

            <li role="presentation">
                <a  data-toggle="modal" data-target=".bs-example-modal-sm">
                    <span class="glyphicon glyphicon-record" aria-hidden="true"></span>
                    <?= check_user_online($userInfo['id']) ?>
                </a>
            </li>

            <?php }?>
        </ul>
    </div>
</div>
<!-- /verset biblique du jour -->
