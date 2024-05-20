document.getElementById("showpassword").addEventListener("click",function(){
  const passwordinput = document.getElementById("password");
  const type = passwordinput.getAttribute("type") === "password" ? "text" : "password";
  passwordinput.setAttribute("type",type);
  let hidepass = document.getElementById("hidepassword");

  this.classList.toggle("fa-eye-slash");
  hidepass.style.display = "block";
});

document.getElementById("hidepassword").addEventListener("click",function(){
  const passwordinput = document.getElementById("password");
  const type = passwordinput.getAttribute("type") === "password" ? "text" : "password";
  passwordinput.setAttribute("type",type);



  
  this.classList.toggle("fa-eye");
  

});
