function back(){
  window.location.href = "log.html";
}

document.getElementById("showpassword").addEventListener("click",function(){
    const passwordinput = document.getElementById("password");
    const type = passwordinput.getAttribute("type")==="password"?"text":"password";
    passwordinput.setAttribute("type",type);
    let hidepass = document.getElementById("hidepassword");
    let showpass = document.getElementById("showpassword");
    this.classList.toggle("fa-eye-slash");
    hidepass.style.display="block";
    showpass.style.display="none";

});
document.getElementById("hidepassword").addEventListener("click",function(){
     const passwordinput = document.getElementById("password");
     const type = passwordinput.getAttribute("type")==="password"?"text":"password";
     let hidepass = document.getElementById("hidepassword");
     let showpass = document.getElementById("showpassword");
     passwordinput.setAttribute("type",type);
     this.classList.toggle("fa-eye");
 });


document.getElementById("showpassword1").addEventListener("click", function() {
    const passwordInput = document.getElementById("repassword");
    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);
    this.classList.toggle("fa-eye-slash");
    document.getElementById("hidepassword1").style.display = "block";
  });

  document.getElementById("hidepassword1").addEventListener("click", function() {
    const passwordInput = document.getElementById("repassword");
    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);
    this.classList.toggle("fa-eye");

  });


