<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Stylish Navbar</title>
    <style>
        .navbar {
            background-color: #343a40; /* Dark background */
        }
        .navbar-brand {
            font-weight: bold;
            color: #ffffff; /* White color for brand */
        }
        .navbar-nav .nav-link {
            color: #ffffff; /* White color for links */
            margin-right: 20px;
        }
        .navbar-nav .nav-link:hover {
            color: #ffcc00; /* Yellow color on hover */
        }
        .search-input {
            width: 300px;
        }
        .btn-secondary {
            background-color: #ffcc00; /* Yellow background for search button */
            border: none;
        }
        .btn-secondary:hover {
            background-color: #e6b800; /* Darker yellow on hover */
        }
        .search-form {
            display: flex; /* Make input and button align horizontally */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark w-100">
    <div class="container-fluid"> <!-- Change here to use a fluid container -->
        <a class="navbar-brand" href="#">My Website</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            @if(Route::currentRouteName() == 'product.index')
                <form action="{{ route('product.index') }}" method="GET" class="search-form me-auto">
                    <input type="text" name="brand_id" class="form-control search-input" placeholder="Search Products" value="{{ request('brand_id') }}">
                    <button type="submit" class="btn btn-secondary ms-2">Search</button>
                </form>
            @endif

            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Product</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Brand</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Category</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Order</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <form action="{{ route('logout.user') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="color: inherit;">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('user.login') }}" class="nav-link btn btn-link" style="color: inherit;">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
