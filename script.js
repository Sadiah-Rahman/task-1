function openEditModal(id, first, last, email, phone) {
    document.getElementById('editId').value = id;
    document.getElementById('editFirst').value = first;
    document.getElementById('editLast').value = last;
    document.getElementById('editEmail').value = email;
    document.getElementById('editPhone').value = phone;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
}

function saveEdit() {
    const id = document.getElementById('editId').value;
    const first = document.getElementById('editFirst').value;
    const last = document.getElementById('editLast').value;
    const email = document.getElementById('editEmail').value;
    const phone = document.getElementById('editPhone').value;

    fetch('update.php', {
        method: 'POST',
        body: JSON.stringify({ id, first, last, email, phone })
    }).then(() => {
        closeModal();
        location.reload();
    });
}

function deleteUser(id) {
    if (confirm("Are you sure you want to delete this user?")) {
        window.location = "delete.php?id=" + id;
    }
}
