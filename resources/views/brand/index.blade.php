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
    <a href="{{ route('brand.create') }}" class="btn btn-success float-right mb-3">
        <i class="fas fa-plus"></i> Add New
    </a>
    <table class="table table-striped mt-4 pt-4">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>title</th>
            <th>Action</th>
        </tr>
        </thead>
        @foreach($views as $view)
        <tbody>
        <tr>
            <td>{{ $view->id }}</td>
            <td>{{ $view->title }}</td>
            <td>
                <a href="{{ route('brand.edit' , $view->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('brand.delete' , $view->id) }}" method="POST" style="display: inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>

            </td>
        </tr>
        </tbody>
        @endforeach
    </table>
</div>

</body>
</html>
@endsection
