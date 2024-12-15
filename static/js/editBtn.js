const modalEdit = document.getElementById('confirmationModalEdit');
const confirmActionEdit = document.getElementById('confirmActionEdit');
const cancelActionEdit = document.getElementById('cancelActionEdit');
let editUrl = ''; // Variabile per salvare l'URL di modifica

// Funzione per confermare la modifica
function confirmEdit(taskId, descrizione, max) {
    event.preventDefault();
    // Sanitizzazione dei parametri per evitare vulnerabilità
    taskId = encodeURIComponent(taskId);
    descrizione = encodeURIComponent(descrizione);
    max = encodeURIComponent(max);
    
    // Creazione dell'URL di modifica
    editUrl = `./api/edit_task.php?task_id=${taskId}&descrizione=${descrizione}&max=${max}`;
    
    // Mostra la finestra di conferma
    modalEdit.style.display = 'flex';
}

// Conferma l'azione di modifica
confirmActionEdit.onclick = function() {
    modalEdit.style.display = 'none';
    
    // Esegui una richiesta di modifica tramite AJAX (fetch API)
    fetch(editUrl)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Opzionalmente, puoi aggiornare la UI o dare un feedback all'utente
                alert('Modifica avvenuta con successo!');
                // Puoi anche aggiornare la pagina o fare altre azioni
                location.reload(); // Ricarica la pagina per riflettere i cambiamenti
            } else {
                alert('Si è verificato un errore durante la modifica.');
            }
        })
        .catch(error => {
            console.error('Errore:', error);
            alert('Errore nella richiesta.');
        });
};

// Annulla l'azione di modifica
cancelActionEdit.onclick = function() {
    modalEdit.style.display = 'none';
};

// Chiudi la finestra di conferma se clicchi fuori dal modal
window.onclick = function(event) {
    if (event.target === modalEdit) {
        modalEdit.style.display = 'none';
    }
};
