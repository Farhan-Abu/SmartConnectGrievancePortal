function toggleDropdown() {
  document.getElementById("dropdownContent").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
  if (
    !event.target.matches(".profile-icon") &&
    !event.target.closest(".dropdown-content")
  ) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};

function toggleDropdown() {
  var dropdownContent = document.getElementById("dropdownContent");
  dropdownContent.style.display =
    dropdownContent.style.display === "block" ? "none" : "block";
}

function toggleTracker(grievanceId) {
  const trackerRow = document.getElementById(`tracker-${grievanceId}`);
  if (trackerRow.style.display === "none") {
    trackerRow.style.display = "table-row"; // Show the tracker
  } else {
    trackerRow.style.display = "none"; // Hide the tracker
  }
}
