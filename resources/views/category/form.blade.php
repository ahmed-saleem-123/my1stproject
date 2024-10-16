@extends('layout.main')
@section('main-section')
    <div class="container mt-5">
        <h2>Advanced Form</h2>
        <form action="{{ isset($hamd) ? route('category.update', $hamd->id) : route('category.store') }}" method="POST">
        @csrf
        @if(isset($hamd))
            @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Title:</label>
                <input type="text" class="form-control" id="name" name="title" value="{{ old('title', isset($hamd->id) ? $hamd->title : '') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
