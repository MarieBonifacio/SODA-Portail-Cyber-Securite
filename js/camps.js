window.addEventListener('load', function () {
  var urlList = myScriptDir.theme_directory;
  // var home_url = myScript.theme_directory;
  var xmlhttpList = new XMLHttpRequest();
  xmlhttpList.onreadystatechange = function () {
  if(this.readyState == 4 && this.status == 200)
  {
    var myArray = JSON.parse(this.responseText);
    console.log(myArray);
  }
  };
  // url a trouver
  xmlhttpList.open("GET", urlList  + '/app/list_campaign.php', true);
  xmlhttpList.send();
});