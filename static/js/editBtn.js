const modalEdit = document.getElementById('confirmationModalEdit');
const confirmActionEdit = document.getElementById('confirmActionEdit');
const cancelActionEdit = document.getElementById('cancelActionEdit');
let deleteUrlEdit = ''; // Variabile per salvare l'URL di eliminazione

function confirmEdit(taskId, descrizione, max) {
    deleteUrlEdit = './api/edit_task.php?task_id=' + taskId + '&descrizione=' + descrizione + '&max=' + max;
    print(deleteUrlEdit)
    modalEdit.style.display = 'flex';
}

confirmActionEdit.onclick = function() {
    modalEdit.style.display = 'none';
    window.location.href = deleteUrlEdit; // Reindirizza all’URL di eliminazione
}

cancelActionEdit.onclick = function() {
    modalEdit.style.display = 'none';
}

window.onclick = function(event) {
    if (event.target === modalEdit) {
        modalEdit.style.display = 'none';
    }
}