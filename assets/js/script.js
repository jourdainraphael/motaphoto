// Item Contact du nav menu
const menuItemContact = document.querySelector("#menu-item-70");

// wait for content
addEventListener("DOMContentLoaded", (event) => {
  const modalForm = document.getElementById("contactModal");

  menuItemContact.addEventListener("click", function () {
    modalForm.style.display = "block";
  });

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modalForm) {
      modalForm.style.display = "none";
      
    }
  };
});
