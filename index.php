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
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">


</head>

<body>
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
            <a class="nav-link" name="actu" href="#">Tweeter feeds</a>
            <form action="index.php" method="POST">
              <input type="submit" name="actu" value="actualites" />
              <input type="submit" name="techno" value="Technologies" />
              <input type="submit" name="buzz" value="Buzz Société" />
              <input type="submit" name="jeux" value="Jeux Vidéos" />
              <input type="submit" name="politics" value="Politiques" />
            </form>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Newsletters</a>
          </li>

        </ul>
        <form class="d-flex my-3">
          <input class="form-control me-2 ml-1 case" type="search" placeholder="Rechercher sur le site" aria-label="Search">
          <button class="btn btn-outline-success button ms-3 me-3 " type="submit">Rechercher</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="d-flex justify-content-center mt-2">
    <img src="assets/img/title.png" class="animate__animated animate__bounce " id="f" />
  </div>
  <div class="row">
    <div class="col-sm-4 my-3">
      <div class="card cardstyle">
        <div class="card-body">
          <h5 class="card-title"><b><?= $_COOKIE["title"] ?></b></h5>
          <p class="card-title"><b><?= $_COOKIE["pubdate"] ?></b></p>
          <p class="card-text"><?= $_COOKIE["smalldesc"] . "..." ?></p>

          <button type="button" class="btn btn-rounded btn-md details" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            + de détails
          </button>

          <!-- Modal -->
          <div class="modal fade modalstyle" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel"><?= $_COOKIE["title"] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <p class="card-title mx-3"><b><?= $_COOKIE["pubdate"] ?></b></p>

                <div class="modal-body">
                  <?= $_COOKIE["desc"] ?>
                  <img class="img-fluid" src=<?= $_COOKIE["image"] ?> />
                  <a href=<?= $_COOKIE["url"] ?> class="btn btn-rounded btn-md d-flex justify-content-center btn3" target="_blank">Accéder à l'article</a>
                
                </div>
                <div class="modal-footer">
                  
                  <button type="button" class="btn btn-secondary retour" data-bs-dismiss="modal">Retour</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    </div>
  </div>
  <div class="row">
  <div class="col-sm-2">
    <div class="card cardstyle">
      <div class="card-body img-fluid actu">
      <a href="#" class="linksubject"><p class="card-title">Actualités</p></a>
      </div>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="card cardstyle">
      <div class="card-body techno">
      <a href="#" class="linksubject"><p class="card-title">Technologie</p></a>
      </div>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="card cardstyle">
      <div class="card-body img-fluid societe">
      <a href="#" class="linksubject"><p class="card-title">Buzz & Société</p></a>
      </div>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="card cardstyle">
      <div class="card-body img-fluid jeux">
      <a href="#" class="linksubject"><p class="card-title">Jeux</p></a>
      </div>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="card cardstyle">
      <div class="card-body img-fluid politique">
        <a href="#" class="linksubject" type="btn"><p class="card-title">Politique et Droits</p></a>
      </div>
    </div>
  </div>
  
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

<footer>
  <a href="mentions.html" class="mentions text-white">Mentions Légales</a>
</footer>

</html>