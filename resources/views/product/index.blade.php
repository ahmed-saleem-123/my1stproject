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
    <a href="{{ route('product.create') }}" class="btn btn-success float-right mb-3">
        <i class="fas fa-plus"></i> Add New
    </a>
    <table class="table table-striped mt-4">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>title</th>
            <th>img</th>
            <th>Price</th>
            <th>brand_id</th>
            <th>category_id</th>
            <th>Action</th>
        </tr>
        </thead>
        @foreach($products as $product)
        <tbody>
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->title }}</td>
            <td>
                <img src="{{ Storage::url($product->img) }}" alt="product Image"  style="width: 100px; height: auto;">
            </td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->brand->title ?? ''}}</td>
            <td>{{ $product->category->title ?? '' }}</td>
            <td>
                <a href="{{ route('product.edit' , $product->id ) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('product.delete' , $product->id) }}" method="post" style="display: inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
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
