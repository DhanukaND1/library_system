// Show edit modal
document.querySelectorAll('.btn-success').forEach(function(editBtn) {
    editBtn.onclick = function(event) {
        var bookEditModal = event.target.closest("td").querySelector(".edit");
        bookEditModal.style.display = "block";

        var editSpan = bookEditModal.getElementsByClassName("eclose")[0];
        editSpan.onclick = function() {
            bookEditModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == bookEditModal) {
                bookEditModal.style.display = "none";
            }
        }
    }
});

// Show delete confirmation form
document.querySelectorAll('.delete-btn').forEach(function(deleteBtn) {
    deleteBtn.onclick = function(event) {
        var bookId = event.target.getAttribute('data-id');
        var confirmForm = document.getElementById('deleteConfirm');
        var deleteMessage = confirmForm.querySelector('#deleteMessage');
        deleteMessage.textContent = 'Do you want to delete ' + bookId + ' record?';
        confirmForm.querySelector('.confirm-delete').setAttribute('data-id', bookId);
        confirmForm.style.display = 'block';
        document.body.classList.add('modal-open');
    }
});

document.querySelectorAll('.confirm-delete').forEach(function(confirmDeleteBtn) {
    confirmDeleteBtn.onclick = function(event) {
        var bookId = event.target.getAttribute('data-id');
        window.location.href = 'process1.php?delete=' + bookId;
    }
});

document.querySelectorAll('.cancel-delete').forEach(function(cancelDeleteBtn) {
    cancelDeleteBtn.onclick = function() {
        var confirmForm = document.getElementById('deleteConfirm');
        confirmForm.style.display = 'none';
        document.body.classList.remove('modal-open');
    }
});

window.onclick = function(event) {
    var confirmForm = document.getElementById('deleteConfirm');
    if (event.target == confirmForm) {
        confirmForm.style.display = 'none';
        document.body.classList.remove('modal-open');
    }
}
