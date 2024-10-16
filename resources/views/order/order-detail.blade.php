<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Order Details</h2>
                </div>
                <div class="card-body">
                    <h5>Order #12345</h5>
                    <p><strong>Order Date:</strong> 01 Oct, 2024</p>
                    <p><strong>Customer Name:</strong> Ahmed</p>
                    <p><strong>Shipping Address:</strong> 123 Main Street, City, Country</p>

                    <table class="table table-bordered mt-4">
                        <thead class="table-dark">
                        <tr>
                            <th>img</th>
                            <th>Product</th>
                            <th>Quentity</th>
                            <th>Price</th>
                        </tr>
                        </thead>

                        @foreach($items as $item)
                        <tbody>
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $item->product->img) }}"  class="img-fluid" width="50px"  alt="">
                            </td>
                            <td>{{ $item->product->title }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->product->price }}</td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                    <div class="d-flex justify-content-between">
                        <h4>Total Amount:</h4>
                        <td>{{ $item->product->price * $item->qty}}</td>
                    </div>
                </div>

                <div class="card-footer text-center">
                    <a href="{{ route('order') }}" class="btn btn-primary">Back to Products</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
