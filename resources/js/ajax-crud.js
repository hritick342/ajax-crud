import $ from 'jquery';
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
});

let editingId = null;

function fetchPosts() {
    $.get('/posts', function(data) {
        $('#postTable tbody').html('');
        data.forEach(post => {
            $('#postTable tbody').append(`
                <tr>
                    <td>${post.id}</td>
                    <td>${post.title}</td>
                    <td>${post.content}</td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn" data-id="${post.id}">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="${post.id}">Delete</button>
                    </td>
                </tr>
            `);
        });
    });
}
$(document).ready(function() {
    fetchPosts();

    // Show modal on 'Add Post' click
    $('#createNew').click(() => {
        $('#postForm')[0].reset();
        $('#methodInput').val('POST');  // reset method to POST
        $('#formModalLabel').text('Add Post');
        editingId = null;
        const modal = new bootstrap.Modal(document.getElementById('formModal'));
        modal.show();
    });

    // Load post data into modal for editing
    $(document).on('click', '.editBtn', function() {
        editingId = $(this).data('id');
        $.get(`/posts/${editingId}`, function(data) {
            $('#title').val(data.title);
            $('#content').val(data.content);
            $('#methodInput').val('PUT');
            $('#formModalLabel').text('Edit Post');
            const modal = new bootstrap.Modal(document.getElementById('formModal'));
            modal.show();
        });
    });



    // Handle delete
    $(document).on('click', '.deleteBtn', function() {
        const id = $(this).data('id');
        if (confirm('Are you sure to delete this post?')) {
            $.ajax({
                url: `/posts/${id}`,
                type: 'POST',
                data: {
                    _method: 'DELETE'
                },
                success: function() {
                    fetchPosts();
                }
            });
        }
    });

    // Load all posts into the table
    function fetchPosts() {
        $.get('/posts', function(data) {
            $('#postTable tbody').html('');
            data.forEach(post => {
                $('#postTable tbody').append(`
                    <tr>
                        <td>${post.id}</td>
                        <td>${post.title}</td>
                        <td>${post.content}</td>
                        <td>
                            <button class="btn btn-sm btn-primary editBtn" data-id="${post.id}">Edit</button>
                            <button class="btn btn-sm btn-danger deleteBtn" data-id="${post.id}">Delete</button>
                        </td>
                    </tr>
                `);
            });
        });
    }
 $('#postForm').submit(function(e) {
    e.preventDefault();

    // Clear previous errors
    $('#postForm .is-invalid').removeClass('is-invalid');
    $('#postForm .invalid-feedback').remove();

    const title = $('#title').val().trim();
    const content = $('#content').val().trim();
    let hasError = false;

    if (!title) {
        $('#title').addClass('is-invalid')
            .after('<div class="invalid-feedback">Title is required.</div>');
        hasError = true;
    }

    if (!content) {
        $('#content').addClass('is-invalid')
            .after('<div class="invalid-feedback">Content is required.</div>');
        hasError = true;
    }

    // Stop if there are validation errors
    if (hasError) return;

    // Prepare form data
    const method = editingId ? 'PUT' : 'POST';
    const url = editingId ? `/posts/${editingId}` : '/posts';
    const formData = $(this).serialize() + (method === 'PUT' ? '&_method=PUT' : '');

    // Submit via AJAX
    $.ajax({
        url: url,
        type: 'POST', // Always POST; Laravel uses _method override
        data: formData,
        success: function() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('formModal'));
            modal.hide();
            fetchPosts();
            $('#postForm')[0].reset(); // Optional: Reset form after submission
            editingId = null;
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                Object.keys(errors).forEach(function(key) {
                    const input = $(`#${key}`);
                    input.addClass('is-invalid');
                    input.after(`<div class="invalid-feedback">${errors[key][0]}</div>`);
                });
            } else {
                alert('Something went wrong. Please try again.');
                console.error(xhr.responseText);
            }
        }
    });
});


});