<?php
session_start();
$links=array(
 'https://www.01net.com/rss/info/flux-rss/flux-toutes-les-actualites/',
 'https://www.01net.com/rss/actualites/technos/',
 'https://www.01net.com/rss/actualites/buzz-societe/',
 'https://www.01net.com/rss/jeux-video/',
 'https://www.01net.com/rss/actualites/politique-droits/',
);
//affichage de base
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['actu'])) {
  $feeds=$links[0];
  $_SESSION["feed"] = $feeds;
  allItems(); 
  header('Location:index.php');
  exit;
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['techno'])) {
  $feeds = $links[1];
  $_SESSION["feed"] = $feeds; 
  allItems();
  header('Location:index.php');
  exit;
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['buzz'])) {
  $feeds=$links[2];
  $_SESSION["feed"] = $feeds; 
  allItems();
  header('Location:index.php');
  exit;
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['jeux'])) {
  $feeds=$links[3];
  $_SESSION["feed"] = $feeds; 
  allItems();
  header('Location:index.php');
  exit;
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['politics'])) {
  $feeds=$links[4];
  $_SESSION["feed"] = $feeds;
  allItems();
  header('Location:index.php');
  exit;
}
//affichage 5 items
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['fiveItems'])){
  fiveitems();
  header('Location:index.php');
}
//affichage 10 items
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['tenItems'])) {
  tenitems();
  header('Location:index.php');
}
//affichage toutes les items
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['unlItems'])) {
  allItems();
  header('Location:index.php');
}
//Fonction pour afficher 5 items du feed
function fiveitems()
{
  $feed=$_SESSION["feed"];
  $content = simplexml_load_file($feed);
  $i = 0;
  foreach ($content->channel->item as $item) {
    $title = $item->title;
    setcookie("title", $title, time()+3600); 
    $image = $item->enclosure['url'];
    setcookie("image", $image, time()+3600); 
    $url = $item->link;
    setcookie("url", $url, time()+3600); 
    $PubDate = $item->pubDate;
    setcookie("pubdate", $PubDate, time()+3600); 
    $desc = $item->description;
    setcookie("desc", $desc, time()+3600);
    $max_length=45;
    $smalldesc=substr($desc, 0, $max_length );
    setcookie("smalldesc", $smalldesc, time()+3600);
    if ($i < 5) {
      echo $title . "<br>";
      echo $image . "<br>";
      echo $url . "<br>";
      echo $PubDate . "<br>";
      echo $desc . "<br>";
    }
    $i++;
  }
}
//fonction pour afficher 10 items du feed
function tenitems()
{
  $feed=$_SESSION["feed"];
  $content = simplexml_load_file($feed);
  $i = 0;
  foreach ($content->channel->item as $item) {
    $title = $item->title;
    setcookie("title", $title, time()+3600); 
    $image = $item->enclosure['url'];
    setcookie("image", $image, time()+3600); 
    $url = $item->link;
    setcookie("url", $url, time()+3600); 
    $PubDate = $item->pubDate;
    setcookie("pubdate", $PubDate, time()+3600); 
    $desc = $item->description;
    setcookie("desc", $desc, time()+3600);
    $max_length=45;
    $smalldesc=substr($desc, 0, $max_length );
    setcookie("smalldesc", $smalldesc, time()+3600);
    if ($i < 10) {
      echo $title . "<br>";
      echo $image . "<br>";
      echo $url . "<br>";
      echo $PubDate . "<br>";
      echo $desc . "<br>";
    }
    $i++;
  }
}
//fonction pour afficher toutes les items du feed
function allItems()
{
  $feed=$_SESSION["feed"];
  $content = simplexml_load_file($feed);
  foreach ($content->channel->item as $item) {
    $title = $item->title;
    setcookie("title", $title, time()+3600); 
    $image = $item->enclosure['url'];
    setcookie("image", $image, time()+3600); 
    $url = $item->link;
    setcookie("url", $url, time()+3600); 
    $PubDate = $item->pubDate;
    setcookie("pubdate", $PubDate, time()+3600); 
    $desc = strip_tags($item->description);
    setcookie("desc", $desc, time()+3600);
    $max_length=45;
    $smalldesc=substr($desc, 0, $max_length );
    setcookie("smalldesc", $smalldesc, time()+3600);
  }
}
?>
  <!-- Boutons premier feed
  <form action="index_controller.php" method="POST">
    <input type="submit" name="fiveItems" value="5 items" />
    <input type="submit" name="tenItems" value="10 items" />
    <input type="submit" name="unlItems" value="Toutes les Items" />
  </form> -->
 <!-- Boutons choix de feed
</body>
</html> -->