<!-- carousel -->
<div class="ng-alert ng-panel panel panel-primary">

        <div class="ng-panel panel-heading " role="tab" id="headingOne1">
            <span class="glyphicon glyphicon-phone"></span>  CONTACTS
        </div>
    <div class="panel-body">
        <small>facebook: <a href="https://www.facebook.com/bernard.ngandu.5" target="blank">Bernard Ng</a></small><br>
        <small>whatsapp: +243973141132</small><br>
        <small>insta: <a href="https://www.instagram.com/ngpictures_23/?hl=fr"  target="blank"> Ngpictures_23</a></small><br>
        <small><a href="mailto:ngandubernard@gmail.com"  target="blank">ngandubernard@gmail.com</a></small><br>
    </div>

    <ul class="list-group hidden-xs">
        <li class="list-group-item ng-panel-img">
            <div id="myCarousel" class="carousel" data-ride="carousel">
                <div class="carousel-inner" role="listbox">

                        <div class="item active">
                            <img class="img img-responsive" src="pages/article/miniature/rien.jpg"/>
                        </div>

                        <?php $photo = $db ->query("SELECT id from nggalerie order by date_pub desc limit 0,5");
                            while($p = $photo->fetch()){?>

                                <div class="item">
                                <img class="img img-responsive" src="pages/galerie/ngimages/640-640/<?= getBlogPicturesThumb($p['id']); ?>"/>
                                </div>

                        <?php }?>
                </div>
            </div>
        </li>
    </ul>
<!-- /carousel -->
