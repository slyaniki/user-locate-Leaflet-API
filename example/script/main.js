let form = $("#form");
let btn = $(".btn-success");
let infos = {};
let user = getCookie("mail");

window.onload = () => {
  if (user != "") {
    watchPosition();
  }
  getLocation();
};

form.submit((e) => {
  e.preventDefault();
  btn.html("Chargement...");
  btn[0].style.opacity = "0.4";
  let datas = form[0].getElementsByTagName("input");
  infos.nom = datas["nom"].value;
  infos.email = datas["email"].value;
  infos.password = datas["password"].value;
  EnvoiForm(infos);
});

function EnvoiForm(datas) {
  let url = "traitement.php";
  $.ajax({
    type: "POST",
    data: datas,
    url: url,
    success: function (data) {
      let result = JSON.parse(data);
      btn.html("INSCRIPTION");
      btn[0].style.opacity = "1";
      if (result.success) {
        form[0].style.display = "none";
        $(".alert-success").html(result.message);
        $(".alert-danger").html("");
        setCookie("mail", infos.email, 365);
      } else {
        $(".alert-danger").html(result.message);
      }
    },
    error: function (err) {
      console.log(err);
    },
  });
}

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(getPosition, errorPosition);
  } else {
    console.log("Geolocation is not supported by this browser.");
  }
}

function watchPosition() {
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(updatePosition, errorPosition);
  } else {
    console.log("Geolocation is not supported by this browser.");
  }
}

function getPosition(position) {
  infos.lat = position.coords.latitude;
  infos.long = position.coords.longitude;
}

function updatePosition(position) {
  let datas = {
    mail: user,
    lat: position.coords.latitude,
    long: position.coords.longitude
  };
  let url = "update.php";
  $.ajax({
    type: "POST",
    data: datas,
    url: url,
    success: function (data) {
      console.log(JSON.parse(data));
    },
    error: function (err) {
      console.log(err);
    },
  });
}

function errorPosition(err) {
  if (err.message === "User denied Geolocation") {
    btn[0].disabled = true;
    btn[0].title =
      "Veuillez Activer la location avant de faire une inscription";
    $(".alert-danger").html(
      `Veuillez Activer la location avant de faire une inscription <a href="form.php"> clique-ici</a>`
    );
  }
}


function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}