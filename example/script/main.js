let form = $("#form");
let btn = $(".btn-success");
let infos = {};

window.onload = () => {
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
      console.log(result);
      btn.html("INSCRIPTION");
      btn[0].style.opacity = "1";
      if (result.success) {
        form[0].style.display = "none";
        $(".alert-success").html(result.message);
        $(".alert-danger").html("");
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
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function getPosition(position) {
  infos.lat = position.coords.latitude;
  infos.long = position.coords.longitude;
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
