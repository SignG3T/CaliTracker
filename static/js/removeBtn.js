const modal = document.getElementById('confirmationModalDelete');
const confirmAction = document.getElementById('confirmActionDelete');
const cancelAction = document.getElementById('cancelActionDelete');
let deleteUrl = ''; // Variabile per salvare l'URL di eliminazione

function confirmDelete(taskId) {
    deleteUrl = './api/delete_task.php?task_id=' + taskId;
    modal.style.display = 'flex';
}

confirmAction.onclick = function() {
    modal.style.display = 'none';
    window.location.href = deleteUrl; // Reindirizza all’URL di eliminazione
}

cancelAction.onclick = function() {
    modal.style.display = 'none';
}

window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}