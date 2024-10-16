@extends('frunt.main')
@section('local-section')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container d-flex vh-100">
    <div class="row justify-content-center align-self-center w-100">
        <div class="col-md-6 text-center">
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="display-4 text-success">Thank You!</h1>
                    <p class="lead">Your order has been placed successfully.</p>
                    <p>We appreciate your business and will get back to you shortly.</p>
                    <a href="{{ route('product.index') }}" class="btn btn-primary">Return to Products</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
