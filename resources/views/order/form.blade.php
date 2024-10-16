@extends('layout.main')
@section('main-section')
    <div class="container mt-5">
        <h2>Advanced Form</h2>
        <form   action="{{ isset($edit) ? '/order/update/'. $edit->id : route('order.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name' , isset($edit->id) ? $edit->name : '') }}"  required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', isset($edit->id) ? $edit->email : '') }}" required>
            </div>

            <div class="form-group">
                <label>city:</label>
                <input type="text" class="form-control" name="city" value="{{ old('city' , isset($edit->id) ? $edit->city : '') }}" required>
            </div>

           <div class="form-group">
                <label >address:</label>
                <input type="text" class="form-control"  name="address" value="{{ old('address', isset($edit->id) ? $edit->address : '') }}" required>
            </div>

            <div class="form-group">
                <label>country:</label>
                <input type="text" class="form-control"  name="country" value="{{ old('country' , isset($edit->id) ? $edit->country : '') }}"  required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </body>
    </html>
@endsection

