<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel AJAX CRUD | Posts Management</title>
    
    {{-- CSRF Token for AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Vite assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Optional: Custom Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>

<body class="bg-light text-dark">

    {{-- Header --}}
    <x-header />

    <main class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">📄 Laravel AJAX CRUD (Posts)</h2>
                <button class="btn btn-primary shadow-sm" id="createNew">
                    <i class="bi bi-plus-circle me-1"></i> Add New Post
                </button>
            </div>

            {{-- Posts Table --}}
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-bordered table-hover align-middle bg-white" id="postTable">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 25%">Title</th>
                            <th>Content</th>
                            <th style="width: 15%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- Modal --}}
    @include('posts.modal')

    {{-- Footer --}}
    <x-footer />

    {{-- Optional: Toast/Success Notification Placeholder --}}
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <div id="toastContainer"></div>
    </div>

</body>
</html>
