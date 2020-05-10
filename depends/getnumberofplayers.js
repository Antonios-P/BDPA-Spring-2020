function ajaxcall() { 
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
        json_object = JSON.parse(xhttp.responseText)
        var numberofplayers = json_object.count
        /// set this numberofplayers variable in element where you want to display numberofplayers
    }
    };
    xhttp.open("POST", "getplayers.php", true);
    xhttp.send();
    setTimeout(ajaxcall, 3000) // 3 seconds for debugging reasons. Will be one second or less in release
  }

ajaxcall() //calls the function that gets the number of players