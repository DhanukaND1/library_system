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
// Show edit modal
document.querySelectorAll('.btn-success').forEach(function(editBtn) {
    editBtn.onclick = function(event) {
        var categoryEditModel = event.target.closest("td").querySelector(".edit");
        categoryEditModel.style.display = "block";

        var editSpan = categoryEditModel.getElementsByClassName("eclose")[0];
        editSpan.onclick = function() {
            categoryEditModel.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == categoryEditModel) {
                categoryEditModel.style.display = "none";
            }
        }
    }
});

document.querySelectorAll('.eclose').forEach(function(element) {
    element.addEventListener('click', function() {
        // Hide the alert
        this.parentElement.style.display = 'none';
    });
});

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
};
// Show delete confirmation form
document.querySelectorAll('.delete-btn').forEach(function(deleteBtn) {
    deleteBtn.onclick = function(event) {
        var categoryId = event.target.getAttribute('data-id');
        var confirmForm = document.getElementById('deleteConfirm');
        var deleteMessage = confirmForm.querySelector('#deleteMessage');
        deleteMessage.textContent = 'Do you want to delete ' + categoryId + ' category?';
        confirmForm.querySelector('.confirm-delete').setAttribute('data-id', categoryId);
        confirmForm.style.display = 'block';
        document.body.classList.add('modal-open');
    }
});

document.querySelectorAll('.confirm-delete').forEach(function(confirmDeleteBtn) {
    confirmDeleteBtn.onclick = function(event) {
        var categoryId = event.target.getAttribute('data-id');
        window.location.href = 'book_category_process.php?delete=' + categoryId;
    }
});

document.querySelectorAll('.cancel-delete').forEach(function(cancelDeleteBtn) {
    cancelDeleteBtn.onclick = function() {
        var confirmForm = document.getElementById('deleteConfirm');
        confirmForm.style.display = 'none';
        document.body.classList.remove('modal-open');
    }
});
