@extends('parts.master')

@section('content')
<div class="container mt-5">
    <h2>{{ __('msgs.Add Blog') }}</h2>
    <p>{{ __('msgs.Add Text') }}</p>

    @if(Session::has('success'))
    <a class="btn btn-sm btn-outline-primary">{{ session('success') }}</a>
    @endif
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

         <!-- Hidden User ID Field -->
         <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        <!-- Title Field -->
        <div class="mb-3">
            <label for="title" class="form-label">{{ __('msgs.Title') }}</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
            @error('title')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Summary Field -->
        <div class="mb-3">
            <label for="summary" class="form-label">{{ __('msgs.Summary') }}</label>
            <textarea name="summary" id="summary" rows="2" class="form-control @error('summary') is-invalid @enderror" required>{{ old('summary') }}</textarea>
            @error('summary')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Content Field -->
        <div class="mb-3">
            <label for="content" class="form-label">{{ __('msgs.Content') }}</label>
            <textarea name="content" id="content" rows="5" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
            @error('content')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Image Upload Field -->
        <div class="mb-3">
            <label for="image" class="form-label">{{ __('msgs.Image') }}</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">{{ __('msgs.Add Blog') }}</button>
    </form>
</div>

@endsection
