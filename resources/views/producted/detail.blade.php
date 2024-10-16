@extends('frunt.main')
@section('local-section')
    <!DOCTYPE html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $details->img) }}" class="img-fluid rounded shadow" alt="{{ $details->title }}">
        </div>
        <div class="col-md-6">
            <h1 class="display-4">{{ $details->title }}</h1>
            <h3 class="text-success">${{ number_format($details->price, 2) }}</h3>
            <p class="text-muted">Brand: {{ $details->brand->title }}</p>
            <input type="number" class="form-control mb-3" id="quantity" value="1" min="1" style="width: 60px;">
            <button id="add-to-cart" data-id="{{ $details->id }}" class="btn btn-primary text-white">Add to Cart</button>
            <a href="{{ route('cart.view') }}" class="btn btn-secondary text-white">View Cart</a>
        </div>
    </div>
</div>

<!-- Popup for Login -->
<div id="login-popup" style="display: none;">
    <div class="overlay"></div>
    <div class="popup">
        <h2>Please Login</h2>
        <p>You need to log in to add items to your cart.</p>
        <a href="{{ route('user.login') }}" class="btn btn-primary">Login</a>
        <button onclick="closePopup()" class="btn btn-secondary">Close</button>
    </div>
</div>

<style>

    body {
        background-color: #f8f9fa; /* Light background color */
        min-height: 100vh; /* Set minimum height to full viewport height */
        display: block; /* Use block to stack items normally */
    }

    .container {
        padding-bottom: 100px; /* Footer ke liye space */
    }



    body {
        background-color: #f8f9fa; /* Light background color */
    }

    .overlay {
        background: rgba(0, 0, 0, 0.6);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 999;
    }

    .popup {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        width: 400px;
        text-align: center;
        animation: slideIn 0.4s ease-out;
    }

    .popup h2 {
        margin-bottom: 15px;
        color: #333;
        font-weight: bold;
        font-size: 24px;
    }

    .popup p {
        margin-bottom: 20px;
        color: #555;
        font-size: 16px;
    }


    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
    }

    @keyframes slideIn {
        from {
            transform: translate(-50%, -60%);
            opacity: 0;
        }
        to {
            transform: translate(-50%, -50%);
            opacity: 1;
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};

        $('#add-to-cart').on('click', function(event) {
            event.preventDefault();
            console.log('User logged in:', isLoggedIn); // Debugging log

            if (!isLoggedIn) {
                console.log('Showing login popup');
                showLoginPopup();
            } else {
                console.log('Proceeding with adding to cart');
                let productId = $(this).data('id');
                let quantity = $('#quantity').val();

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    }),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'  // CSRF token inclusion
                    },
                    success: function(data) {
                        alert(data.message);
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error); // Log any errors
                        if (xhr.status === 401) {
                            alert('Unauthorized: Please log in to proceed.');
                        } else {
                            alert('Error occurred: ' + error);
                        }
                    }
                });
            }
        });

        // Show login popup function
        function showLoginPopup() {
            $('#login-popup').css('display', 'block');
        }

        // Close popup function
        window.closePopup = function() {
            $('#login-popup').css('display', 'none');
        };
    });
</script>
</body>
</html>
@endsection
