@extends('frunt.main')
@section('local-section')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .sidebar {
            background-color: #fff; /* White background */
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a shadow for depth */
            max-height: 100vh; /* Full height */
            overflow-y: auto; /* Add vertical scroll if content exceeds */
        }

        .sidebar h2 {
            color: #333; /* Darker heading color */
            font-size: 20px;
            margin-bottom: 15px;
            border-bottom: 2px solid #007bff; /* Add border below the title */
            padding-bottom: 5px;
        }

        .sidebar ul {
            list-style: none; /* Remove bullet points */
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            text-decoration: none; /* Remove underline */
            color: #007bff; /* Bootstrap blue */
            font-size: 16px;
            padding: 8px;
            display: block;
            border-radius: 5px;
        }

        .sidebar ul li a:hover {
            background-color: #007bff;
            color: white;
            transition: 0.3s ease-in-out; /* Smooth transition */
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                left: -250px;
                width: 250px;
                transition: 0.3s;
            }

            .sidebar.open {
                left: 0;
            }
        }
    </style>

    <div class="sidebar bg-white p-3 border-pil">
        <h2 class="text-black">Categories</h2>
        <ul>
            @foreach($categories as $category)
                <li><a href="{{ route('products.byCategory', $category->id) }}">{{ $category->title }}</a></li>
            @endforeach
        </ul>

        <h2 class="text-black">Brands</h2>
        <ul>
            @foreach($brands as $brand)
                <li><a href="{{ route('products.byBrand', $brand->id) }}">{{ $brand->title }}</a></li>

            @endforeach
        </ul>
    </div>

<div class="container mt-5">
    <h1 class="text-center mb-4">Electronics</h1>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm"> <!-- Added shadow for better visual -->
                    <img src="{{ Storage::url($product->img) }}" class="card-img-top" alt="{{ $product->title }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$product->title}}</h5>
                        <p class="card-text text-danger fw-bold">Price: {{ $product->price }}</p>
                        <p class="text-muted">Brand: {{ $product->brand->title }}</p>
                        <a href="{{ route('product.detail', $product->id) }}" class="btn btn-warning text-white">View Product</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
