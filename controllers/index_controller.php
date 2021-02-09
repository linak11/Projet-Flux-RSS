<?php
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
  setcookie("feed", $feeds, time()+3600); 
  allItems();
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['techno'])) {
  $feeds = $links[1];
  setcookie("feed", $feeds, time()+3600); 
  allItems();}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['buzz'])) {
  $feeds=$links[2];
  setcookie("feed", $feeds, time()+3600); 
  allItems();
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['jeux'])) {
  $feeds=$links[3];
  setcookie("feed", $feeds, time()+3600); 
  allItems();
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['politics'])) {
  $feeds=$links[4];
  setcookie("feed", $feeds, time()+3600); 
  allItems();
}
//affichage 5 items
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['fiveItems'])){
  fiveitems();
}
//affichage 10 items
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['tenItems'])) {
  tenitems();
}
//affichage toutes les items
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['unlItems'])) {
  allItems();
}
//Fonction pour afficher 5 items du feed
function fiveitems()
{
  $feed=$_COOKIE["feed"];
  $content = simplexml_load_file($feed);
  $i = 0;
  foreach ($content->channel->item as $item) {
    $title = $item->title;
    $image = $item->enclosure['url'];
    $url = $item->link;
    $PubDate = $item->pubDate;
    $desc = $item->description;
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
  $feed=$_COOKIE["feed"];
  $content = simplexml_load_file($feed);
  $i = 0;
  foreach ($content->channel->item as $item) {
    $title = $item->title;
    $image = $item->enclosure['url'];
    $url = $item->link;
    $PubDate = $item->pubDate;
    $desc = $item->description;
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
  $feed=$_COOKIE["feed"];
  $content = simplexml_load_file($feed);
  foreach ($content->channel->item as $item) {
    $title = $item->title;
    setcookie("title", $title, time()+3600); 
    $image = $item->enclosure['url'];
    $url = $item->link;
    $PubDate = $item->pubDate;
    $desc = $item->description;
    echo $title . "<br>";
    echo $image . "<br>";
    echo $url . "<br>";
    echo $PubDate . "<br>";
    echo $desc . "<br>";
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
  <form action="index_controller.php" method="POST">
    <input type="submit" name="actu" value="Actualités"  />
    <input type="submit" name="techno" value="Technologies"  />
    <input type="submit" name="buzz" value="Buzz Société"  />
    <input type="submit" name="jeux" value="Jeux Vidéos"  />
    <input type="submit" name="politics" value="Politiques" />
  </form>
</body>
</html> -->