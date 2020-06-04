let form = $("#form");
let infos = {};

window.onload = () => {
  getLocation();
};

form.submit((e) => {
  e.preventDefault();
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
    navigator.geolocation.getCurrentPosition(getPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function getPosition(position) {
  infos.lat = position.coords.latitude;
  infos.long = position.coords.longitude;
}
