// Show registration modal
var regModal = document.getElementById("myModal");
var regBtn = document.getElementById("showFormButton");
var regSpan = document.getElementsByClassName("close")[0];

regBtn.onclick = function() {
    regModal.style.display = "block";
}

regSpan.onclick = function() {
    regModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == regModal) {
        regModal.style.display = "none";
    }
}

// Form validation
var regForm = document.getElementById('frm');
var editForm = document.getElementById('efrm');

function validateForm(form) {
    var categoryId = form.querySelector('input[name="category_id"]').value;
    var regex = /^C\d{3}$/;

    if (!regex.test(categoryId)) {
        alert('Book Category ID must be in the format C001');
        return false;
    }
    return true;
}

regForm.onsubmit = function() {
    return validateForm(regForm);
}

editForm.onsubmit = function() {
    return validateForm(editForm);
}
;
