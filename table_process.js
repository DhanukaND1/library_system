function deleteRecords(userid, row) {
  if (confirm("Are you sure you want to delete this record?")) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "table_process.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        var status = xhr.status;
        if (status === 0 || (status >= 200 && status < 400)) {
          alert("Record deleted successfully");
          row.remove();
        } else {
          alert("Error deleting record: " + xhr.responseText);
        }
      }
    };
    xhr.send("action=delete&user_id=" + encodeURIComponent(userid));
  }
}

function editRecords(userid, firstName, lastName, email, username, password) {
  // Store user data in sessionStorage
  sessionStorage.setItem('user_id', userid);
  sessionStorage.setItem('first_name', firstName);
  sessionStorage.setItem('last_name', lastName);
  sessionStorage.setItem('email', email);
  sessionStorage.setItem('username', username);
  sessionStorage.setItem('password', password);

  // Redirect to the update form
  window.location.assign('updateform.html');
}
