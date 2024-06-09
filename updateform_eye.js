    document.getElementById("showpass1").addEventListener("click", function() {
        const passwordInput = document.getElementById("password");
        passwordInput.type = "text";
        document.getElementById("hidepass1").style.display = "block";
        document.getElementById("showpass1").style.display = "none";
      });
  
      document.getElementById("hidepass1").addEventListener("click", function() {
        const passwordInput = document.getElementById("password");
        passwordInput.type = "password";
        document.getElementById("hidepass1").style.display = "none";
        document.getElementById("showpass1").style.display = "block";
      });
    