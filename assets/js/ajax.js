/// attendre que le contenu soit chargéwait for content
addEventListener("DOMContentLoaded", () => {
  const formulaire = document.querySelector(".form-categories");
  const categoriesSelect = document.querySelector("#categories-select");
  const formatsSelect = document.querySelector("#formats-select");
  const triDateSelect = document.querySelector("#tri-date-select");

  categoriesSelect.addEventListener("change", (e) => {
    handleSubmit(e);
  });

  formatsSelect.addEventListener("change", (e) => {
    handleSubmit(e);
  });

  triDateSelect.addEventListener("change", (e) => {
    handleSubmit(e);
  });

  /// handle form change
  function handleSubmit(e) {
    e.preventDefault();
    //debugger;
    console.log(e.target.value);
    sendData(categoriesSelect.value, formatsSelect.value, triDateSelect.value);
  }
});
// function handleSubmit(e) {
//   e.preventDefault();
//   const categorie = categoriesSelect.value;
//   const format = formatsSelect.value;
//   const triDate = triDateSelect.value;
//   sendData(categorie, format, triDate);
// }

function sendData(categorie, format, triDate) {
  const URL = document.querySelector(".form-categories").action; //recupere l'url de la form  admin_url( 'admin-ajax.php' );
  // debugger;
  // const URL = "http://localhost/motaphoto/";

  $.ajax({
    type: "POST",
    // url: URL + "wp-admin/admin-ajax.php",
    url: URL,
    data: {
      categorie,
      format,
      triDate,
      action: "filter",
    },
    success: function (response) {
      $(".filtre-container").html(response);
      console.log(response);
    },
    error: function () {
      alert("An error was encountered.");
    },
  });
  return false;
}
