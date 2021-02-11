<?php
require "controllers/index_controller.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FIDZ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body class="container-fluid m-0 p-0">
  <nav class="navbar navbar-expand-lg sticky-top container-fluid">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" alt="Logo du site"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <form action="index.php" class="nav-link" method="POST">
              <input type="submit" class="btn btn-rounded btn-md details" name="actu" value="Actualites" />
              <input type="submit" class="btn btn-rounded btn-md details" name="techno" value="Technologies" />
              <input type="submit" class="btn btn-rounded btn-md details" name="buzz" value="Buzz Société" />
              <input type="submit" class="btn btn-rounded btn-md details" name="jeux" value="Jeux Vidéos" />
              <input type="submit" class="btn btn-rounded btn-md details" name="politics" value="Politiques" />
            </form>
          </li>

        </ul>
        <div class="social-menu d-flex">
          <ul>
            <li><a href=""><i class="fa fa-facebook"></i></a></li>
            <li><a href=""><i class="fa fa-twitter"></i></a></li>
            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
        <form class="d-flex my-3">
          <span style="font-size:30px;cursor:pointer" onclick="openNav()"><img class="img-fluid settings" src="assets/img/settings.png" /></span>
        </form>

      </div>
      <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <form action="index.php" method="POST">
          <label class="d-flex justify-content-center"><b>Nombre d'articles à afficher</b></label><br>
          <div class="d-flex justify-content-center">
            <input class="mx-2 btn btn-rounded btn-md details" type="submit" id="five" name="five" value="5" />
            <input class="mx-2 btn btn-rounded btn-md details" type="submit" id="ten" name="ten" value="10" />
            <input class="mx-2 btn btn-rounded btn-md details" type="submit" id="all" name="all" value="Tout" />
          </div>
        </form>

        <span>
          <a href='javascript:void(0);' onclick='retheme()'>Switch Jour/Nuit</a>
        </span>
      </div>
      <!-- actualites -->
  </nav>
  <div class="header d-flex align-items-center">  
  <div class="d-grid gap-2 col-3 mx-auto">
    
  <a href="#article"><button class="btn bienvenue text-white" type="button">BIENVENUE</button></a>
</div>
</div>
  <div class="d-flex align-items-center justify-content-center mt-2">
    <img id="article"src="assets/img/title.png" class="animate__animated animate__bounce " id="f" />
  </div>
  <div class="d-flex justify-content-center row p-0 g-0">
    <!-- affichage cards de base -->
    <?php
    if (!isset($_SESSION['feed'])) {
      $feed = 'https://www.01net.com/rss/info/flux-rss/flux-toutes-les-actualites/';
      $rss = simplexml_load_file($feed);
    }
    $i = 0;
    while ($i < $numb) {
    ?>
      <div class="col-sm-7 my-3 mx-3">
        <div id="newscard" class="card cardstyle">
          <div class="card-body">
            <h5 class="card-title"><b><?= $rss->channel->item[$i]->title ?></b></h5>
            <p class="card-title"><b><?= $rss->channel->item[$i]->pubDate ?></b></p>
            <p class="card-text"><?= strip_tags($rss->channel->item[$i]->description) ?></p>

            <button type="button" class="btn btn-rounded btn-md details" data-bs-toggle="modal" data-bs-target="#staticBackdrop-<?= $i ?>">
              + de détails
            </button>

            <!-- Modal -->
            <div class="modal fade modalstyle" id="staticBackdrop-<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><?= $rss->channel->item[$i]->title ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <p class="card-title mx-3"><b><?= $rss->channel->item[$i]->pubDate ?></b></p>

                  <div class="modal-body">
                    <?= strip_tags(strip_tags($rss->channel->item[$i]->description)) ?>
                    <img class="img-fluid" src=<?= $rss->channel->item[$i]->enclosure['url'] ?> />
                    <a href=<?= $rss->channel->item[$i]->link ?> class="btn btn-rounded btn-md d-flex justify-content-center btn3" target="_blank">Accéder à l'article</a>

                  </div>
                  <div class="modal-footer">
   <div class="container">              
  <div class="row align-items-start">
      <div class="col">
      <h4>Partagez cet article</h3>
<!-- Facebook -->
       <a target="_blank" title="Facebook" href="https://www.facebook.com/sharer.php?u=https://tontonduweb.com/previews-warc/genieCivil/article1.html" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');return false;"><img src="/assets/img/iconrs/facebook_icon.png" alt="Facebook" /></a>
<!-- //Facebook -->
 
<!-- Twitter -->
        <a target="_blank" title="Twitter" href="https://twitter.com/share?url=https://bit.ly/2sI7H3v" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=700');return false;"><img src="/assets/img/iconrs/twitter_icon.png" alt="Twitter" /></a>
<!-- //Twitter -->
 
<!-- Google + -->
        <a target="_blank" title="Google +" href="https://plus.google.com/share?url=https://tontonduweb.com/previews-warc/genieCivil/article1.html" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=450,width=650');return false;"><img src="/assets/img/iconrs/gplus_icon.png" alt="Google Plus" /></a>
<!-- //Google + -->
 
<!-- Linkedin -->
        <a target="_blank" title="Linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://tontonduweb.com/previews-warc/genieCivil/article1.html" rel="nofollow" onclick="javascript:window.open(this.href, '','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=450,width=650');return false;"><img src="/assets/img/iconrs/linkedin_icon.png" alt="Linkedin" /></a>
<!-- //Linkedin -->
 
<!-- Email -->
        <a target="_blank" title="Envoyer par mail" href="mailto:?Subject=Regarde ça c'est cool !&amp;Body=regarde%20cet%20article%20c'est%20super !%20 https://tontonduweb.com/previews-warc/genieCivil/article1.html" rel="nofollow"><img src="/assets/img/iconrs/email_icon.png" alt="email" /></a>
<!-- //Email -->
</div>    
</div>
    </div>


                    <button type="button" class="btn btn-secondary retour" data-bs-dismiss="modal">Retour</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php $i++;
    }
    ?>
    <!-- Footer -->
<footer class="text-center text-lg-start">
  <!-- Grid container -->
  <div class="d-flex align-items-center justify-content-center mt-2">
    <img src="assets/img/title.png"/>
  </div>
  <div class="container p-4">
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
        
        <h5 class="text-uppercase text-white">Contact</h5>

        <p class="text-white">
          02.35.42.22.22
          contactfidz@gmail.com
        </p>
      </div>
    
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-3 col-md-7 mb-4 mb-md-0">
       

        <ul class="list-unstyled mb-0">
          <li>
            <a href="mentions.html" class="text-white mentions">Mentions Légales</a>
          </li>
         
        </ul>
      </div>
      <!--Grid column-->

     
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3 text-white" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2021 Copyright:
    <a class="text-white" href="index.php">www.fidz.com</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
</body>



</html>