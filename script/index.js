var deconnexion = document.querySelector('.deconnexion');

function handleClick(e) {

  var xhr = new XMLHttpRequest(),
      method = "POST",
      url = "ajax.php";

  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      if (xhr.responseText === '1') {
        window.location.reload(true);
      };
    }
  };
  xhr.send('deco=1');
}

deconnexion.addEventListener('click', handleClick);
