@extends('layout.main')
@section('main-section')
    <div class="container mt-5">
        <h2>Advanced Form</h2>
        <form action="{{ isset($form) ? route('brand.update', $form->id) : route('brand.store') }}" method="POST">
        @csrf
        @if(isset($form))
            @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="name" name="title" value="{{ old('title', isset($form->id) ? $form->title : '') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
