<!--messages d'erreur-->
    <?php if(isset($msg)) {?>

        <div class="alert <?php echo $type ?>" id ="flash">
            <?php echo "<span class='glyphicon glyphicon-info-sign'></span>   ".$msg; ?>
        </div>

    <?php }?>
    <?php if(isset($_SESSION['msg'])) {?>

        <div class="alert <?php echo $_SESSION['type']?>" id ="flash">    
            <?php echo "<span class='glyphicon glyphicon-info-sign'></span>   ".$_SESSION['msg']; ?>
            <?php unset($_SESSION['msg']);?>
            <?php unset($_SESSION['type']);?>
        </div>
        
    <?php }?>
<!-- / messages d'erreur -->
