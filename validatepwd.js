
function validateform(e){
    e.preventDefault();
   let valid = true;
    let user = document.getElementById('userid').value;
    let password = document.getElementById('password').value;
    let repassword = document.getElementById('repassword').value;
    let email = document.getElementById('email').value;
    let error1 = document.getElementById('Error1');
    let error2 = document.getElementById('Error2');
    let error3 = document.getElementById('Error3');
    let error4 = document.getElementById('Error4');

    error1.textContent = "";
    error2.textContent = "";
    error3.textContent = "";
    error4.textContent = "";

    const pattern = /^U\d{3}$/;
    const number = /[0-9]/;
    const upcase = /[A-Z]/;
    const symbols = /[!@#$%^&*(),.{}|<>]/;
    const char = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!pattern.test(user)){ 
        error1.textContent = "UserId should be in format U001,U002...";
        valid = false;
    }

    if(password.length < 8){
        error2.textContent = "Atleast password should have 8 characters";
        valid = false;
    }

    else if(!number.test(password)){
        error2.textContent = "Atleast password should contain a number";
        valid = false;
    }
    else if(!upcase.test(password)){
        error2.textContent = "Atleast password should contain an uppercase letter";
        valid = false;
    }
    else if(!symbols.test(password)){
        error2.textContent = "Atleast password should contain a special character like '!','@','$'...";
        valid = false;
    }
    if(password != repassword){
        error3.textContent = "Password doesn't match";
        valid = false;
    }
    if(!char.test(email)){
      error4.textContent = "Invalid email!";
       valid = false;

    }
        // Split the email into local and domain parts
    const [local, domain] = email.split('@');

        // Additional checks for local part
    if (local.startsWith('.') || local.endsWith('.') || local.includes('..')) {
        error4.textContent = "Do not start or end with '.' or with '..' ";
        valid = false;
        }

    // Additional checks for domain part
    if (domain.startsWith('-') || domain.endsWith('-') || domain.includes('..')) {
        error4.textContent = "Do not use '-' in domain part";
        valid = false;
    }
  if(valid){
    document.getElementById('signupForm').submit();
    }


}
