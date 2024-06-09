function updateRecords() {

    //data pass to php 
    var userId = document.getElementById('user_id').value;
    var firstName = document.getElementById('fname').value;
    var lastName = document.getElementById('lname').value;
    var email = document.getElementById('email').value;
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
  
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "table_process.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        var status = xhr.status;
        if (status === 0 || (status >= 200 && status < 400)) {
          alert("Record updated successfully");
          window.location.href = "table.php";
          
        } else {
          alert("Error updating record: " + xhr.responseText);
        }
      }
    };
    xhr.send("action=edit&user_id=" + encodeURIComponent(userId) +
      "&first_name=" + encodeURIComponent(firstName) +
      "&last_name=" + encodeURIComponent(lastName) +
      "&email=" + encodeURIComponent(email) +
      "&username=" + encodeURIComponent(username) +
      "&password=" + encodeURIComponent(password));
  }
  


function validate(e) {
    e.preventDefault();
 
    let valid = true;
    let user = document.getElementById('user_id').value;
    let password = document.getElementById('password').value;
    let email = document.getElementById('email').value;
    let error1 = document.getElementById('Error1');
    let error2 = document.getElementById('Error2');
    let error4 = document.getElementById('Error4');

    error1.textContent = "";
    error2.textContent = "";
    error4.textContent = "";

    const pattern = /^U\d{3}$/;
    const number = /[0-9]/;
    const upcase = /[A-Z]/;
    const symbols = /[!@#$%^&*(),.{}|<>]/;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!pattern.test(user)) {
        error1.textContent = "UserId should be in format U001, U002...";
        valid = false;
    }

    if (password.length < 8) {
        error2.textContent = "Password should have at least 8 characters";
        valid = false;
    } else if (!number.test(password)) {
        error2.textContent = "Password should contain at least one number";
        valid = false;
    } else if (!upcase.test(password)) {
        error2.textContent = "Password should contain at least one uppercase letter";
        valid = false;
    } else if (!symbols.test(password)) {
        error2.textContent = "Password should contain at least one special character like '!', '@', '$'...";
        valid = false;
    }

    if (!emailPattern.test(email)) {
        error4.textContent = "Invalid email!";
        valid = false;
    }

    // Split the email into local and domain parts
    const [local, domain] = email.split('@');
    if (local.startsWith('.') || local.endsWith('.') || local.includes('..')) {
        error4.textContent = "Do not start or end with '.' or with '..'";
        valid = false;
    }
    if (domain.startsWith('-') || domain.endsWith('-') || domain.includes('..')) {
        error4.textContent = "Do not use '-' in the domain part";
        valid = false;
    }

    if (valid) {
        updateRecords();
    }
}

function closeform() {
    let form = document.getElementById('updateForm');
    form.style.display = 'none';
    window.location.href = 'table.php';
}
