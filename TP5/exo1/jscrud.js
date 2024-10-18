let selectedRow = null;

function onFormSubmit(event) {
    event.preventDefault();
    const formData = getFormData();

    if (selectedRow === null) {
        insertNewRow(formData);  
    } else {
        updateRow(formData);     
    }
    resetForm();
}
function getFormData() {
    return {
        nom: $('#inputNom').val(),
        prenom: $('#inputPrenom').val()
    };
}

function insertNewRow(data) {
    const table = document.getElementById('studentsTableBody');
    const newRow = table.insertRow(table.rows.length);

    newRow.insertCell(0).innerHTML = data.nom;
    newRow.insertCell(1).innerHTML = data.prenom;
    newRow.insertCell(2).innerHTML = `
                <button onclick="onEdit(this)">Edit</button>
                <button onclick="onDelete(this)">Delete</button>
            `;
}

function onEdit(td) {
    selectedRow = td.parentElement.parentElement;
    $('#inputNom').val(selectedRow.cells[0].innerHTML);
    $('#inputPrenom').val(selectedRow.cells[1].innerHTML);
}

function updateRow(data) {
    selectedRow.cells[0].innerHTML = data.nom;
    selectedRow.cells[1].innerHTML = data.prenom;
}

function onDelete(td) {
    if (confirm('Are you sure you want to delete this record?')) {
        const row = td.parentElement.parentElement;
        document.getElementById('studentsTableBody').deleteRow(row.rowIndex - 1);
        resetForm();
    }
}

function resetForm() {
    $('#inputNom').val('');
    $('#inputPrenom').val('');
    selectedRow = null;
}