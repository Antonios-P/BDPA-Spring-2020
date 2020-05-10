function ajaxcall() { 
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
        json_object = JSON.parse(xhttp.responseText)
        var numberofplayers = json_object.count
        /// set this numberofplayers variable in element where you want to display numberofplayers
    }
    };
    xhttp.open("POST", "/depends/lobby.php", true);
    xhttp.send();
    setTimeout(ajaxcall, 1000)
  }

ajaxcall() //calls the function that gets the number of players