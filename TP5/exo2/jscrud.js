$(document).ready(function() {
    $('#userTable').DataTable({
        ajax: {
            url: 'http://localhost:8080/IDAW/TP4/exo5/api/users.php',  
            dataSrc: ''  
        },
        columns: [
            { data: 'name' },     
            { data: 'email' },   
            {
                data: null,       
                render: function(data, type, row) {
                    return `
                        <button onclick="editUser(${row.id})">Edit</button>
                        <button onclick="deleteUser(${row.id})">Delete</button>
                    `;
                }
            }
        ]
    });
});


let selectedUserId = null;


function submitForm(event) {
    event.preventDefault();  

    const formData = {
        name: $('#inputName').val(),
        email: $('#inputEmail').val()
    };

    if (selectedUserId) {
        $.ajax({
            url: `http://localhost:8080/IDAW/TP4/exo5/api/users.php?id=${selectedUserId}`, 
            method: 'PUT', 
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function() {
                alert('User updated successfully');
                $('#userTable').DataTable().ajax.reload();  
                resetForm(); 
            },
            error: function() {
                alert('Failed to update user');
            }
        });
    } else {
        $.ajax({
            url: 'http://localhost:8080/IDAW/TP4/exo5/api/users.php',  
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function() {
                alert('User added successfully');
                $('#userTable').DataTable().ajax.reload();
                resetForm();  
            },

            error: function() {
                alert('Failed to add user');
            }
        });
    }
}

function editUser(id) {
    $.ajax({
        url: `http://localhost:8080/IDAW/TP4/exo5/api/users.php?id=${id}`,
        method: 'GET',
        success: function(user) {
            $('#inputName').val(user.name);
            $('#inputEmail').val(user.email);
            selectedUserId = user.id; 
        },
        error: function() {
            alert('Failed to fetch user data');
        }
    });
}

function deleteUser(id) {
    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: `http://localhost:8080/IDAW/TP4/exo5/api/users.php?id=${id}`,  
            method: 'DELETE',  
            success: function() {
                alert('User deleted successfully');
                $('#userTable').DataTable().ajax.reload();  
            },
            error: function() {
                alert('Failed to delete user');
            }
        });
    }
}

function resetForm() {
    $('#inputName').val('');
    $('#inputEmail').val('');
    selectedUserId = null;  
}
