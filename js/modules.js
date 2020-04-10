console.log("coucou bite");
var url = myScript.theme_directory;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function () {
if(this.readyState == 4 && this.status == 200)
{
  var myArray = JSON.parse(this.responseText);
  console.log(myArray);
}
else
{
  console.log("not good")
}
};

// url a trouver
xmlhttp.open("GET", url  + '/menu_modules.php', true);
xmlhttp.send();