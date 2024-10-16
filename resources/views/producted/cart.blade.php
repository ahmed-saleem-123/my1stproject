@extends('frunt.main')
@section('local-section')
    <!DOCTYPE html>
    <style>
        .quantity-input {
            width: 60px;
        }
        .cart-table th, .cart-table td {
            vertical-align: middle;
        }
    </style>

<div class="container mt-5">
    <h1 class="mb-4">Your Cart</h1>
    @if(session()->has('cart') && count(session('cart')) > 0)
        <table class="table table-striped cart-table">
            <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart as $id => $details)
                <tr>
                    <td><img src="{{ asset('storage/' . $details['img']) }}" width="50" height="50" alt="Product"></td>
                    <td>{{ $details['name'] ?? 'No name available' }}</td>
                    <td>
                        <form class="d-flex align-items-center gap-1">
                            <button type="button" class="btn btn-outline-primary decrement">-</button>
                            <input type="number" class="form-control quantity-input" name="quantity" data-id="{{ $id }}" value="{{ $details['quantity'] }}" min="1">
                            <button type="button" class="btn btn-outline-primary increment">+</button>
                        </form>
                    </td>
                    <td>Rs. {{ number_format($details['price'], 2) }}</td>
                    <td>Rs. {{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.delete', $id) }}" method="post" style="display: inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form action="{{ route('checkout') }}" method="POST" class="mt-4">
            @csrf
            <h4>Checkout Details</h4>
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="text" name="city" class="form-control" placeholder="City" required>
            </div>
            <div class="mb-3">
                <input type="text" name="country" class="form-control" placeholder="Country" required>
            </div>
            <div class="mb-3">
                <textarea name="address" class="form-control" placeholder="Address" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Checkout</button>
        </form>
    @else
        <p class="alert alert-warning">Your cart is empty!</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.querySelectorAll('.decrement').forEach(function(button) {
        button.addEventListener('click', function() {
            const quantityInput = this.nextElementSibling;
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1; // Decrease quantity
                updateQuantity(quantityInput.dataset.id, quantityInput.value); // Update backend
            }
        });
    });

    document.querySelectorAll('.increment').forEach(function(button) {
        button.addEventListener('click', function() {
            const quantityInput = this.previousElementSibling;
            let currentQuantity = parseInt(quantityInput.value);
            quantityInput.value = currentQuantity + 1; // Increase quantity
            updateQuantity(quantityInput.dataset.id, quantityInput.value); // Update backend
        });
    });

    document.querySelectorAll('.quantity-input').forEach(function(input) {
        input.addEventListener('change', function() {
            const quantity = parseInt(this.value);
            if (quantity > 0) { // Ensure quantity is greater than 0
                updateQuantity(this.dataset.id, quantity);
            }
        });
    });

    function updateQuantity(productId, quantity) {
        fetch(`/cart/update/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                quantity: quantity
            })
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Quantity updated successfully!');
                } else {
                    console.log('Failed to update quantity.');
                }
            }).catch(error => {
            console.log('Error:', error);
        });
    }
</script>

</body>
</html>
@endsection
