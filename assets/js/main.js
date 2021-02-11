function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }

  function retheme() {
var cc = document.body.className;
if (cc.indexOf("darktheme") > -1) {
  document.body.className = cc.replace("darktheme", "");
  if (opener) {opener.document.body.className = cc.replace("darktheme", "");}
  localStorage.setItem("preferredmode", "light");
} else {
  document.body.className += " darktheme";
  if (opener) {opener.document.body.className += " darktheme";}
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