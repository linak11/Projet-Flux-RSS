<?php
session_start();
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


</head>

<body class="container-fluid">
  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }

    function myFunction() {
      var element = document.body;
      element.classList.toggle("dark-mode");
    }

    function retheme() {
      var cc = document.body.className;
      if (cc.indexOf("darktheme") > -1) {
        document.body.className = cc.replace("darktheme", "");
        if (opener) {
          opener.document.body.className = cc.replace("darktheme", "");
        }
        localStorage.setItem("preferredmode", "light");
      } else {
        document.body.className += " darktheme";
        if (opener) {
          opener.document.body.className += " darktheme";
        }
        localStorage.setItem("preferredmode", "dark");
      }
    }
    (
      function setThemeMode() {
        var x = localStorage.getItem("preferredmode");
        if (x == "dark") {
          document.body.className += " darktheme";
        }
      })();
  </script>
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="assets/img/logo.png" alt="Logo du site"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Accueil</a>
          </li>
          <li class="nav-item">
            <form action="index.php" class="nav-link" method="POST">
              <input type="submit" class="cardstyle" name="actu" value="actualites" />
              <input type="submit" class="cardstyle" name="techno" value="Technologies" />
              <input type="submit" class="cardstyle" name="buzz" value="Buzz Société" />
              <input type="submit" class="cardstyle" name="jeux" value="Jeux Vidéos" />
              <input type="submit" class="cardstyle" name="politics" value="Politiques" />
            </form>
          </li>

        </ul>
        <form class="d-flex my-3">
          <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; options</span>
        </form>
      </div>
    </div>
    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <form action="index.php" method="POST">
        <select name="numb" id="numb">
          <option value="10">10</option>
          <option value="5">5</option>
          <option value="all">all</option>
        </select>
        <input type="submit" name="reload" value="Valider" />
      </form>
        <a class='fa fa-adjust' href='javascript:void(0);' onclick='retheme()' title='Change Theme'>Mode Nuit</a>
      <a href="#">Thème Jour 2</a>
      <a href="#">Thème Nuit</a>
    </div>
    <!-- actualites -->
  </nav>

  <div class="d-flex justify-content-center mt-2">
    <img src="assets/img/title.png" class="animate__animated animate__bounce " id="f" />
  </div>
  <div class="row">
    <div class="col-sm-2"></div>
    <!-- affichage cards de base -->
    <?php
    if (!isset($_COOKIE['feed'])) {
      $feed = 'https://www.01net.com/rss/info/flux-rss/flux-toutes-les-actualites/';
      $rss = simplexml_load_file($feed);
      foreach ($rss->channel->item as $item) {
    ?>
        <div id="newscard" class="card cardstyle">
          <div class="card-body">
            <h5 class="card-title"><b><?= $item->title ?></b></h5>
            <p class="card-title"><b><?= $item->pubDate ?></b></p>
            <p class="card-text"><?= strip_tags($item->description) ?></p>

            <button type="button" class="btn btn-rounded btn-md details" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              + de détails
            </button>

            <!-- Modal -->
            <div class="modal fade modalstyle" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><?= $item->title ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <p class="card-title mx-3"><b><?= $item->pubDate ?></b></p>

                  <div class="modal-body">
                    <?= strip_tags(strip_tags($item->description)) ?>
                    <img class="img-fluid" src=<?= $item->enclosure['url'] ?> />
                    <a href=<?= $item->link ?> class="btn btn-rounded btn-md d-flex justify-content-center btn3" target="_blank">Accéder à l'article</a>

                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn btn-secondary retour" data-bs-dismiss="modal">Retour</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php }
    } ?>
    <!-- affichage 5 cards -->
    <?php
    if (isset($_POST['numb'])) {
      setcookie('numb', $_POST['numb'], time() + 3600);
    }
    if ($_COOKIE['numb'] == "5") {
      $NUMITEMS = 5;
      $count = 0;
      foreach ($rss->channel->item as $item) {
    ?>
        <div id="newscard" class="card cardstyle">
          <div class="card-body">
            <h5 class="card-title"><b><?= $item->title ?></b></h5>
            <p class="card-title"><b><?= $item->pubDate ?></b></p>
            <p class="card-text"><?= strip_tags($item->description) ?></p>

            <button type="button" class="btn btn-rounded btn-md details" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              + de détails
            </button>

            <!-- Modal -->
            <div class="modal fade modalstyle" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><?= $item->title ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <p class="card-title mx-3"><b><?= $item->pubDate ?></b></p>

                  <div class="modal-body">
                    <?= strip_tags(strip_tags($item->description)) ?>
                    <img class="img-fluid" src=<?= $item->enclosure['url'] ?> />
                    <a href=<?= $item->link ?> class="btn btn-rounded btn-md d-flex justify-content-center btn3" target="_blank">Accéder à l'article</a>

                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn btn-secondary retour" data-bs-dismiss="modal">Retour</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php if (++$count >= $NUMITEMS) break;
      }
    } ?>
    <!-- affichage 10 cards -->
    <?php
    if (isset($_POST['numb'])) {
      setcookie('numb', $_POST['numb'], time() + 3600);
    }
    if ($_COOKIE['numb'] == "10") {
      $NUMITEMS = 10;
      $count = 0;
      foreach ($rss->channel->item as $item) {
    ?>
        <div id="newscard" class="card cardstyle">
          <div class="card-body">
            <h5 class="card-title"><b><?= $item->title ?></b></h5>
            <p class="card-title"><b><?= $item->pubDate ?></b></p>
            <p class="card-text"><?= strip_tags($item->description) ?></p>

            <button type="button" class="btn btn-rounded btn-md details" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              + de détails
            </button>

            <!-- Modal -->
            <div class="modal fade modalstyle" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><?= $item->title ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <p class="card-title mx-3"><b><?= $item->pubDate ?></b></p>

                  <div class="modal-body">
                    <?= strip_tags(strip_tags($item->description)) ?>
                    <img class="img-fluid" src=<?= $item->enclosure['url'] ?> />
                    <a href=<?= $item->link ?> class="btn btn-rounded btn-md d-flex justify-content-center btn3" target="_blank">Accéder à l'article</a>

                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn btn-secondary retour" data-bs-dismiss="modal">Retour</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php if (++$count >= $NUMITEMS) break;
      }
    } ?>
    <!-- affichage all cards-->
    <?php
    if (isset($_POST['numb'])) {
      setcookie('numb', $_POST['numb'], time() + 3600);
    }
    if ($_COOKIE['numb'] == "all") {
      foreach ($rss->channel->item as $item) {
    ?>
        <div id="newscard" class="card cardstyle">
          <div class="card-body">
            <h5 class="card-title"><b><?= $item->title ?></b></h5>
            <p class="card-title"><b><?= $item->pubDate ?></b></p>
            <p class="card-text"><?= strip_tags($item->description) ?></p>

            <button type="button" class="btn btn-rounded btn-md details" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              + de détails
            </button>

            <!-- Modal -->
            <div class="modal fade modalstyle" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><?= $item->title ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <p class="card-title mx-3"><b><?= $item->pubDate ?></b></p>

                  <div class="modal-body">
                    <?= strip_tags(strip_tags($item->description)) ?>
                    <img class="img-fluid" src=<?= $item->enclosure['url'] ?> />
                    <a href=<?= $item->link ?> class="btn btn-rounded btn-md d-flex justify-content-center btn3" target="_blank">Accéder à l'article</a>

                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn btn-secondary retour" data-bs-dismiss="modal">Retour</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php }
    } ?>

    <footer>
      <a href="mentions.html" class="mentions text-white">Mentions Légales</a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>



</html>