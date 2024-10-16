@extends('layout.main')
@section('main-section')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Category List</h1>
    <a href="{{ route('category.create') }}" class="btn btn-success float-right mb-3">
        <i class="fas fa-plus"></i> Add New
    </a>
    <table class="table table-striped mt-4">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>title</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($edits as $edit)
        <tr>
            <td>{{ $edit->id }}</td>
            <td>{{ $edit->title }}</td>
            <td>
                <a href="{{ route('category.edit', $edit->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('category.delete', $edit->id) }}" style="display: inline" method="post">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
