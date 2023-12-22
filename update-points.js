document.getElementById("ejecutarFuncion").addEventListener("click", function() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/points-request.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            
        }
    };
    xhr.send();
    document.getElementById("save-config").click();
});