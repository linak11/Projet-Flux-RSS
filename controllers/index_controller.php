<?php
session_start();
$links = array(
  'https://www.01net.com/rss/info/flux-rss/flux-toutes-les-actualites/',
  'https://www.01net.com/rss/actualites/technos/',
  'https://www.01net.com/rss/actualites/buzz-societe/',
  'https://www.01net.com/rss/jeux-video/',
  'https://www.01net.com/rss/actualites/politique-droits/',
);
$feed = 'https://www.01net.com/rss/info/flux-rss/flux-toutes-les-actualites/';
setcookie('feed', $feed, time() + 3600);
//affichage de base
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['actu'])) {
  $feed = $links[0];
  // $_SESSION["feed"] = $feed;
  setcookie('feed', $feed, time() + 3600);
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['techno'])) {
  $feed = $links[1];
  // $_SESSION["feed"] = $feed;
  setcookie('feed', $feed, time() + 3600);
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['buzz'])) {
  $feed = $links[2];
  // $_SESSION["feed"] = $feed;
  setcookie('feed', $feed, time() + 3600);
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['jeux'])) {
  $feed = $links[3];
  // $_SESSION["feed"] = $feed;
  setcookie('feed', $feed, time() + 3600);
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['politics'])) {
  $feed = $links[4];
  // $_SESSION["feed"] = $feed;
  setcookie('feed', $feed, time() + 3600);
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['reload'])) {
 header('Location:index.php');
}
$i = 0; // counter
$url = $_COOKIE['feed']; // url to parse
$rss = simplexml_load_file($url);
$numb = count($rss->channel->item); // XML parser
if (isset($_POST['five'])){
  $numb=5;
}
else if (isset($_POST['ten'])){
  $numb=10;
}
else{
  $numb = count($rss->channel->item);
}

// // RSS items loop
// foreach ($rss->channel->item as $item) {
//   if ($i < 10) { // parse only 10 items
//     print '<a href="' . $item->link . '">' . $item->title . '</a><br />';
//   }
//   $i++;
// }

//fonction pour afficher toutes les items du feed
// function allItems()
// {
//   $feed=$_SESSION["feed"];
//   $content = simplexml_load_file($feed);
//   foreach ($content->channel->item as $item) {
//     $title = $item->title;
//     setcookie("title", $title, time()+3600); 
//     $image = $item->enclosure['url'];
//     setcookie("image", $image, time()+3600); 
//     $url = $item->link;
//     setcookie("url", $url, time()+3600); 
//     $PubDate = $item->pubDate;
//     setcookie("pubdate", $PubDate, time()+3600); 
//     $desc = strip_tags($item->description);
//     setcookie("desc", $desc, time()+3600);
//     $max_length=45;
//     $smalldesc=substr($desc, 0, $max_length );
//     setcookie("smalldesc", $smalldesc, time()+3600);
//   }
// }
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