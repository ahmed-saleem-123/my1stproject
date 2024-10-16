@extends('layout.main')
@section('main-section')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Index</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Category List</h1>
    <a href="{{ route('order.create') }}" class="btn btn-success float-right mb-3">
        <i class="fas fa-plus"></i> Add New
    </a>
    <table class="table table-striped mt-4">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>City</th>
            <th>Address</th>
            <th>Country</th>
            <th>Action</th>
        </tr>
        </thead>
        @foreach($adds as $add)
        <tbody>
        <tr>
            <td>{{ $add->id }}</td>
            <td>{{ $add->name }}</td>
            <td>{{ $add->email }}</td>
            <td>{{ $add->city }}</td>
            <td>{{ $add->address }}</td>
            <td>{{ $add->country }}</td>
            <td>
                <a href="{{ route('order.edit', $add->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('order.delete', $add->id) }}" method="post" style="display: inline" >
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn  btn-danger btn-sm">Delete</button>
                </form>
                <a href="{{ route('order.detail', $add->id) }}" class="btn  btn-primary btn-sm">view Order Items</a>
            </td>

        </tr>
        </tbody>
        @endforeach
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
