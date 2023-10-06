document.addEventListener("DOMContentLoaded", function () {
  const loadingIcon = document.getElementById("loading-icon");

  window.addEventListener("beforeunload", function () {
      loadingIcon.style.display = "block";
  });

  setTimeout(function () {
      loadingIcon.style.display = "none";
  }, 2000);
  });