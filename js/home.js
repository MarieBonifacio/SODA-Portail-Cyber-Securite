window.addEventListener('load', function () {
  var url = myScript.theme_directory;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
  if(this.readyState == 4 && this.status == 200)
  {
    console.log("ok");
  }
  else
  {
    console.log('pas ok')
  }
  };

  // url a trouver
  xmlhttp.open("GET", url  + '/dashboard_back.php', true);
  xmlhttp.send();
});