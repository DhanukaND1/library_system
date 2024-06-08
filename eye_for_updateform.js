
  document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById("showpass").addEventListener("click", function() {
      const passwordInput = document.getElementById("pass");
      passwordInput.type = "text";
      document.getElementById("hidepass").style.display = "block";
      document.getElementById("showpass").style.display = "none";
    });

    document.getElementById("hidepass").addEventListener("click", function() {
      const passwordInput = document.getElementById("pass");
      passwordInput.type = "password";
      document.getElementById("hidepass").style.display = "none";
      document.getElementById("showpass").style.display = "block";
    });
  });