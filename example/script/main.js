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
      if (result.success) {
        form[0].style.display = "none";
        $(".alert-success").html("Message envoyé avec success");
      } else {
        $(".alert-danger").html(result.errors);
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
