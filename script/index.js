var deconnexion = document.querySelector('.deconnexion');

function handleClick(e) {
  console.log(e);

  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
    xmlhttp.open('POST', 'index.php', true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("deconnexion=true");
  }
}

deconnexion.addEventListener('click', handleClick);