window.addEventListener('load', function () {
  var url = myScript.theme_directory;
  var home_url = myScript.home_url;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if(this.readyState == 4 && this.status == 200)
    {
      var myArray = JSON.parse(this.responseText);
      console.log(myArray);
    }
  }
  xmlhttp.open("GET", url  + '/statistics.php', true);
  xmlhttp.send();
});