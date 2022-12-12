/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function displayDropdown(postNumber) {
  document
    .getElementById(`dropdown-${postNumber}`)
    .classList.toggle("content-card__dropdown--show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
  if (!event.target.matches(".content-card__dropdown-button")) {
    var dropdowns = document.getElementsByClassName(
      "content-card__dropdown-content"
    );
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("content-card__dropdown--show")) {
        openDropdown.classList.remove("content-card__dropdown--show");
      }
    }
  }
};
