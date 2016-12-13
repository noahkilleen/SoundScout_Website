function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("prof").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "pearson_profile.txt", true);
  xhttp.send();
}