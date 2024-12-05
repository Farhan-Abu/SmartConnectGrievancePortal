document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("myForm");
  const textarea = document.getElementById("details");
  const charCountDisplay = document.getElementById("characterCount");
  const maxChars = 200;

  // Update character count on input
  textarea.addEventListener("input", () => {
    charCountDisplay.textContent = `${textarea.value.length}/${maxChars} characters`;
  });

  form.addEventListener("submit", (event) => {
    event.preventDefault(); // Prevent default form submission

    // Optional: Add form validation or other actions here

    form.reset(); // Clear form fields
    charCountDisplay.textContent = `0/${maxChars} characters`; // Reset character count
  });
});

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
